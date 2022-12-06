<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing;
use App\Models\Mahasiswa;
use App\Models\Proposal;

class ProposalAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function proposal()
    {
        $pembimbing = Pembimbing::all();
        return view('admin.proposal', ['pembimbing' => $pembimbing]);
    }

    public function proposal_edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return view('admin.proposal_edit', ['mahasiswa' => $mahasiswa]);
    }

    public function proposal_update($id, Request $data)
    {
        $proposal = proposal::find($id);

        $proposal->status = $data->status;
        $proposal->save();

        return redirect('/admin/proposal');
    }
}
