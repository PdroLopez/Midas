<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Backend\Entities\Comunidad as comunidad;
use Storage;
class ComunidadController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('backend::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('backend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        if ($request->hasFile('foto')) {

            $comunidad = new comunidad($request->all());

            $foto =  $request->file('foto')->store('public/comunidad');
            $url = Storage::url($foto);
            $comunidad->foto = $foto;
            $comunidad->save();
            return redirect::back();
        }
         else
         {
            $comunidad = new comunidad($request->all());
            $comunidad->save();
            return redirect::back();
         }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('backend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {


        if ($request->hasFile('foto')) {
            $comunidad = comunidad::find($id);
            $comunidad->fill($request->all());
            $foto =  $request->file('foto')->store('public/comunidad');
            $url = Storage::url($foto);
            $comunidad->foto = $foto;
            $comunidad->save();
            return redirect::back();
         }
         else
         {
            $comunidad = comunidad::find($id);
            $comunidad->fill($request->all());
            // $foto =  $request->file('foto')->store('public/comunidad');
            // $url = Storage::url($foto);
            // $comunidad->foto = $foto;
            $comunidad->save();
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
        $comunidad = comunidad::find($id);
        $comunidad->delete();
        return redirect::back();
    }
}
