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
        Schema::create('l__barangs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pm_barang')->unsigned();
            $table->foreign('id_pm_barang')->references('id')->on('pm__barangs')->ondelete('cascade');
            $table->bigInteger('id_kondisi')->unsigned();
            $table->foreign('id_kondisi')->references('id')->on('kondisis')->ondelete('cascade');
            $table->string('keterangan');
            $table->string('cover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l__barangs');
    }
};
