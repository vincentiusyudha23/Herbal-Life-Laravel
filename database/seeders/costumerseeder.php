<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class costumerseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('costumer')->insert([
            'nama'=>'Agus Setiawan',
            'email'=>'agus@gmail.com',
            'kode_cs'=>'CS-001',
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        DB::table('costumer')->insert([
            'nama'=>'Cindy Stefani',
            'email'=>'cindy@gmail.com',
            'kode_cs'=>'CS-002',
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
