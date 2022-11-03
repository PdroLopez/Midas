<?php

namespace Modules\Agendamiento\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Agendamiento\Entities\Agendamiento as agendamiento;
use Modules\Agendamiento\Entities\HorasDisponibles as horas;
use Modules\Agendamiento\Entities\Recursos as recursos;

class AgendamientoController extends Controller
{
    
    public function index(){
        return view('agendamiento::index');
    }
 
    public function store(Request $request){
        $agendamiento = new agendamiento($request->all());
        $agendamiento->save();
        return redirect::back(); 
    }

    public function update(Request $request, $id){
        $agendamiento = agendamiento::find($id);
        $agendamiento->fill($request->all());
        $agendamiento->save();
        return redirect::back();
    }

    public function destroy($id){
        $agendamiento = agendamiento::find($id);
        $agendamiento->delete();
        return redirect::back();
    }

    public function agendamiento(){
        $agendamientos = agendamiento::all();
        return view('agendamiento::private.agendamiento.index',compact('agendamientos'));
    }

    public function horas_disponibles(){
        $horas = horas::all();
        return view('agendamiento::private.horasdisponibles.index',compact('horas'));
    }

    public function recursos(){
        $recursos = recursos::all();
        return view('agendamiento::private.recursos.index',compact('recursos'));
    }

}
