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
        Schema::create('ta', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->date('tanggal');
            $table->string('tempat', 100);
            $table->string('nama_penguji1', 100);
            $table->string('nama_penguji2', 100);
            $table->integer('nilai_dosbing');
            $table->integer('nilai_penguji1');
            $table->integer('nilai_penguji2');
            $table->enum('status', ['Lulus', 'Belum lulus', 'Proses']);
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
        Schema::dropIfExists('ta');
    }
};
