<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;
    protected $table = "logbook";

    protected $fillable = ['tanggal', 'kegiatan', 'catatan', 'nama_pembimbing', 'mahasiswa_id', 'pembimbing_id'];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa');
    }

    public function pembimbing()
    {
        return $this->belongsTo('App\Models\Pembimbing');
    }
}
