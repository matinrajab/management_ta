<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->enum('matkul', ['Basis Data', 'Konsep Jaringan', 'Komputasi']);
            $table->dateTime('tgl_seminar', $precision = 0);
            $table->enum('status', ['Diterima', 'Ditolak', 'Proses']);
            $table->integer('nilai');
            $table->string('keterangan');
            $table->foreignId('id_mahasiswa');
            $table->foreignId('id_pembimbing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
};
