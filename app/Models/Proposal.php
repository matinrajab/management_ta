<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $table = "proposal";

    protected $fillable = ['judul', 'bidang', 'tgl_seminar', 'status', 'nilai', 'keterangan'];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa');
    }

    public function pembimbing()
    {
        return $this->belongsTo('App\Model\Pembimbing');
    }
}
