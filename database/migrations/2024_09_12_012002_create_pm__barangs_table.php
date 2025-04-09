<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pm__barangs', function (Blueprint $table) {
            $table->id();
            $table->string('code_peminjaman');
            $table->bigInteger('id_anggota')->unsigned();
            $table->string('jenis_kegiatan');
            $table->bigInteger('id_ruangan')->unsigned();
            $table->foreign('id_ruangan')->references('id')->on('ruangans')->ondelete('cascade');
            $table->string('tanggal_peminjaman');
            $table->string('waktu_peminjaman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm__barangs');
    }
};
