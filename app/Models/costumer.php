<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costumer extends Model
{
    use HasFactory;
    protected $table = "costumer";
    protected $fillable =["nama","email","kode_cs"];
    // protected $guarded = "id_costumer";
    protected $primaryKey = 'id_costumer';

    public function transaksi()
    {
        return $this->hasMany(transaksi::class,'id_costumer','id_costumer');
    }
}
