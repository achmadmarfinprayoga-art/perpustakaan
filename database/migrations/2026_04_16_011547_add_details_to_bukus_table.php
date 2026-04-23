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
        Schema::table('bukus', function (Blueprint $table) {
            $table->string('penerbit')->nullable()->after('penulis');
            $table->string('isbn')->nullable()->after('penerbit');
            $table->string('rak')->nullable()->after('stok');
            $table->string('cover')->nullable()->after('rak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropColumn(['penerbit', 'isbn', 'rak', 'cover']);
        });
    }
};
