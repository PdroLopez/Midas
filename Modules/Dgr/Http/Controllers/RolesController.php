<?php

namespace Modules\Dgr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Role as rol;

class RolesController extends Controller
{

    public function index()
    {
        $roles = rol::all();
        return view('dgr::perfilamiento.roles.index',compact('roles'));
    }

    public function store(Request $request)
    {
        $roles = new rol($request->all());
        $roles->save();
        return redirect::back(); 
    }

    public function update(Request $request, $id)
    {
        $roles=rol::find($id);
        $roles->fill($request->all());
        $roles->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $roles=rol::find($id);
        
        $roles->delete();
        return redirect::back();
    }
}
