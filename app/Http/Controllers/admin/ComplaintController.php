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
}
