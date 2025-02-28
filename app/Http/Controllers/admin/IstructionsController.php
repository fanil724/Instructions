<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ReadFileAction;
use App\Http\Controllers\Controller;
use App\Http\Request\UpdateInstructionRequest;
use Illuminate\Http\Request;
use App\Models\Instruction;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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


    public function edit(Instruction $instruction)
    {
        return view('admin.instructions.edit', ['instruction' => $instruction]);
    }

    public function update(UpdateInstructionRequest $request, Instruction $instruction)
    {

        $data = $request->validated();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $now = Carbon::now();
            $fileName = Storage::disk('public')->putFileAs(
                '/instructions',
                $file,
                $now->format('Y-m-d_H-i-s_') . $request->file('file')->getClientOriginalName()
            );

            $data['file'] = $fileName;
            $data['is_moderation'] = 0;
        } else {
            $data['file'] = $instruction->file;
        }
        $instruction->fill($data);

        if ($instruction->update()) {
            return redirect()->route('admin.instructions.index')->with('success', 'Интсрукция успешно изменена!');
        }

        return back()->with('error', 'Ошибка изменения Интсрукции');
    }

}
