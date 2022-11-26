<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = "mahasiswa";

    protected $fillable = ['nrp', 'nama_mhs', 'gender', 'phone', 'email', 'alamat'];

    public function pembimbing()
    {
        return $this->belongsTo('App\Model\Pembimbing');
    }

    public function proposal()
    {
        return $this->hasOne('App\Model\Proposal');
    }

    public function logbook()
    {
        return $this->hasMany('App\Model\Logbook');
    }

    public function ta()
    {
        return $this->hasOne('App\Model\Ta');
    }

    public function revisi()
    {
        return $this->hasMany('App\Model\Revisi');
    }

    public function surat()
    {
        return $this->hasOne('App\Model\Surat');
    }
}
