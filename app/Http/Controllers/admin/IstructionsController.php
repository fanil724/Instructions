<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Instructions;
use PhpOffice\PhpWord\IOFactory;

class IstructionsController extends Controller
{
    public function index()
    {
        $instrukt = Instructions::where('is_moderation', 'like', 0)->paginate(10);
        return view('admin.instructions.index', ['instructions' => $instrukt]);
    }

    public function show(Instructions $instruction)
    {

        $contents = null;

        // $contents = Storage::get($instruction->file);
        $filePath = storage_path($instruction->file);
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


        return view('admin.instructions.show', ['instruction' => $instruction, 'content' => $contents]);
    }

    public function addInstruktion($id)
    {
        $instrukt = Instructions::find($id);
        $instrukt->is_moderation = 1;

        if ($instrukt->update()) {
            return redirect()->route('admin.instructions.index')->with('success', 'Интсрукция добавлена');
        }

        return redirect()->route('admin.instructions.index')->with('error', 'Интсрукция не добавлена');
    }
}
