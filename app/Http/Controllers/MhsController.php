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

    public function proposal_add()
    {
        return view('mhs.proposal_add');
    }

    public function proposal_edit()
    {
        return view('mhs.proposal_edit');
    }

    public function ta()
    {
        return view('mhs.ta');
    }

    public function ta_add()
    {
        return view('mhs.ta_add');
    }

    public function ta_edit()
    {
        return view('mhs.ta_edit');
    }

    public function sidang()
    {
        return view('mhs.sidang');
    }

    public function revisi_add()
    {
        return view('mhs.revisi_add');
    }

    public function revisi_edit()
    {
        return view('mhs.revisi_edit');
    }

    public function surat()
    {
        return view('mhs.surat');
    }

    public function dosbing()
    {
        return view('mhs.daftar_dosbing');
    }
}
