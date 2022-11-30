<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembimbing;
use App\Models\Mahasiswa;
use App\Models\Proposal;
use App\Models\Revisi;
use App\Models\Surat;
use App\Models\Ta;
use Illuminate\Support\Facades\Auth;
use File;

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

    public function proposal_update($id, Request $data)
    {
        $this->validate($data, [
            'judul' => 'required',
            'bidang' => 'required',
        ]);

        $proposal = Proposal::find($id);

        // cek apakah file diganti
        if ($data->file('file')) {
            $this->validate($data, [
                'file' => 'required|file|mimes:doc,docx,pdf',
            ]);
            File::delete('file_upload/' . $proposal->file);
            $file = $data->file('file');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'file_upload';
            $file->move($tujuan_upload, $nama_file);

            $proposal->file = $nama_file;
        }

        $proposal->judul = $data->judul;
        $proposal->bidang = $data->bidang;
        $proposal->save();

        return redirect('/mhs/proposal');
    }

    public function proposal_hapus($id)
    {
        // hapus file dari direktori
        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();
        $proposal = Proposal::find($id);
        File::delete('file_upload/' . $proposal->file);

        // hapus data pada database
        Proposal::find($id)->delete();

        $mahasiswa->pembimbing_id = NULL;
        $mahasiswa->save();

        return redirect()->back();
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
            'catatan' => 'required',
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
            'catatan' => $data->catatan,
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

    public function surat()
    {
        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();
        return view('mhs.surat', ['mahasiswa' => $mahasiswa]);
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

    public function dosbing()
    {
        $pembimbing = Pembimbing::all();
        return view('mhs.daftar_dosbing', ['pembimbing' => $pembimbing]);
    }
}
