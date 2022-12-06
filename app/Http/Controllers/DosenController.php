<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembimbing;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mhsDosbing()
    {
        $pembimbing = Pembimbing::all();
        return view('mhs.daftar_dosbing', ['pembimbing' => $pembimbing]);
    }

    public function adminDosbing()
    {
        $pembimbing = Pembimbing::all();
        return view('admin.dosbing', ['pembimbing' => $pembimbing]);
    }

    public function dosbing_add()
    {
        return view('admin.dosbing_add');
    }

    public function dosbing_store(Request $data)
    {
        $this->validate($data, [
            'nama_pembimbing' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'name' => $data->nama_pembimbing,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'type' => 1,
        ]);

        Pembimbing::create([
            'nip' => $data->nip,
            'nama_pembimbing' => $data->nama_pembimbing,
            'phone' => $data->phone,
            'email' => $data->email,
        ]);

        return redirect('/admin/dosbing');
    }

    public function dosbing_edit($id)
    {
        $pembimbing = Pembimbing::find($id);
        $user = User::where('name', $pembimbing->nama_pembimbing)->first();
        return view('admin.dosbing_edit', ['pembimbing' => $pembimbing, 'user' => $user]);
    }

    public function dosbing_update($id, Request $data)
    {
        $this->validate($data, [
            'nip' => 'required',
            'nama_pembimbing' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        $pembimbing = Pembimbing::find($id);
        $user = User::where('name', $pembimbing->nama_pembimbing)->first();

        $pembimbing->nip = $data->nip;
        $pembimbing->nama_pembimbing = $data->nama_pembimbing;
        $pembimbing->phone = $data->phone;
        $pembimbing->email = $data->email;
        $pembimbing->save();

        $user->name = $data->nama_pembimbing;
        $user->email = $data->email;
        if ($data->password !== NULL) {
            $user->password = Hash::make($data->password);
        }
        $user->save();

        return redirect('/admin/dosbing');
    }

    public function dosbing_hapus($id)
    {
        $pembimbing = Pembimbing::find($id);
        $user = User::where('name', $pembimbing->nama_pembimbing)->first();
        $pembimbing->delete();
        $user->delete();
        return redirect('/admin/dosbing');
    }
}
