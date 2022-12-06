<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Logbook;
use Illuminate\Support\Facades\Auth;

class TaMhsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ta()
    {
        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();
        return view('mhs.ta', ['mahasiswa' => $mahasiswa]);
    }

    public function ta_add()
    {
        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();
        return view('mhs.ta_add', ['mahasiswa' => $mahasiswa]);
    }

    public function ta_store(Request $data)
    {
        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();

        $this->validate($data, [
            'tanggal' => 'required',
            'kegiatan' => 'required',
            'catatan' => 'required'
        ]);

        Logbook::create([
            'nama_pembimbing' => $data->nama_pembimbing,
            'tanggal' => $data->tanggal,
            'kegiatan' => $data->kegiatan,
            'catatan' => $data->catatan,
            'mahasiswa_id' => $mahasiswa->id,
            'pembimbing_id' => $mahasiswa->pembimbing->id,
        ]);

        return redirect('/mhs/ta');
    }

    public function ta_edit($id)
    {
        $logbook = Logbook::find($id);
        return view('mhs.ta_edit', ['logbook' => $logbook]);
    }

    public function ta_update($id, Request $data)
    {
        $this->validate($data, [
            'tanggal' => 'required',
            'kegiatan' => 'required',
            'catatan' => 'required'
        ]);

        $logbook = Logbook::find($id);

        $logbook->tanggal = $data->tanggal;
        $logbook->kegiatan = $data->kegiatan;
        $logbook->catatan = $data->catatan;
        $logbook->save();

        return redirect('/mhs/ta');
    }

    public function ta_hapus($id)
    {
        $logbook = Logbook::find($id);
        $logbook->delete();
        return redirect()->back();
    }
}
