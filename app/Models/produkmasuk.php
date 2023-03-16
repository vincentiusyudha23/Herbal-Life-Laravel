<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produkmasuk extends Model
{
    use HasFactory;
    protected $table = "produkmasuk";
    protected $fillable = ['jumlah','id_produk'];
    protected $primaryKey = 'id_produkmasuk';
    protected $casts = [ 'created_at' => 'datetime:d-m-Y H:i:s'];

    public function produk()
    {
        return $this->belongsTo(produk::class,'id_produk','id_produk');
    }
}
