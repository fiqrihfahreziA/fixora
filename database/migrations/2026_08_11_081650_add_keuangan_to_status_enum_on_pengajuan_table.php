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
        Schema::table('status_enum_on_pengajuan', function (Blueprint $table) {
            $table->foreignId('id_keuangan')
              ->nullable()
              ->after('status')
              ->constrained('karyawans')
              ->nullOnDelete();
        
        // Tanggal disetujui keuangan
        $table->timestamp('disetujui_keuangan_at')
              ->nullable()
              ->after('id_keuangan');
              
        $table->int('status_keuangan')
              ->nullable()
              ->after('catatan_keuangan');
         $table->string('log_status_keuangan')->nullable();
        $table->decimal('total_disetujui', 15, 2)->default(0);
              // Catatan dari keuangan
        $table->text('catatan_keuangan')
              ->nullable()
              ->after('disetujui_keuangan_at');
              
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_enum_on_pengajuan', function (Blueprint $table) {
            //
        });
    }
};
