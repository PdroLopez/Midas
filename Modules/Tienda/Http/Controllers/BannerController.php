<?php

namespace Modules\Tienda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Tienda\Entities\Banner as banner;
use Storage;
use Session;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('tienda::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('tienda::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {/*
        $banner->save();
        return redirect::back();*/
        // $request->validate([

        //     'archivo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        // ]);

        $banner = new banner($request->all());

        if ($request->hasfile('archivo')) {

            $foto =  $request->file('archivo')->store('public/banner');
            $url = Storage::url($foto);
            $banner->ruta = $foto;
            $banner->save();

            Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
            return redirect::back();
        }
        else
        {
            return $request;
            $banner->archivo = '';
        }

        $banner->save();
        return redirect::back();





    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('tienda::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('tienda::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // $request->validate([

        //     'archivo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        // ]);

        $banner = banner::findOrFail($id);


        if ($request->hasFile('archivo')) {

            $banner->fill($request->all());
            $foto =  $request->file('archivo')->store('public/banner');
            $url = Storage::url($foto);
            $banner->ruta = $foto;
            $banner->save();
            Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
            return redirect::back();
         }
         else
         {
            $banner->fill($request->all());
            $banner->save();

            Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
            return redirect::back();
         }




    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $banner = banner::find($id);
        $banner->delete();
        return redirect::back();
    }
}
