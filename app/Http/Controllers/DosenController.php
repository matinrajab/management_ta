<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('dosen.dashboard');
    }

    public function mhs()
    {
        return view('dosen.daftar_mhs');
    }

    public function ta()
    {
        return view('dosen.ta');
    }

    public function sidang()
    {
        return view('dosen.sidang');
    }

    public function proposal()
    {
        return view('dosen.proposal');
    }
}
