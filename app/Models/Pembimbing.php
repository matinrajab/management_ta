<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    use HasFactory;
    protected $table = "pembimbing";

    protected $fillable = ['nip', 'nama_pembimbing', 'phone', 'email', 'jumlah'];

    public function mahasiswa()
    {
        return $this->hasMany('App\Models\Mahasiswa');
    }

    public function proposal()
    {
        return $this->hasMany('App\Models\Proposal');
    }

    public function logbook()
    {
        return $this->hasMany('App\Models\Logbook');
    }

    public function ta()
    {
        return $this->hasMany('App\Models\Ta');
    }

    public function revisi()
    {
        return $this->hasMany('App\Models\Revisi');
    }
}
