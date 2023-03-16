<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable=['total_harga','jumlah_item','nomor_invoice'];
    protected $primaryKey='id_transaksi';
    protected $casts = [ 'created_at' => 'datetime:d-m-Y H:i:s'];

    public function costumer()
    {
        return $this->belongsTo(costumer::class,'id_costumer','id_costumer');
    }
    public function produk_transaksi()
    {
        return $this->hasMany(produk_transaksi::class,'id_transaksi','id_transaksi');
    }
    public function produk()
    {
        return $this->belongsToMany(produk::class,'produk_transaksi','id_transaksi','id_produk')->withPivot('harga','diskon','jumlah_item','subtotal_harga');
    }
}
