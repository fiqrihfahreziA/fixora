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
        Schema::create('detail_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained()->cascadeOnDelete();
            $table->string('nama_barang');
            $table->string('kode_aset')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->string('alasan')->nullable();
            $table->string('no_surat')->nullable();
            $table->integer('jumlah')->nullable();
            $table->date('tanggal_acc')->nullable();
            $table->date('tanggal_kerusakan')->nullable();
            $table->timestamp('tanggal_verif')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
            
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_barangs');
    }
};
