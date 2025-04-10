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
        Schema::create('peminjaman_detail_ruangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pm_ruangan');
            $table->unsignedBigInteger('id_ruangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_detail_ruangans');
    }
};
