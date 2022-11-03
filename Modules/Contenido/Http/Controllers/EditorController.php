<?php

namespace Modules\Contenido\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Contenido\Entities\Noticia as noticia;
use Modules\Contenido\Entities\Review as review;
use Modules\Contenido\Entities\Categoria;
use Modules\Contenido\Entities\ImagenSlider;
use Modules\Contenido\Entities\CategoriasNoticias as categoria_noticias;

use Session;
use Storage;
use Illuminate\Support\Facades\Redirect;

class EditorController extends Controller
{
    public function slider()
    {
        $categorias = Categoria::all();
        $imagenes = ImagenSlider::all();
        return view('contenido::private.editor.slider',compact('categorias','imagenes'));
    }

    public function noticias(){
        $noticia = noticia::orderBy('id', 'DESC')->paginate(5);
        $categorias = Categoria::all();
        $categorias_a = categoria_noticias::all();
        $review = review::all();
        return view('contenido::private.editor.noticias',compact('noticia','review','categorias','categorias_a'));
    }

    public function categoria()
    {
        $categoria_noticia = categoria_noticias::all();
        // dd($categoria_noticia);
        return view('contenido::private.editor.categoria',compact('categoria_noticia'));

    }
    public function store(Request $request)
    {
        try {
            $imgNombre = null;
            if($request->file('archivo')){

                $archivo =  $request->file('archivo')->store('public/slider');
                $url = Storage::url($archivo);
                ImagenSlider::create([
                    'ruta'=> $archivo,
                    'bk_estados_id' => 13,
                    'ct_categoria_slider_id' => $request->ct_categoria_slider_id,
                    'texto_principal' => $request->texto_principal,
                    'texto_secundario' => $request->texto_secundario,
                    'btn_texto' => $request->btn_texto,
                    'btn_url' => $request->btn_url,
                    'atributos'=>$request->atributos,
                    'active'=>$request->active,
                ]);
            }
            else{
                ImagenSlider::create([
                    'bk_estados_id' => 13,
                    'ct_categoria_slider_id' => $request->ct_categoria_slider_id,
                    'texto_principal' => $request->texto_principal,
                    'texto_secundario' => $request->texto_secundario,
                    'btn_texto' => $request->btn_texto,
                    'btn_url' => $request->btn_url,
                    'atributos'=>$request->atributos,
                    'active'=>$request->active,
                ]);
            }

            Session::flash('mensaje',['content'=>'Imagen agregada exitosamente','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }
    public function destroy($id)
    {
        try {
            $ImagenSlider = ImagenSlider::find($id);
            $ImagenSlider->delete();
            return back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();

        }
    }
    public function update(Request $request, $id)
    {
        if ($request->hasFile('archivo')) {
            $img = ImagenSlider::find($id);
            $img->fill($request->all());
            $foto =  $request->file('archivo')->store('public/archivo');
            $url = Storage::url($foto);
            $img->ruta = $foto;
            $img->save();
            Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
            return redirect::back();
         }
         else
         {
            $img = ImagenSlider::find($id);
            $img->fill($request->all());
            // $foto =  $request->file('archivo')->store('public/archivo');
            // $url = Storage::url($foto);
            // $img->foto = $foto;
            $img->save();

            Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
            return redirect::back();

         }
    }
    public function bajar_publicacion($id)
    {
        try {
            ImagenSlider::find($id)->update([
                'bk_estados_id'=>13
            ]);
            Session::flash('mensaje',['content'=>'Imagen bajada','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }
    public function publicar($id)
    {
        try {
            ImagenSlider::find($id)->update([
                'bk_estados_id'=>12
            ]);
            Session::flash('mensaje',['content'=>'Imagen publicada','type'=>'primary']);
            return redirect::back();
        } catch (Exception $e) {
            Session::flash('mensaje',['content'=>'Surgio un problema inesperado, intente mas tarde','type'=>'danger']);
            return redirect::back();
        }
    }

}
