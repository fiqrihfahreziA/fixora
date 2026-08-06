<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->enum('status', [
                'draft',
                'diajukan',
                'disetujui_koordinator',
                'disetujui_kabid',
                'menunggu_direktur',
                'disetujui',
                'ditolak',
                'revisi', // enum baru
            ])->default('draft')->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->enum('status', [
                'draft',
                'diajukan',
                'disetujui_koordinator',
                'disetujui_kabid',
                'menunggu_direktur',
                'disetujui',
                'ditolak',
            ])->default('draft')->change();
        });
    }
};