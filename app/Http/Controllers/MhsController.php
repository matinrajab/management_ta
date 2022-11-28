<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembimbing;
use App\Models\Mahasiswa;
use App\Models\Proposal;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Auth;

class MhsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();
        return view('mhs.dashboard', ['mahasiswa' => $mahasiswa]);
    }

    public function proposal()
    {
        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();
        return view('mhs.proposal', ['mahasiswa' => $mahasiswa]);
    }

    public function proposal_download($id)
    {
        $proposal = Proposal::find($id);

        $dir = 'file_upload/';
        $filename = $proposal->file;
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

    public function proposal_add()
    {
        $pembimbing = Pembimbing::all();
        return view('mhs.proposal_add', ['pembimbing' => $pembimbing]);
    }

    public function proposal_store(Request $data)
    {
        $this->validate($data, [
            'judul' => 'required',
            'bidang' => 'required',
            'nama_pembimbing' => 'required',
            'file' => 'required|file|mimes:doc,docx,pdf',
        ]);

        // upload file
        $file = $data->file('file');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'file_upload';
        $file->move($tujuan_upload, $nama_file);

        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();
        $pembimbing = Pembimbing::where('nama_pembimbing', $data->nama_pembimbing)->first();

        Proposal::create([
            'judul' => $data->judul,
            'bidang' => $data->bidang,
            'nama_pembimbing' => $data->nama_pembimbing,
            'file' => $nama_file,
            'mahasiswa_id' => $mahasiswa->id,
            'pembimbing_id' => $pembimbing->id,
        ]);

        $mahasiswa->pembimbing_id = $pembimbing->id;
        $mahasiswa->save();

        return redirect('/mhs/proposal');
    }

    public function proposal_edit($id)
    {
        $proposal = Proposal::find($id);
        return view('mhs.proposal_edit', ['proposal' => $proposal]);
    }

    public function ta()
    {
        return view('mhs.ta');
    }

    public function ta_add()
    {
        return view('mhs.ta_add');
    }

    public function ta_edit()
    {
        return view('mhs.ta_edit');
    }

    public function sidang()
    {
        return view('mhs.sidang');
    }

    public function revisi_add()
    {
        return view('mhs.revisi_add');
    }

    public function revisi_edit()
    {
        return view('mhs.revisi_edit');
    }

    public function surat()
    {
        return view('mhs.surat');
    }

    public function dosbing()
    {
        $pembimbing = Pembimbing::all();
        return view('mhs.daftar_dosbing', ['pembimbing' => $pembimbing]);
    }
}
