<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    protected $table    = 'roles';
    protected $primaryKey = 'id_roles';
    protected $fillable = ['role'];
    
    function user(){
        return $this->belongsTo(User::class,'user_role','id_roles');
    }
}
