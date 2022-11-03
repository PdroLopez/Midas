<?php

namespace Modules\Agendamiento\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Agendamiento\Entities\Seguimiento as seguimiento;

class SeguimientoController extends Controller
{
 
    public function store(Request $request){
        $seguimiento = new seguimiento($request->all());
        $seguimiento->save();
        return redirect::back(); 
    }

    public function update(Request $request, $id){
        $seguimiento = seguimiento::find($id);
        $seguimiento->fill($request->all());
        $seguimiento->save();
        return redirect::back();
    }

    public function destroy($id){
        $seguimiento = seguimiento::find($id);
        $seguimiento->delete();
        return redirect::back();
    }

}
