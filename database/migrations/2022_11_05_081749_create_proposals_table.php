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
        Schema::create('proposal', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->enum('bidang', ['Basis Data', 'Konsep Jaringan', 'Komputasi']);
            $table->dateTime('tgl_seminar', $precision = 0);
            $table->enum('status', ['Diterima', 'Ditolak', 'Proses']);
            $table->integer('nilai');
            $table->string('keterangan');
            $table->foreignId('mahasiswa_id');
            $table->foreignId('pembimbing_id');
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
        Schema::dropIfExists('proposal');
    }
};
