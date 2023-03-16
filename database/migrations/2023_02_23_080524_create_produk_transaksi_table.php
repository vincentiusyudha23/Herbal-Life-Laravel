<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_transaksi', function (Blueprint $table) {
            $table->id('id_produk_transaksi');
            $table->timestamps();
            $table->string('diskon');
            $table->decimal('harga',15,2);
            $table->unsignedSmallInteger('jumlah_item');
            $table->decimal('subtotal_harga',15,2);
            $table->timestamp('tanggal_transaksi')->nullable();

            $table->foreignId('id_transaksi')->references('id_transaksi')->on('transaksi')->cascadeOnDelete();
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
        Schema::dropIfExists('produk_transaksi');
    }
}
