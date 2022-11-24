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

    public function sidang_add()
    {
        return view('dosen.sidang_add');
    }

    public function sidang_edit()
    {
        return view('dosen.sidang_edit');
    }

    public function proposal()
    {
        return view('dosen.proposal');
    }

    public function proposal_edit()
    {
        return view('dosen.proposal_edit');
    }

    public function revisi_edit()
    {
        return view('dosen.revisi_edit');
    }
}
