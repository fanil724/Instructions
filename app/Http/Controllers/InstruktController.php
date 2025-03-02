<?php

namespace App\Http\Controllers;

use App\Actions\ReadFileAction;
use App\Models\Instruction;
use App\Models\Complaint;
use App\Http\Request\CrateInstructionsRequest;
use App\Http\Request\StoreComplaintRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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

    public function show(Instruction $instruction, ReadFileAction $action)
    {
        $contents = $action->read($instruction->file);
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
        $now = Carbon::now();
        try {
            $fileName = null;
            if ($request->hasFile('file')) {

                $file = $request->file('file');

                $fileName = Storage::disk('public')->putFileAs(
                    '/instructions',
                    $file,
                    $now->format('Y-m-d_H-i-s_') . $request->file('file')->getClientOriginalName()
                );

                // $fileName = Storage::putFileAs('public/instructions', $file, $request->file('file')->getClientOriginalName());
                $dateValid['file'] = $fileName;
                $dateValid['is_moderation'] = 0;
                $dateValid['user_id'] = Auth::user()->id;
            }
            $instruction = Instruction::create($dateValid);
        } catch (\Exception $e) {
            Log::error('Ошибка записи файла: ' . $e->getMessage());
            return redirect()->route('instructions.create')->with('error', 'Ошибка добавления инструкции! ' . $e->getMessage());
        }
        return redirect()->route('instructions.show', $instruction)->with('success', 'Инструкция успешно добавлена');
    }

    public function download(Instruction $instruction)
    {
        if ($instruction) {
            return Storage::disk('public')->download($instruction->file);
        }

        return redirect()->route('instructions.index', $instruction)->with('error', 'Интсрукция не найдена');
    }


    public function complaint(Instruction $instruction)
    {
        return view('instructions.complaint', ['instruction_id' => $instruction->id]);
    }

    public function comStore(StoreComplaintRequest $request)
    {
        //валидация данных
        $dateValid = $request->validated();
        $dateValid['user_id'] = Auth::user()->getAuthIdentifier();
        // dd($dateValid);
        $comInstruction = Complaint::create($dateValid);
        if (!$comInstruction) {
            $instruction = Instruction::find($dateValid->instruction_id);
            return redirect()->route('instructions.complaint', ['instruction' => $instruction])
                ->with('error', 'Ошибка отпраления жалобы! ');
        }
        return redirect()->route('instructions.index')->with('success', 'Жалоба успешно отправлена');
    }
}
