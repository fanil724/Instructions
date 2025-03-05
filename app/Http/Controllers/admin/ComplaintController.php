<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;


class ComplaintController extends Controller
{
    public function index()
    {
        $compalint = Complaint::where('status', '=', 0)->paginate(10);
        return view('admin.complaint.index', ['compalints' => $compalint]);
    }

    public function show(string $id)
    {
        $compalint = Complaint::find($id);
        return view('admin.complaint.show', ['compalint' => $compalint]);
    }

    public function all()
    {
        $compalint = Complaint::paginate(10);
        return view('admin.complaint.index', ['compalints' => $compalint]);
    }


    public function status(string $id)
    {
        $compalints = Complaint::find($id);
        if ($compalints) {
            $compalints->status = (($compalints->status == 1) ? 0 : 1);
            if ($compalints->save()) {
                return response()->json([
                    'success' => 'true',
                    'message' => 'Статус жалобы успешно иземенен',
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Статус жалобы не иземенен'
            ], 404);
        }

        return response()->json([
            'success' => false,
            'message' => 'Жалоба не найдена'
        ], 404);
    }
}
