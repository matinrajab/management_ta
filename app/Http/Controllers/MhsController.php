<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembimbing;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MhsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dosenMhs()
    {
        $pembimbing = Pembimbing::where('nama_pembimbing', Auth::user()->name)->first();
        return view('dosen.daftar_mhs', ['pembimbing' => $pembimbing]);
    }

    public function adminMhs()
    {
        $mahasiswa = Mahasiswa::all();
        return view('admin.mhs', ['mahasiswa' => $mahasiswa]);
    }

    public function mhs_add()
    {
        return view('admin.mhs_add');
    }

    public function mhs_store(Request $data)
    {
        $this->validate($data, [
            'nama_mhs' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'name' => $data->nama_mhs,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'type' => 0,
        ]);

        Mahasiswa::create([
            'nrp' => $data->nrp,
            'nama_mhs' => $data->nama_mhs,
            'gender' => $data->gender,
            'phone' => $data->phone,
            'email' => $data->email,
        ]);

        return redirect('/admin/mhs');
    }

    public function mhs_edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $user = User::where('name', $mahasiswa->nama_mhs)->first();
        return view('admin.mhs_edit', ['mahasiswa' => $mahasiswa, 'user' => $user]);
    }

    public function mhs_update($id, Request $data)
    {
        $this->validate($data, [
            'nrp' => 'required',
            'nama_mhs' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        $mahasiswa = Mahasiswa::find($id);
        $user = User::where('name', $mahasiswa->nama_mhs)->first();

        $mahasiswa->nrp = $data->nrp;
        $mahasiswa->nama_mhs = $data->nama_mhs;
        $mahasiswa->gender = $data->gender;
        $mahasiswa->phone = $data->phone;
        $mahasiswa->email = $data->email;
        $mahasiswa->save();

        $user->name = $data->nama_mhs;
        $user->email = $data->email;
        if ($data->password !== NULL) {
            $user->password = Hash::make($data->password);
        }
        $user->save();

        return redirect('/admin/mhs');
    }

    public function mhs_hapus($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $user = User::where('name', $mahasiswa->nama_mhs)->first();
        $mahasiswa->delete();
        $user->delete();
        return redirect('/admin/mhs');
    }
}
