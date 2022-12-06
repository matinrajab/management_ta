<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
use File;

class SuratController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mhsSurat()
    {
        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();
        return view('mhs.surat', ['mahasiswa' => $mahasiswa]);
    }

    public function adminSurat()
    {
        $mahasiswa = Mahasiswa::all();
        return view('admin.surat', ['mahasiswa' => $mahasiswa]);
    }

    public function surat_add($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return view('admin.surat_add', ['mahasiswa' => $mahasiswa]);
    }

    public function surat_store($id, Request $data)
    {
        $this->validate($data, [
            'pengesahan' => 'required|file|mimes:doc,docx,pdf',
            'ijazah' => 'required|file|mimes:doc,docx,pdf',
            'rekomendasi' => 'required|file|mimes:doc,docx,pdf',
        ]);

        // upload pengesahan
        $file = $data->file('pengesahan');
        $nama_file_pengesahan = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'file_upload';
        $file->move($tujuan_upload, $nama_file_pengesahan);

        // upload ijazah
        $file = $data->file('ijazah');
        $nama_file_ijazah = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'file_upload';
        $file->move($tujuan_upload, $nama_file_ijazah);

        // upload rekomendasi
        $file = $data->file('rekomendasi');
        $nama_file_rekomendasi = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'file_upload';
        $file->move($tujuan_upload, $nama_file_rekomendasi);

        $mahasiswa = Mahasiswa::find($id);

        Surat::create([
            'pengesahan' => $nama_file_pengesahan,
            'ijazah' => $nama_file_ijazah,
            'rekomendasi' => $nama_file_rekomendasi,
            'mahasiswa_id' => $mahasiswa->id,
        ]);

        return redirect('/admin/surat');
    }

    public function surat_hapus($id)
    {
        $surat = Surat::find($id);
        File::delete('file_upload/' . $surat->pengesahan);
        File::delete('file_upload/' . $surat->ijazah);
        File::delete('file_upload/' . $surat->rekomendasi);

        $surat->delete();

        return redirect()->back();
    }

    public function download_pengesahan($id)
    {
        $surat = Surat::find($id);

        $dir = 'file_upload/';
        $filename = $surat->pengesahan;
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

    public function download_ijazah($id)
    {
        $surat = Surat::find($id);

        $dir = 'file_upload/';
        $filename = $surat->ijazah;
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

    public function download_rekomendasi($id)
    {
        $surat = Surat::find($id);

        $dir = 'file_upload/';
        $filename = $surat->rekomendasi;
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
}
