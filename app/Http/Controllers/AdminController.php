<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('admin.dashboard');
    }

    public function proposal()
    {
        return view('admin.proposal');
    }

    public function proposal_edit()
    {
        return view('admin.proposal_edit');
    }

    public function ta()
    {
        return view('admin.ta');
    }

    public function ta_add()
    {
        return view('admin.ta_add');
    }

    public function ta_edit()
    {
        return view('admin.ta_edit');
    }

    public function sidang()
    {
        return view('admin.sidang');
    }

    public function sidang_add()
    {
        return view('admin.sidang_add');
    }

    public function sidang_edit()
    {
        return view('admin.sidang_edit');
    }

    public function revisi_add()
    {
        return view('admin.revisi_add');
    }

    public function revisi_edit()
    {
        return view('admin.revisi_edit');
    }

    public function dosbing()
    {
        return view('admin.dosbing');
    }

    public function dosbing_add()
    {
        return view('admin.dosbing_add');
    }

    public function dosbing_edit()
    {
        return view('admin.dosbing_edit');
    }

    public function mhs()
    {
        return view('admin.mhs');
    }

    public function mhs_add()
    {
        return view('admin.mhs_add');
    }

    public function mhs_edit()
    {
        return view('admin.mhs_edit');
    }

    
}
