<?php

namespace Modules\Dgr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\User as usuarios;
use App\Role as roles;
class UsuariosController extends Controller
{

    public function index()
    {
        $roles = roles::pluck('name','id');
        $usuarios=usuarios::all();
        return view('dgr::perfilamiento.usuarios.index',compact('usuarios','roles'));
    }

    public function store(Request $request)
    {
        $usuarios= new usuarios($request->all());
        $usuarios->password = bcrypt($request->password);
        $usuarios->save();
        return redirect::back();
    }
}
