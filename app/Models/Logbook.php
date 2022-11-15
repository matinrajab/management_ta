<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;
    protected $table = "logbook";

    protected $fillable = ['kegiatan', 'keterangan', 'nama_pembimbing', 'tanggal'];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa');
    }

    public function pembimbing()
    {
        return $this->belongsTo('App\Model\Pembimbing');
    }
}
