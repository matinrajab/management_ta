<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ta extends Model
{
    use HasFactory;
    protected $table = "ta";

    protected $fillable = ['judul', 'tgl_daftar', 'pengesahan', 'nilai_dosbing1', 'nilai_penguji1', 'nilai_penguji2'];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa');
    }

    public function pembimbing()
    {
        return $this->belongsTo('App\Model\Pembimbing');
    }
}
