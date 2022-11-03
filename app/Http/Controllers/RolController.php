<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Session;
use Auth;
use App\Rol as rol;

class RolController extends Controller
{

	public function store(Request $request)
    {
        $rol = new rol($request->all());
        $rol->save();
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $rol = rol::find($id);
        $rol->fill($request->all());
        $rol->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $rol = rol::find($id);
        $rol->delete();
        return redirect::back();
    }
}
