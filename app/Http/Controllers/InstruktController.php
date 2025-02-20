<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use App\Models\Complaint;
use App\Http\Request\CrateInstructionsRequest;
use App\Http\Request\StoreComplaintRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\IOFactory;

class InstruktController extends Controller
{
    public function index()
    {
        $instrukt = Instruction::where('is_moderation', 'like', 1)->paginate(10);
        return view('instructions.index', ['instructions' => $instrukt]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        // dd($search);
        $instrukt = Instruction::where('is_moderation', 'like', 1)
            ->where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $search . '%')
            ->paginate(10);
        return view('instructions.index', ['instructions' => $instrukt]);
    }

    public function show(Instruction $instruction)
    {
        $filePath = Storage::path($instruction->file);
        $contents = '';
        if (str_ends_with($filePath, 'txt')) {
            $contents =  file_get_contents($filePath);
            return view('instructions.show', ['instruction' => $instruction, 'content' => $contents]);
        }

        $phpWord = IOFactory::load($filePath);
        $sections = $phpWord->getSections();
        foreach ($sections as $section) {
            $elements = $section->getElements();
            foreach ($elements as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    foreach ($element->getElements() as $text) {
                        if ($text instanceof \PhpOffice\PhpWord\Element\Text) {
                            $contents = $contents . $text->getText() . PHP_EOL;
                        }
                    }
                } elseif ($element instanceof \PhpOffice\PhpWord\Element\Text) {
                    $contents = $contents . $element->getText() . PHP_EOL;
                }
            }
        }
        return view('instructions.show', ['instruction' => $instruction, 'content' => $contents]);
    }
    public function create()
    {
        return view('instructions.create');
    }

    public function store(CrateInstructionsRequest $request)
    {
        //валидация данных
        $dateValid = $request->validated();

        try {
            $fileName = null;
            if ($request->hasFile('file')) {

                $file = $request->file('file');

                $fileName = Storage::putFileAs('public/instructions', $file, $request->file('file')->getClientOriginalName());
                $dateValid['file'] = $fileName;
                $dateValid['is_moderation'] = 1;
            }
            $instruction = Instruction::create($dateValid);
        } catch (\Exception $e) {
            return redirect()->route('instructions.create')->with('error', 'Ошибка добавления инструкции! ' . $e->getMessage());
        }
        return redirect()->route('instructions.show', $instruction)->with('success', 'Инструкция успешно добавлена');
    }

    public function download(Instruction $instruction)
    {
        if ($instruction) {
            return Storage::download($instruction->file);
        }

        return redirect()->route('instructions.index', $instruction)->with('error', 'Интсрукция не найдена');
    }


    public function complaint(Instruction $instruction)
    {
        return view('instructions.complaint', ['instructions_id' => $instruction->id]);
    }

    public function comStore(StoreComplaintRequest $request)
    {
        //валидация данных
        $dateValid = $request->validated();
        $dateValid['users_id'] = Auth::user()->getAuthIdentifier();
        //dd($dateValid);
        $comInstruction = Complaint::create($dateValid);
        if (!$comInstruction) {
            $instruction = Instruction::find($dateValid->instructions_id);
            return redirect()->route('instructions.complaint', ['instruction' => $instruction])
                ->with('error', 'Ошибка отпраления жалобы! ');
        }
        return redirect()->route('instructions.index')->with('success', 'Жалоба успешно отправлена');
    }
}
