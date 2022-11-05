<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \APP\Models\Mahasiswa;
use \APP\Models\Ta;
use \APP\Models\Pembimbing;

class Revisi extends Model
{
    use HasFactory;
    public $with = ['mahasiswa', 'ta', 'pembimbing'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, "id_mahasiswa");
    }

    public function ta()
    {
        return $this->belongsTo(Ta::class, "id_ta");
    }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, "id_pembimbing");
    }
}