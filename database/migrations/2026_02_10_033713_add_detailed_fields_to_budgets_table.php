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
        Schema::table('budgets', function (Blueprint $table) {
            $table->dropUnique(['year']);
            $table->string('kode_rekening')->after('year');
            $table->string('nama_program')->after('kode_rekening');
            $table->string('kategori')->after('nama_program');
            
            $table->unique(['year', 'kode_rekening']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->dropUnique(['year', 'kode_rekening']);
            $table->dropColumn(['kode_rekening', 'nama_program', 'kategori']);
            $table->unique('year');
        });
    }
};
