<?php

namespace Modules\Dgr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Modules\Dgr\Entities\PrivateNav as private_nav;
use Modules\Dgr\Entities\RoleNav as role_nav;
use Modules\Dgr\Entities\Modulos as modulos;
use App\Role as rol;


class RoleNavController extends Controller
{
   public function index()
    {
        $role_nav = role_nav::all();
        $rol = rol::where('name','!=','DGR')->pluck('name','id');
        $private_nav = private_nav::where('sub_nav',0)->get()->pluck('nombre','id');

        $roles = rol::where('name','!=','DGR')->get();
        $modulos = modulos::pluck('nombre','id');

        return view('dgr::private.role_nav.index',compact('private_nav','role_nav','rol','roles','modulos'));
    }

    public function store(Request $request)
    {
        $role_nav = new role_nav($request->all());
        $role_nav->save();
        return redirect::back(); 
    }

    public function update(Request $request, $id)
    {
        $role_nav = role_nav::find($id);
        $role_nav->fill($request->all());
        $role_nav->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $role_nav = role_nav::find($id);
        $role_nav->delete();
        return redirect::back();
    }
}
