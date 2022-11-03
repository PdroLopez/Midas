<?php

namespace Modules\Dgr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Modules\Dgr\Entities\Img as img;

class ImgController extends Controller
{

    public function index()
    {
        $img = img::all();
        return view('dgr::img.index',compact('img'));
    }

    public function store(Request $request)
    {

        if ($request->HasFile('archivo')) 
        {
            $src = $request->nombre.'.'.$request->archivo->getClientOriginalExtension();
            Storage::putFileAs('public/', $request->file('archivo'), $src);  
            $img = new img($request->all());
            $img->src = $src;
            $img->save();
        }
        return redirect::back();
    }

    public function update(Request $request, $id)
    {
         if ($request->HasFile('archivo')) 
        {
            $src = $request->nombre.'.'.$request->archivo->getClientOriginalExtension();
            Storage::putFileAs('public/', $request->file('archivo'), $src);  
            
            $img = img::find($id);
            $img->fill($request->all());
            $img->src = $src;
            $img->save();
        }
        else{
            $img = img::find($id);
            $array = explode('.', $img->src);
            Storage::move('public/'.$img->src, 'public/'.$request->nombre.'.'.$array[count($array)-1]);
            $img->fill($request->all());
            $img->src = $request->nombre.'.'.$array[count($array)-1];
            $img->save();
        }
        return redirect::back();
    }

    public function destroy($id)
    {
        $img = img::find($id);
        $img->delete();
        return redirect::back();
    }
}
