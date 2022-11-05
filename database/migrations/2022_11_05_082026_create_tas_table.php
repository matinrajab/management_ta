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
        Schema::create('tas', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->date('tgl_daftar');
            $table->dateTime('pengesahan', $precision = 0);
            $table->integer('nilai_dosbing1');
            $table->integer('nilai_penguji1');
            $table->integer('nilai_penguji2');
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
        Schema::dropIfExists('tas');
    }
};
