<?php

namespace Modules\Contenido\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Contenido\Entities\Noticia as noticia;
use Modules\Contenido\Entities\Imagen as imagen;
use Storage;
use Session;

class NoticiaController extends Controller
{

    public function store(Request $request)
    {
        // dd($request->all());

        //$tags = explode(',', $request->tags);
        $slug = preg_replace('/[^A-Za-z0-9-]+/','-',$request->titulo);
        $slug = strtolower($slug);

        $imagenNomDetalle = null;
        $imagenNomPortada = null;
        $imagenNomDescripcion = null;
        $imagenNomMiniatura = null;

        $noticia = new noticia($request->all());
        $categoriaaaa = json_encode($request->categorias);
        $noticia->categoria = $categoriaaaa;

        $noticia->tags = $request->tags;
        $noticia->slug = $slug;
        //dd($noticia);
        $noticia->save();

        if($request->file('imagenDetalle')){

            $imagenDetalle =  $request->file('imagenDetalle')->store('public/noticias/imagenDetalle');
            $url = Storage::url($imagenDetalle);

        }
        if ($request->file('imagenPortada')) {
            $imagenPortada =  $request->file('imagenPortada')->store('public/noticias/imagenPortada');
            $url = Storage::url($imagenPortada);
        }
        if ($request->file('imagenDescripcion')) {

            $imagenDescripcion =  $request->file('imagenDescripcion')->store('public/noticias/imagenDescripcion');
            $url = Storage::url($imagenDescripcion);
        }
        if ($request->file('imagenMiniatura')) {


            $imagenMiniatura =  $request->file('imagenMiniatura')->store('public/noticias/imagenMiniatura');
            $url = Storage::url($imagenMiniatura);
        }

        imagen::create([
            'img_descripcion'=> $imagenDescripcion,
            'miniatura'=> $imagenMiniatura,
            'detalle'=> $imagenDetalle,
            'portada'=>$imagenPortada,
            'ct_noticias_id'=>$noticia->id
        ]);


        return redirect::back();

    }

    public function show($id)
    {
        return view('contenido::show');
    }

    public function edit($id)
    {
        return view('contenido::edit');
    }
    public function cambiar($id)
    {
        $imagen = imagen::where('ct_noticias_id',$id)->get();
        return view('contenido::private.editor.prueba',compact('imagen'));

    }
    public function editar_imagen(Request $request, $id)
    {
        $noticia = imagen::find($id);
        $noticia->fill($request->all());


        $imagenDetalle =  $request->file('imagenDetalle')->store('public/noticias/imagenDetalle');
        $url = Storage::url($imagenDetalle);
        $noticia->detalle =$imagenDetalle;


        $imagenPortada =  $request->file('imagenPortada')->store('public/noticias/imagenPortada');
        $url = Storage::url($imagenPortada);
        $noticia->portada =$imagenPortada;

        $imagenDescripcion =  $request->file('imagenDescripcion')->store('public/noticias/imagenDescripcion');
        $url = Storage::url($imagenDescripcion);
        $noticia->img_descripcion =$imagenDescripcion;

        $imagenMiniatura =  $request->file('imagenMiniatura')->store('public/noticias/imagenMiniatura');
        $url = Storage::url($imagenMiniatura);
        $noticia->miniatura =$imagenMiniatura;

        $noticia->save();
        Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
        return redirect::back();




















    }

    public function update(Request $request, $id)
    {
        $imagenNomDetalle = null;
        $imagenNomPortada = null;
        $imagenNomDescripcion = null;
        $imagenNomMiniatura = null;



        if ($request->hasFile('imagenDetalle')) {

            $noticia = noticia::find($id);
            $noticia->fill($request->all());
            $noticia->save();
            $imagenDetalle =  $request->file('imagenDetalle')->store('public/noticias/imagenDetalle');
            $url = Storage::url($imagenDetalle);

            imagen::update([
                'img_descripcion'=> $imagenNomDescripcion,
                'miniatura'=> $imagenNomMiniatura,
                'detalle'=> $imagenNomDetalle,
                'portada'=>$imagenNomPortada,
                'ct_noticias_id'=>$noticia->id
            ]);

            Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
            return redirect::back();
         }
         else
         {
             $noticia = noticia::find($id);
             $noticia->fill($request->all());
            // $foto =  $request->file('foto')->store('public/perfil');
             //$url = Storage::url($foto);
            // $users->foto = $url;
             $noticia->save();
             Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
             return redirect::back();
         }

         if ($request->hasFile('imagenPortada')) {

            $noticia = noticia::find($id);
            $noticia->fill($request->all());
            $noticia->save();
            $imagenPortada =  $request->file('imagenPortada')->store('public/noticias/imagenPortada');
            $url = Storage::url($imagenPortada);

            imagen::update([
                'img_descripcion'=> $imagenNomDescripcion,
                'miniatura'=> $imagenNomMiniatura,
                'detalle'=> $imagenNomDetalle,
                'portada'=>$imagenNomPortada,
                'ct_noticias_id'=>$noticia->id
            ]);

            Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
            return redirect::back();
         }
         else
         {
             $noticia = noticia::find($id);
             $noticia->fill($request->all());
            // $foto =  $request->file('foto')->store('public/perfil');
             //$url = Storage::url($foto);
            // $users->foto = $url;
             $noticia->save();
             Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
             return redirect::back();
         }

         if ($request->hasFile('imagenDescripcion')) {

            $noticia = noticia::find($id);
            $noticia->fill($request->all());
            $noticia->save();
            $imagenDescripcion =  $request->file('imagenDescripcion')->store('public/noticias/imagenDescripcion');
            $url = Storage::url($imagenDescripcion);

            imagen::update([
                'img_descripcion'=> $imagenNomDescripcion,
                'miniatura'=> $imagenNomMiniatura,
                'detalle'=> $imagenNomDetalle,
                'portada'=>$imagenNomPortada,
                'ct_noticias_id'=>$noticia->id
            ]);

            Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
            return redirect::back();
         }
         else
         {
             $noticia = noticia::find($id);
             $noticia->fill($request->all());
            // $foto =  $request->file('foto')->store('public/perfil');
             //$url = Storage::url($foto);
            // $users->foto = $url;
             $noticia->save();
             Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
             return redirect::back();
         }
         if ($request->hasFile('imagenMiniatura')) {

            $noticia = noticia::find($id);
            $noticia->fill($request->all());
            $noticia->save();
            $imagenDescripcion =  $request->file('imagenMiniatura')->store('public/noticias/imagenMiniatura');
            $url = Storage::url($imagenMiniatura);

            imagen::update([
                'img_descripcion'=> $imagenNomDescripcion,
                'miniatura'=> $imagenNomMiniatura,
                'detalle'=> $imagenNomDetalle,
                'portada'=>$imagenNomPortada,
                'ct_noticias_id'=>$noticia->id
            ]);

            Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
            return redirect::back();
         }
         else
         {
             $noticia = noticia::find($id);
             $noticia->fill($request->all());
            // $foto =  $request->file('foto')->store('public/perfil');
             //$url = Storage::url($foto);
            // $users->foto = $url;
             $noticia->save();
             Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
             return redirect::back();
         }
    }

    public function destroy($id)
    {

        $noticia = noticia::find($id);
        $noticia->delete();
        return redirect::back();
    }
}
