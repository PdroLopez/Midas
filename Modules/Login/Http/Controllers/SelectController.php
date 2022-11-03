<?php

namespace Modules\Login\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Login\Entities\Region as region;
use Modules\Login\Entities\Comuna as comuna;
use App\Actions\VerificarRutAction;
use App\User;

class SelectController extends Controller
{
    public function getRegiones()
    {
        $region = region::all();
        return view('login::auth.register',compact('region'));
    }

    public function SelectComunas($id)
    {
        $comuna = Comuna::where('bk_regiones_id',$id)->get();
        return response()->json($comuna);
    }

    public function rut($rut)
    {
        $verificarRutAction = new VerificarRutAction();
        $a = $verificarRutAction->execute($rut);

        return response()->json($a);
    }
    public function mail_check($email)
    {
        $valor = false;
        $user = User::where('email',$email)->first();
        if ($user) {
            $valor = true;
        }
        return response()->json($valor);
    }
}
