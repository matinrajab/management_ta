<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revisi extends Model
{
    use HasFactory;
    protected $table = "revisi";

    protected $fillable = ['tanggal', 'catatan', 'file', 'status', 'mahasiswa_id', 'pembimbing_id'];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa');
    }

    public function pembimbing()
    {
        return $this->belongsTo('App\Models\Pembimbing');
    }
}
