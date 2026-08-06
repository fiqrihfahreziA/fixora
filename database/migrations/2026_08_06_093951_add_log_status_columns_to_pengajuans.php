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
        Schema::table('pengajuans', function (Blueprint $table) {
            // Tambah kolom log status
            $table->string('log_status_penerima')->nullable()->after('catatan_unit');
            $table->string('log_status_atasan')->nullable()->after('log_status_penerima');
            $table->string('log_status_direktur')->nullable()->after('log_status_atasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn([
                'log_status_penerima',
                'log_status_atasan',
                'log_status_direktur'
            ]);
        });
    }
};