<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembimbing;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

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

    public function mhs()
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
