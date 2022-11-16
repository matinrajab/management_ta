<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    use HasFactory;
    protected $table = "pembimbing";

    protected $fillable = ['nip', 'nama_pembimbing', 'phone', 'email', 'alamat', 'jumlah'];

    public function mahasiswa()
    {
        return $this->hasMany('App\Model\Mahasiswa');
    }

    public function proposal()
    {
        return $this->hasMany('App\Model\Proposal');
    }

    public function logbook()
    {
        return $this->hasMany('App\Model\Logbook');
    }

    public function ta()
    {
        return $this->hasMany('App\Model\Ta');
    }

    public function revisi()
    {
        return $this->hasMany('App\Model\Revisi');
    }
}
