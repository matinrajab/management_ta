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
        Schema::create('revisi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('catatan');
            $table->string('file');
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
        Schema::dropIfExists('revisi');
    }
};
