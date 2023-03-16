<?php

namespace App\Imports;

use App\Models\produk;
use Maatwebsite\Excel\Concerns\ToModel;

class ProdukImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new produk([
            'nama'=>$row[0],
            'vp'=>$row[1],
            'harga_50'=>$row[2],
            'harga_42'=>$row[3],
            'harga_35'=>$row[4],
            'harga_25'=>$row[5],
            'harga_produk'=>$row[6],
            'stok'=>$row[7],
            'SKU_produk'=>$row[8]
        ]);
    }
}
