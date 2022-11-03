<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $table = "qr_codes";
    protected $fillable = ['nombre'];
}
