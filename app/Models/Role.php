<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    protected $table    = 'roles';
    protected $primaryKey = 'id_role';
    protected $fillable = ['role'];
    
    function user(){
        $this->belongsTo(User::class);
    }
}
