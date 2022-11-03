<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Dgr\Entities\Configuracion as config;

class RedireccionController extends Controller
{
    public function redirect()
    {
    	$config = config::find(31);
    	return Redirect::to($config->valor);
    }
}
