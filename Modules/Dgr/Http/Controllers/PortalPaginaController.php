<?php

namespace Modules\Dgr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Modules\Dgr\Entities\PortalPagina as portal_pagina;


class PortalPaginaController extends Controller
{
    public function index()
    {
        $portal_pagina=portal_pagina::all();
        return view('dgr::portal.portal_pagina.index',compact('portal_pagina'));
    }

    public function create()
    {
        return view('dgr::portal.portal_pagina.create');
    }

    public function store(Request $request)
    {
        $portal_pagina= new portal_pagina($request->all());
        $portal_pagina->save();
        return redirect::to('dgr/portal/pagina');
    }

    public function edit($id)
    {
        $portal_pagina = portal_pagina::find($id);
        return view('dgr::portal.portal_pagina.edit',compact('portal_pagina'));
    }



    public function update(Request $request, $id)
    {
        $portal_pagina=portal_pagina::find($id);
        $portal_pagina->fill($request->all());
        $portal_pagina->save();
        return redirect::to('dgr/portal/pagina');
      
    }

    public function destroy($id)
    {
        $portal_pagina=portal_pagina::find($id);
        $portal_pagina->delete();
        return redirect::back();
    }
}
