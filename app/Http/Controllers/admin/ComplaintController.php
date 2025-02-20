<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComplaintsInstructions;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index()
    {
        $comInstrukt = ComplaintsInstructions::where('status', 'like', 0)->paginate(10);
        return view('admin.complaint.index', ['comInstrukts' => $comInstrukt]);
    }

    public function show(ComplaintsInstructions $comInstrukt)
    {
        return view('admin.complaint.show', ['comInstrukt' => $comInstrukt]);
    }

    public function all()
    {
        $comInstrukt = ComplaintsInstructions::all();
        $comInstrukt = ComplaintsInstructions::paginate(10);
        return view('admin.complaint.index', ['comInstrukts' => $comInstrukt]);
    }


    public function status(string $id)
    {
        $сomplaints = ComplaintsInstructions::find($id);
        if ($сomplaints) {
            $сomplaints->status = (($сomplaints->status == 1) ? 0 : 1);
            if ($сomplaints->save()) {
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
