<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ta extends Model
{
    use HasFactory;
    protected $table = "ta";

    protected $fillable = ['judul', 'tanggal', 'tempat', 'nama_penguji1', 'nama_penguji2', 'nilai_dosbing', 'nilai_penguji1', 'nilai_penguji2', 'status', 'mahasiswa_id', 'pembimbing_id'];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa');
    }

    public function pembimbing()
    {
        return $this->belongsTo('App\Models\Pembimbing');
    }
}
