<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class produk extends Model
{
    use HasFactory;
    protected $table = "produk";
    protected $fillable = ['nama','vp','harga_produk','SKU_produk','img_produk','deskripsi','stok','harga_25','harga_35','harga_42','harga_50'];
    protected $primaryKey= 'id_produk';
    // protected $guarded= ['id_produk'];
    protected $casts = [ 'created_at' => 'datetime:d-m-Y H-i-s'];

    public function produkmasuk()
    {
        return $this->hasMany(produkmasuk::class,'id_produk','id_produk');
    }

    public function transaksi()
    {
        return $this->belongsToMany(transaksi::class,'produk_transaksi','id_produk','id_transaksi')->withPivot('harga','jumlah_item','subtotal_harga');
    }
}
