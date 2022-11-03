<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

use Freshwork\Transbank\RedirectorHelper;
use Freshwork\Transbank\WebpayNormal;
use Freshwork\Transbank\WebpayOneClick;
use Freshwork\Transbank\CertificationBagFactory;  
use Freshwork\Transbank\TransbankServiceFactory;
use Modules\Tienda\Entities\Transaccion;

use Log;
use Sessions;

class PaywebpayController extends Controller
{

    public function transaction($transactionCodigo, WebpayNormal $webpayNormal){
        Log::info('Proceso de paso');

    }

}    
    

