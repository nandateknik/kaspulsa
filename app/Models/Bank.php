<?php

namespace App\Models;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    
    protected $table    = 'bank';
    protected $primaryKey = 'id_bank';
    protected $fillable = ['pelanggan_id','nama_bank','no_rekening','nama_rekening','saldo_akhir'];
    
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class,'pelanggan_id');
    }
}
