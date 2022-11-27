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
            $table->enum('bidang', ['Basis Data', 'Jaringan', 'Pemrograman Web', 'Aplikasi Mobile']);
            $table->string('pembimbing');
            $table->string('file');
            $table->enum('status', ['Disetujui', 'Ditolak', 'Proses'])->default('Proses');
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
