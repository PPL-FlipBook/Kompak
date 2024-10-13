<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;

class ActivitasLogController extends Controller
{
    /**
     * Tampilkan daftar rekening bank.
     */
    public function index()
    {
        $subjectId = LogActivity::first(); // Menemukan log dengan ID 1
        return view('backend.dashboard', compact('subjectId')); // Mengirim variabel ke view
    }

}
