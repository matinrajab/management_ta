<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = "mahasiswa";

    protected $fillable = ['nrp', 'nama_mhs', 'gender', 'phone', 'email', 'pembimbing_id'];

    public function pembimbing()
    {
        return $this->belongsTo('App\Models\Pembimbing');
    }

    public function proposal()
    {
        return $this->hasOne('App\Models\Proposal');
    }

    public function logbook()
    {
        return $this->hasMany('App\Models\Logbook');
    }

    public function ta()
    {
        return $this->hasOne('App\Models\Ta');
    }

    public function revisi()
    {
        return $this->hasMany('App\Models\Revisi');
    }

    public function surat()
    {
        return $this->hasOne('App\Models\Surat');
    }
}
