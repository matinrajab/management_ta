<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Revisi;
use Illuminate\Support\Facades\Auth;

class SidangMhsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sidang()
    {
        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();
        return view('mhs.sidang', ['mahasiswa' => $mahasiswa]);
    }

    public function revisi_add()
    {
        return view('mhs.revisi_add');
    }

    public function revisi_store(Request $data)
    {
        $this->validate($data, [
            'tanggal' => 'required',
            'file' => 'required|file|mimes:doc,docx,pdf',
        ]);

        // upload file
        $file = $data->file('file');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'file_upload';
        $file->move($tujuan_upload, $nama_file);

        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();

        Revisi::create([
            'tanggal' => $data->tanggal,
            'file' => $nama_file,
            'mahasiswa_id' => $mahasiswa->id,
            'pembimbing_id' => $mahasiswa->pembimbing_id,
        ]);

        return redirect('/mhs/sidang');
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
        return view('mhs.revisi_edit', ['revisi' => $revisi]);
    }

    public function revisi_update($id, Request $data)
    {
        $this->validate($data, [
            'tanggal' => 'required',
            'catatan' => 'required',
        ]);

        $revisi = Revisi::find($id);

        // cek apakah file diganti
        if ($data->file('file')) {
            $this->validate($data, [
                'file' => 'required|file|mimes:doc,docx,pdf',
            ]);
            File::delete('file_upload/' . $revisi->file);
            $file = $data->file('file');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'file_upload';
            $file->move($tujuan_upload, $nama_file);

            $revisi->file = $nama_file;
        }

        $revisi->tanggal = $data->tanggal;
        $revisi->catatan = $data->catatan;
        $revisi->save();

        return redirect('/mhs/sidang');
    }

    public function revisi_hapus($id)
    {
        $revisi = Revisi::find($id);

        // hapus file dari direktori
        File::delete('file_upload/' . $revisi->file);

        // hapus data pada database
        $revisi->delete();

        return redirect()->back();
    }
}
