<?php

namespace Modules\Dgr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Modules\Dgr\Entities\PortalPagina as portal_pagina;
use Modules\Dgr\Entities\PortalMenu as portal_menu;

class PortalMenuController extends Controller
{
    public function index()
    {
        $portal_menu=portal_menu::all();
        $portal_menu_padres = portal_menu::where('sub_menu',0)->get()->pluck('nombre','id');
        $portal_pagina=portal_pagina::pluck('titulo','id');
        return view('dgr::portal.portal_menu.index',compact('portal_menu','portal_pagina','portal_menu_padres'));
    }

    public function store(Request $request)
    {
       $portal_menu= new portal_menu($request->all());
       $portal_menu->save();
       return redirect::back();
    }

    public function update(Request $request, $id)
    {
        $portal_menu=portal_menu::find($id);
        $portal_menu->fill($request->all());
        $portal_menu->save();
        return redirect::back();
    }

    public function destroy($id)
    {
        $portal_menu=portal_menu::find($id);
        $portal_menu->delete();
        return redirect::back(); 
    }
}
