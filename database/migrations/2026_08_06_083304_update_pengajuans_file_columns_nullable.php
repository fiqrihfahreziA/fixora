<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    

    /**
     * Reverse the migrations.
     */
    public function up()
{
    Schema::table('pengajuans', function (Blueprint $table) {
        $table->string('foto_barang')->nullable()->change();
        $table->string('penawaran_harga')->nullable()->change();
        $table->string('data_kerusakan')->nullable()->change();
    });
}

public function down()
{
    Schema::table('pengajuans', function (Blueprint $table) {
        $table->string('foto_barang')->nullable(false)->change();
        $table->string('penawaran_harga')->nullable(false)->change();
        $table->string('data_kerusakan')->nullable(false)->change();
    });
}
};
