<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    
    protected $table    = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['pelanggan_id','produk_id','jenis_payment','saldo_akhir','waktu'];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class,'pelanggan_id');
    }
    public function produk(){
        return $this->belongsTo(Produk::class,'produk_id');
    }
}
