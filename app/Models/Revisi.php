<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revisi extends Model
{
    use HasFactory;
    protected $table = "revisi";

    protected $fillable = ['status', 'keterangan'];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Model\Mahasiswa');
    }

    public function pembimbing()
    {
        return $this->belongsTo('App\Model\Pembimbing');
    }
}
