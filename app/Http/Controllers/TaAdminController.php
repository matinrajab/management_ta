<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing;
use App\Models\Logbook;

class TaAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ta()
    {
        $pembimbing = Pembimbing::all();
        return view('admin.ta', ['pembimbing' => $pembimbing]);
    }

    public function ta_hapus($id)
    {
        $logbook = Logbook::find($id);
        $logbook->delete();
        return redirect()->back();
    }
}
