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
Schema::create('bukus', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->string('penulis');
    $table->year('tahun_terbit');
    $table->foreignId('kategori_id')->constrained('kategoris')->cascadeOnDelete();
    $table->integer('stok');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
