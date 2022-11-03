<?php

namespace Modules\Dgr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Modules\Dgr\Entities\PrivateNav as private_nav;

class PrivateNavController extends Controller
{
    public function index()
    {
        $private_nav = private_nav::all();
        $nav_padre = private_nav::where('sub_nav',0)->get()->pluck('nombre','id');
        return view('dgr::private.private_nav.index',compact('private_nav','nav_padre'));
    }

    public function store(Request $request)
    {
        $private_nav = new private_nav($request->all());
        $private_nav->save();
        return redirect::back(); 
    }

    public function update(Request $request, $id)
    {
        $private_nav = private_nav::find($id);
        $private_nav->fill($request->all());

        if ($request->sub_nav==1) {
            $private_nav->sub_nav = 1;
        }
        else{
            $private_nav->sub_nav = 0;
        }

        if ($private_nav->private_nav_id == null) {
            $private_nav->sub_nav = 0;
        }
        $private_nav->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $private_nav = private_nav::find($id);
        $private_nav->delete();
        return redirect::back();
    }
}
