<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $table = "proposal";

    protected $fillable = ['judul', 'bidang', 'nama_pembimbing', 'file', 'status', 'mahasiswa_id', 'pembimbing_id'];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa');
    }

    public function pembimbing()
    {
        return $this->belongsTo('App\Models\Pembimbing');
    }
}
