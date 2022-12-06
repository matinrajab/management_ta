<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing;
use Illuminate\Support\Facades\Auth;

class TaDosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ta()
    {
        $pembimbing = Pembimbing::where('nama_pembimbing', Auth::user()->name)->first();
        return view('dosen.ta', ['pembimbing' => $pembimbing]);
    }
}
