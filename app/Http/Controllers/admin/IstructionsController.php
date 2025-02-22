<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ReadFileAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instruction;


class IstructionsController extends Controller
{
    public function index()
    {
        $instrukt = Instruction::where('is_moderation', 'like', 0)->paginate(10);
        return view('admin.instructions.index', ['instructions' => $instrukt]);
    }

    public function show(Instruction $instruction, ReadFileAction $action)
    {

        $contents = $action->read($instruction->file);
        return view('admin.instructions.show', ['instruction' => $instruction, 'content' => $contents]);
    }

    public function addInstruktion($id)
    {
        $instrukt = Instruction::find($id);
        $instrukt->is_moderation = 1;

        if ($instrukt->update()) {
            return redirect()->route('admin.instructions.index')->with('success', 'Интсрукция добавлена');
        }

        return redirect()->route('admin.instructions.index')->with('error', 'Интсрукция не добавлена');
    }

    public function destroy(Instruction $instruction)
    {
        if ($instruction->delete()) {
            return redirect()->route('admin.instructions.index')->with('success', 'Интсрукция успешно удалена!');
        }
        return back()->with('error', 'Ошибка удаления интсрукции');
    }
}
