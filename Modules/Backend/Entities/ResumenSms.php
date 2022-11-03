<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class ResumenSms extends Model
{
    protected $table="resumen_sms";
    protected $fillable=['telefono','mensaje','rut','estado'];
}
