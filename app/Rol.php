<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
   protected $table = "rol";

    protected $fillable = ["nombre"];

    public function user(){
        return $this->hasMany(User::class, 'rol_id');
    }
}
