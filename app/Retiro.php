<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retiro extends Model
{
    protected $table = "retiros";
    protected $fillable = ["archivo","boletas_id","camionero_id"];

    public function boleta()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Boleta','boletas_id');
    }

    public function camionero()
    {
        return $this->belongsTo('App\User','camionero_id');
    }
}
