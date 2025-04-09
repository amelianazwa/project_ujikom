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
        Schema::create('l__ruangans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pm_ruangan')->unsigned();
            $table->foreign('id_pm_ruangan')->references('id')->on('pm__ruangans')->ondelete('cascade');
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
        Schema::dropIfExists('l__ruangans');
    }
};
