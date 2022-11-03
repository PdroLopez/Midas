<?php

namespace Modules\Dgr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Dgr\Entities\Errors as errors;
use Log;
use DateTime;

class DgrController extends Controller
{
    public function index()
    {	
    	$log_info = array();

    	$directorio = opendir(storage_path('logs')); 
    	$convert = array();

    	while ($archivo = readdir($directorio)){
            if (!is_dir($archivo))
            {
                if ($archivo != '.gitignore') {
                    $data = file_get_contents(storage_path('logs/'.$archivo));
                    $convert = explode("\n", $data); 
                }
            }
        }

        foreach ($convert as $con) {
			$posicion_inicio = strpos($con, 'local.INFO:');
			if ($posicion_inicio === false) {

			} 
			else{
				$info = explode("local.INFO:", $con);

				array_push($log_info, array('fecha' => new DateTime(str_replace(['[',']'], '', $info[0])), 'info'=>$info[1] ));
        	}
    	}



    	$errors = errors::orderBy('id','desc')->get();
        return view('dgr::index',compact('errors'));
    }
}
