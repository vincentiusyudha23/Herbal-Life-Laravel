<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukMasukSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produkmasuk')->insert([
            'jumlah_produk_masuk'=>'20',
            'produk_id'=>1,
            'created_at'=>date('Y-m-d H-i-s'),
            'updated_at'=>date('Y-m-d H-i-s')
        ]);
        DB::table('produkmasuk')->insert([
            'jumlah_produk_masuk'=>'30',
            'produk_id'=>2,
            'created_at'=>date('Y-m-d H-i-s'),
            'updated_at'=>date('Y-m-d H-i-s')
        ]);
        DB::table('produkmasuk')->insert([
            'jumlah_produk_masuk'=>'40',
            'produk_id'=>3,
            'created_at'=>date('Y-m-d H-i-s'),
            'updated_at'=>date('Y-m-d H-i-s')
        ]);
        DB::table('produkmasuk')->insert([
            'jumlah_produk_masuk'=>'50',
            'produk_id'=>4,
            'created_at'=>date('Y-m-d H-i-s'),
            'updated_at'=>date('Y-m-d H-i-s')
        ]);
    }
}
