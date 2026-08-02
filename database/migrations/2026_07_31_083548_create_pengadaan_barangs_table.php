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
        Schema::create('pengadaan_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('dasar_usulan');
            $table->string('nama_barang');
            $table->string('spesifikasi_teknis')->nullable();
            $table->text('satuan')->nullable();
            // $table->text('jumlah')->nullable();
            $table->string('perkiraanharga')->nullable();
            $table->string('total_harga')->nullable();
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
        Schema::dropIfExists('pengadaan_barangs');
    }
};
