<?php

namespace Database\Factories;


use App\Models\produk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = produk::class;
    public function definition()
    {
        return [
            'nama'=>$this->faker->name(),
            'stock'=>$this->faker->randomNumber(3, true),
            'vp'=>$this->faker->randomFloat(1, 20, 30),
            'harga_produk'=>$this->faker->randomNumber(5,true),
            'SKU_produk'=>$this->faker->ean13(),
            'img_produk'=>'230208080440.webp',
            'deskripsi'=>$this->faker->paragraph(2)
        ];
    }
}
