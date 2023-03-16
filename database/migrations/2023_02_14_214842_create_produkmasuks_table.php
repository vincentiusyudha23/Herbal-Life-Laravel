<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukmasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produkmasuk', function (Blueprint $table) {
            $table->id('id_produkmasuk');
            $table->timestamps();
            $table->integer('jumlah');
            $table->foreignId('id_produk')->references('id_produk')->on('produk')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produkmasuk');
    }
}
