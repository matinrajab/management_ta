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
