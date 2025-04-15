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
        Schema::create('pm__ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('code_peminjaman');
            $table->bigInteger('id_anggota')->unsigned();
            $table->string('tanggal_peminjaman');
            $table->string('tanggal_pengembalian');
            $table->string('jenis_kegiatan');
            $table->string('waktu_peminjaman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm__ruangans');
    }
};
