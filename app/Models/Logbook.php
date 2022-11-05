<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \APP\Models\Mahasiswa;
use \APP\Models\Pembimbing;

class Logbook extends Model
{
    use HasFactory;
    public $with = ['mahasiswa', 'pembimbing'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, "id_mahasiswa");
    }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, "id_pembimbing");
    }
}
