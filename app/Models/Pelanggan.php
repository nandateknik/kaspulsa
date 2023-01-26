<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    
    protected $table    = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = ['nama_pelanggan','no_telp','status','nama_bank','no_rekening'];

}
