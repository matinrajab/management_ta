<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing;
use App\Models\Mahasiswa;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class ProposalMhsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function proposal()
    {
        $mahasiswa = Mahasiswa::where('nama_mhs', Auth::user()->name)->first();
        return view('mhs.proposal', ['mahasiswa' => $mahasiswa]);
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
}
