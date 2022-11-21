<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MhsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('mhs.dashboard');
    }

    public function proposal()
    {
        return view('mhs.proposal');
    }

    public function add_proposal()
    {
        return view('mhs.add_proposal');
    }

    public function ta()
    {
        return view('mhs.ta');
    }

    public function sidang()
    {
        return view('mhs.sidang');
    }

    public function dosbing()
    {
        return view('mhs.daftar_dosbing');
    }
}
