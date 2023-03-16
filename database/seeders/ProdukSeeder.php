<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produk')->insert([
            'nama'=>'Formula 1 - Dutch Chocolate  Nutritional Shake Mix',
            'vp'=>'20',
            'harga_produk'=>'561000',
            'SKU_produk'=>'PRD-001',
            'created_at'=>date('Y-m-d H-i-s'),
            'updated_at'=>date('Y-m-d H-i-s')
        ]);
        DB::table('produk')->insert([
            'nama'=>'Herbal Aloe Concentrate',
            'vp'=>'24.95',
            'harga_produk'=>'517000',
            'SKU_produk'=>'PRD-002',
            'created_at'=>date('Y-m-d H-i-s'),
            'updated_at'=>date('Y-m-d H-i-s')
        ]);
        DB::table('produk')->insert([
            'nama'=>'Herbal  Concentrate',
            'vp'=>'21.5',
            'harga_produk'=>'528000',
            'SKU_produk'=>'PRD-003',
            'created_at'=>date('Y-m-d H-i-s'),
            'updated_at'=>date('Y-m-d H-i-s')
        ]);
    }
}
