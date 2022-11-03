<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Session;
use Auth;
use App\User as users;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $users = new users($request->all());
        $users->password = bcrypt($request->password);
        $users->save();
        Session::put('mensaje',['content'=>'Registro creado exitosamente','type'=>'success']);
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $users = users::find($id);
        $users->fill($request->all());
        $users->save();
        Session::put('mensaje',['content'=>'Registro actualizado exitosamente','type'=>'success']);
        return redirect::back();
    }

    public function destroy($id)
    {
      dd('a');
        $users = users::find($id);
        $users->delete();
        Session::put('mensaje',['content'=>'Registro eliminado exitosamente','type'=>'success']);
        return redirect::back();
    }
}
