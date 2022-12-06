<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mhsHome()
    {
        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();
        return view('mhs.dashboard', ['mahasiswa' => $mahasiswa]);
    }

    public function dosenHome()
    {
        return view('dosen.dashboard');
    }

    public function adminHome()
    {
        return view('admin.dashboard');
    }
}
