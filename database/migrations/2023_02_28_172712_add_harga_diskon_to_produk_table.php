<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHargaDiskonToProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->decimal('harga_25',15,2);
            $table->decimal('harga_35',15,2);
            $table->decimal('harga_42',15,2);
            $table->decimal('harga_50',15,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('harga_25');
            $table->dropColumn('harga_35');
            $table->dropColumn('harga_42');
            $table->dropColumn('harga_50');
        });
    }
}
