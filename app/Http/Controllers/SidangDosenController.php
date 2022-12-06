<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing;
use App\Models\Mahasiswa;
use App\Models\Revisi;
use App\Models\Ta;
use Illuminate\Support\Facades\Auth;

class SidangDosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sidang()
    {
        $pembimbing = Pembimbing::where('nama_pembimbing', Auth::user()->name)->first();
        return view('dosen.sidang', ['pembimbing' => $pembimbing]);
    }

    public function sidang_add()
    {
        $pembimbing = Pembimbing::where('nama_pembimbing', Auth::user()->name)->first();
        return view('dosen.sidang_add', ['pembimbing' => $pembimbing]);
    }

    public function sidang_store(Request $data)
    {
        $mahasiswa = Mahasiswa::where('nama_mhs', $data->nama_mhs)->first();

        $this->validate($data, [
            'nama_mhs' => 'required',
            'tanggal' => 'required',
            'tempat' => 'required',
            'nama_penguji1' => 'required',
            'nama_penguji2' => 'required',
        ]);

        Ta::create([
            'judul' => $mahasiswa->proposal->judul,
            'tanggal' => $data->tanggal,
            'tempat' => $data->tempat,
            'nama_penguji1' => $data->nama_penguji1,
            'nama_penguji2' => $data->nama_penguji2,
            'mahasiswa_id' => $mahasiswa->id,
            'pembimbing_id' => $mahasiswa->pembimbing->id,
        ]);

        return redirect('/dosen/sidang');
    }

    public function sidang_edit($id)
    {
        $ta = Ta::find($id);
        $mahasiswa = Mahasiswa::where('id', $ta->mahasiswa_id)->first();
        return view('dosen.sidang_edit', ['ta' => $ta], ['mahasiswa' => $mahasiswa]);
    }

    public function sidang_update($id, Request $data)
    {
        $this->validate($data, [
            'tanggal' => 'required',
            'tempat' => 'required',
            'nama_penguji1' => 'required',
            'nama_penguji2' => 'required',
            'nilai_penguji1' => 'required',
            'nilai_penguji2' => 'required',
            'nilai_dosbing' => 'required',
        ]);

        $ta = Ta::find($id);

        $ta->tanggal = $data->tanggal;
        $ta->tempat = $data->tempat;
        $ta->nama_penguji1 = $data->nama_penguji1;
        $ta->nama_penguji2 = $data->nama_penguji2;
        $ta->nilai_penguji1 = $data->nilai_penguji1;
        $ta->nilai_penguji2 = $data->nilai_penguji2;
        $ta->nilai_dosbing = $data->nilai_dosbing;
        $nilai = ($ta->nilai_penguji1 + $ta->nilai_penguji2 + $ta->nilai_dosbing) / 3;
        if ($nilai >= 56) {
            $ta->status = 'Lulus';
        } else {
            $ta->status = 'Belum lulus';
        }

        $ta->save();

        return redirect('/dosen/sidang');
    }

    public function sidang_hapus($id)
    {
        $ta = Ta::find($id);
        $ta->delete();
        return redirect()->back();
    }

    public function revisi_download($id)
    {
        $revisi = Revisi::find($id);

        $dir = 'file_upload/';
        $filename = $revisi->file;
        $file_path = $dir . $filename;
        $ctype = "application/octet-stream";

        if (!empty($file_path) && file_exists($file_path)) {
            header("Pragma:public");
            header("Expired:0");
            header("Cache-Control:must-revalidate");
            header("Content-Control:public");
            header("Content-Description: File Transfer");
            header("Content-Type: $ctype");
            header("Content-Disposition:attachment; filename=\"" . basename($file_path) . "\"");
            header("Content-Transfer-Encoding:binary");
            header("Content-Length:" . filesize($file_path));
            flush();
            readfile($file_path);
            return redirect()->back();
        }
    }

    public function revisi_edit($id)
    {
        $revisi = Revisi::find($id);
        $mahasiswa = Mahasiswa::find($revisi->mahasiswa_id);
        return view('dosen.revisi_edit', ['revisi' => $revisi, 'mahasiswa' => $mahasiswa]);
    }

    public function revisi_update($id, Request $data)
    {
        $this->validate($data, [
            'catatan' => 'required',
        ]);

        $revisi = Revisi::find($id);

        $revisi->catatan = $data->catatan;
        $revisi->status = $data->status;
        $revisi->save();

        return redirect('/dosen/sidang');
    }
}
