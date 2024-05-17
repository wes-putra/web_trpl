<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kerjasama_mitras', function (Blueprint $table) {
            $table->id('mitra_id');
            $table->string('nama_mitra');
            $table->string('logo_mitra')->nullable();
            $table->string('alamat_mitra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerjasama_mitras');
    }
};
