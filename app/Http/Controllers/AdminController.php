<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Surat;
use App\Models\Pembimbing;
use App\Models\Mahasiswa;
use App\Models\Proposal;
use App\Models\Revisi;
use App\Models\Ta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use File;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('admin.dashboard');
    }



    public function proposal()
    {
        $pembimbing = Pembimbing::all();
        return view('admin.proposal', ['pembimbing' => $pembimbing]);
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

    public function ta()
    {
        $pembimbing = Pembimbing::all();
        return view('admin.ta', ['pembimbing' => $pembimbing]);
    }

    public function sidang()
    {
        $pembimbing = Pembimbing::all();
        return view('admin.sidang', ['pembimbing' => $pembimbing]);
    }

    public function sidang_add()
    {
        $pembimbing = Pembimbing::all();
        return view('admin.sidang_add', ['pembimbing' => $pembimbing]);
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

        return redirect('/admin/sidang');
    }

    public function sidang_edit($id)
    {
        $ta = Ta::find($id);
        $mahasiswa = Mahasiswa::where('id', $ta->mahasiswa_id)->first();
        return view('admin.sidang_edit', ['ta' => $ta], ['mahasiswa' => $mahasiswa]);
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

        return redirect('/admin/sidang');
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
        return view('admin.revisi_edit', ['revisi' => $revisi, 'mahasiswa' => $mahasiswa]);
    }

    public function revisi_update($id, Request $data)
    {
        $revisi = Revisi::find($id);

        $revisi->status = $data->status;
        $revisi->save();

        return redirect('/admin/sidang');
    }

    public function surat()
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

    public function dosbing()
    {
        $pembimbing = Pembimbing::all();
        return view('admin.dosbing', ['pembimbing' => $pembimbing]);
    }

    public function dosbing_add()
    {
        return view('admin.dosbing_add');
    }

    public function dosbing_store(Request $data)
    {
        $this->validate($data, [
            'nama_pembimbing' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'name' => $data->nama_pembimbing,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'type' => 1,
        ]);

        Pembimbing::create([
            'nip' => $data->nip,
            'nama_pembimbing' => $data->nama_pembimbing,
            'phone' => $data->phone,
            'email' => $data->email,
        ]);

        return redirect('/admin/dosbing');
    }

    public function dosbing_edit($id)
    {
        $pembimbing = Pembimbing::find($id);
        $user = User::where('name', $pembimbing->nama_pembimbing)->first();
        return view('admin.dosbing_edit', ['pembimbing' => $pembimbing, 'user' => $user]);
    }

    public function dosbing_update($id, Request $data)
    {
        $this->validate($data, [
            'nip' => 'required',
            'nama_pembimbing' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        $pembimbing = Pembimbing::find($id);
        $user = User::where('name', $pembimbing->nama_pembimbing)->first();

        $pembimbing->nip = $data->nip;
        $pembimbing->nama_pembimbing = $data->nama_pembimbing;
        $pembimbing->phone = $data->phone;
        $pembimbing->email = $data->email;
        $pembimbing->save();

        $user->name = $data->nama_pembimbing;
        $user->email = $data->email;
        if ($data->password !== NULL) {
            $user->password = Hash::make($data->password);
        }
        $user->save();

        return redirect('/admin/dosbing');
    }

    public function dosbing_hapus($id)
    {
        $pembimbing = Pembimbing::find($id);
        $user = User::where('name', $pembimbing->nama_pembimbing)->first();
        $pembimbing->delete();
        $user->delete();
        return redirect('/admin/dosbing');
    }

    public function mhs()
    {
        $mahasiswa = Mahasiswa::all();
        return view('admin.mhs', ['mahasiswa' => $mahasiswa]);
    }

    public function mhs_add()
    {
        return view('admin.mhs_add');
    }

    public function mhs_store(Request $data)
    {
        $this->validate($data, [
            'nama_mhs' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'name' => $data->nama_mhs,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'type' => 0,
        ]);

        Mahasiswa::create([
            'nrp' => $data->nrp,
            'nama_mhs' => $data->nama_mhs,
            'gender' => $data->gender,
            'phone' => $data->phone,
            'email' => $data->email,
        ]);

        return redirect('/admin/mhs');
    }

    public function mhs_edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $user = User::where('name', $mahasiswa->nama_mhs)->first();
        return view('admin.mhs_edit', ['mahasiswa' => $mahasiswa, 'user' => $user]);
    }

    public function mhs_update($id, Request $data)
    {
        $this->validate($data, [
            'nrp' => 'required',
            'nama_mhs' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        $mahasiswa = Mahasiswa::find($id);
        $user = User::where('name', $mahasiswa->nama_mhs)->first();

        $mahasiswa->nrp = $data->nrp;
        $mahasiswa->nama_mhs = $data->nama_mhs;
        $mahasiswa->gender = $data->gender;
        $mahasiswa->phone = $data->phone;
        $mahasiswa->email = $data->email;
        $mahasiswa->save();

        $user->name = $data->nama_mhs;
        $user->email = $data->email;
        if ($data->password !== NULL) {
            $user->password = Hash::make($data->password);
        }
        $user->save();

        return redirect('/admin/mhs');
    }

    public function mhs_hapus($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $user = User::where('name', $mahasiswa->nama_mhs)->first();
        $mahasiswa->delete();
        $user->delete();
        return redirect('/admin/mhs');
    }
}
