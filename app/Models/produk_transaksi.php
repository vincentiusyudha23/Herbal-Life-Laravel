<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk_transaksi extends Model
{
    use HasFactory;
    protected $table = 'produk_transaksi';
    protected $primaryKey = 'id_produk_transaksi';
    protected $casts = [ 'created_at' => 'datetime:d-m-Y H:i:s'];

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class,'id_transaksi','id_transaksi');
    }
    public function produk()
    {
        return $this->belongsTo(produk::class,'id_produk','id_produk');
    }
}
