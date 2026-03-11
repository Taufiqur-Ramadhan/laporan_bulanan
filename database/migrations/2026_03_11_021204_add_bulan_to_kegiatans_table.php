<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->string('bulan')->nullable()->after('budget_id');
        });
    }

    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn('bulan');
        });
    }
};
