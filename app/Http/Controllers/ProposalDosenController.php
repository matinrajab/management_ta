<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing;
use App\Models\Mahasiswa;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class ProposalDosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function proposal()
    {
        $pembimbing = Pembimbing::where('nama_pembimbing', Auth::user()->name)->first();
        return view('dosen.proposal', ['pembimbing' => $pembimbing]);
    }

    public function proposal_edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return view('dosen.proposal_edit', ['mahasiswa' => $mahasiswa]);
    }

    public function proposal_update($id, Request $data)
    {
        $proposal = proposal::find($id);

        $proposal->status = $data->status;
        $proposal->save();

        return redirect('/dosen/proposal');
    }
}
