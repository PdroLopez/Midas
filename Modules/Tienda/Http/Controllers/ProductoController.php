<?php

namespace Modules\Tienda\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Tienda\Entities\Producto as producto;
use Modules\Tienda\Entities\Comentarios as comentario;
use DB;
use Storage;

class ProductoController extends Controller
{

    public function index()
    {
        return view('tienda::index');
    }
    public function productoValoracion($id){

        $comentario = comentario::where('td_productos_id',$id)->where('baja',0)->get();
        $producto = producto::find($id);

        $division = comentario::where('td_productos_id',$id)->count();

        // $x = $ax/$ax;
        // dd($x);



        $count_1estrella=  comentario::where('td_productos_id',$id)->where('voto',1)->count();

        $count_2estrella=  comentario::where('td_productos_id',$id)->where('voto',2)->count();

        $count_3estrella=  comentario::where('td_productos_id',$id)->where('voto',3)->count();

        $count_4estrella=  comentario::where('td_productos_id',$id)->where('voto',4)->count();

        $count_5estrella=  comentario::where('td_productos_id',$id)->where('voto',5)->count();

        $count_votostotales = $count_1estrella+$count_2estrella+$count_3estrella+$count_4estrella+$count_5estrella;
        // $total_estrella = (($count_1estrella+1)+($count_2estrella*2)+($count_3estrella*3)
        // +($count_4estrella*4)+($count_5estrella*5))/($count_votostotales);

        // dd($count_votostotales,$count_1estrella,$count_2estrella,$count_3estrella,$count_4estrella,$count_5estrella,$total_estrella);

        // $sumatoria = DB::table("reviews")->sum('voto');


        if ($count_votostotales == 0) {
          $total_estrella=0;
        } else {
            $total_estrella = (($count_1estrella+1)+($count_2estrella*2)+($count_3estrella*3)
            +($count_4estrella*4)+($count_5estrella*5))/($count_votostotales);
        }

        if ($total_estrella != 0)
        {

            $numero5 = ($count_5estrella/$total_estrella)*10;
            $numero_cinco= ($numero5/2);
            $numero_5= intval($numero_cinco);

             // 4 Estrella
            $numero4 = ($count_4estrella/$total_estrella)*10;
            $numero_cuatro= ($numero4/2);
            $numero_4= intval($numero_cuatro);
            //3 Estrella
            $numero3 = ($count_3estrella/$total_estrella)*10;
            $numero_tres= ($numero3/2);
            $numero_3= intval($numero_tres);
            //2 Estrella
            $numero2 = ($count_2estrella/$total_estrella)*10;
            $numero_dos= ($numero2/2);
            $numero_2= intval($numero_dos);
            //1 Estrella
            $numero1 = ($count_1estrella/$total_estrella)*10;
            $numero_uno= ($numero1/2);
            $numero_1= intval($numero_uno);
        }
        else
        {
            $numero_1=0;
            $numero_2=0;
            $numero_3=0;
            $numero_4=0;
            $numero_5=0;
        }

        return view('tienda::Public.valoracion-producto',compact('numero_5','numero_4','numero_3','numero_2','numero_1','producto','comentario','total_estrella','count_votostotales'));




    }

    public function productoValoracionComentar($id){

        $producto = producto::find($id);
        $productos = producto::where('id',$id)->first();

        return view('tienda::private.comentarios.comentar',compact('productos','producto'));
    }


    public function store(Request $request)
    {      

            // dd($request->hasFile('imagen'));
        $producto = new producto($request->all());
        $producto->bk_estados_id = 13;
        $producto->save();

        if ($request->hasFile('imagen') || $request->hasFile('imagen2') || $request->hasFile('imagen3') || $request->hasFile('imagen4')) {

            $pro_new = producto::find($producto->id);

            if ($request->hasFile('imagen')){
                //imagen 1
                $nombre = 'imagen.'.$request->imagen->getClientOriginalExtension();
                Storage::putFileAs('productos/'.$producto->id.'/', $request->file('imagen'), $nombre);
                $pro_new->imagen = $nombre;
                // $imagen =  $request->file('imagen')->store('public/productos/'.$producto->id.'/imagen');
                // $url = Storage::url($imagen);
            }
            if ($request->hasFile('imagen2')){
                //imagen 2
                $imagen2 =  $request->file('imagen2')->store('public/productos/'.$producto->id.'/imagen2');
                $url = Storage::url($imagen2);
                $pro_new->imagen2 = $imagen2;
            }
            if ($request->hasFile('imagen3')){
                //imagen 3
                $imagen3 =  $request->file('imagen3')->store('public/productos/'.$producto->id.'/imagen3');
                $url = Storage::url($imagen3);
                $pro_new->imagen3 = $imagen3;
            }
            if ($request->hasFile('imagen4')){
                //imagen 4
                $imagen4 =  $request->file('imagen4')->store('public/productos/'.$producto->id.'/imagen4');
                $url = Storage::url($imagen4);
                $pro_new->imagen4 = $imagen4;
            }
            $pro_new->save();
        }

        return redirect::back();
            // $users = User::find(Auth::user()->id);
            // $users->fill($request->all());
            // $foto =  $request->file('foto')->store('public/perfil');
            // $url = Storage::url($foto);
            // $users->foto = $foto;
            // $users->save();
            // $dir = DireccionUsuario::create([
            //  'nombre'=> $request->direccion,
            //  'users_id'=> Auth::user()->id,
            //  'bk_comunas_id'=>$request->bk_comunas_id,
            //  'bk_regiones_id'=> $request->bk_regiones_id
            //  ]);
            // Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
            // return redirect::back();





        // if ($request->file('imagen')) {
        //     $imagen = $request->file('imagen');
        //     $imagenNombre = rand(1111111111, 9999999999).'.'.$imagen->getClientOriginalExtension();
        //     $imagen->move('public/img/productos/',$imagenNombre);
        // }
        // if ($request->file('imagen2')) {
        //     $imagen2 = $request->file('imagen2');
        //     $imagenNombre2 = rand(1111111111, 9999999999).'.'.$imagen2->getClientOriginalExtension();
        //     $imagen2->move('public/img/productos/',$imagenNombre2);
        // }
        // if ($request->file('imagen3')) {
        //     $imagen3 = $request->file('imagen3');
        //     $imagenNombre3 = rand(1111111111, 9999999999).'.'.$imagen3->getClientOriginalExtension();
        //     $imagen3->move('public/img/productos/',$imagenNombre3);
        // }
        // if ($request->file('imagen4')) {
        //     $imagen4 = $request->file('imagen4');
        //     $imagenNombre4 = rand(1111111111, 9999999999).'.'.$imagen4->getClientOriginalExtension();
        //     $imagen4->move('public/img/productos/',$imagenNombre4);
        // }
        // /////////////////


    }

    public function update(Request $request, $id)
    {
            $producto = producto::find($id);
            $producto->fill($request->all());
            if ($request->hasFile('imagen')){
                //imagen 1
                $nombre = 'imagen.'.$request->imagen->getClientOriginalExtension();
                dd(Storage::putFileAs('public/productos/'.$producto->id.'/', $request->file('imagen'), $nombre));
                $pro_new->imagen = $nombre;

                $imagen =  $request->file('imagen')->store('public/productos/'.$producto->id.'/imagen');
                $url = Storage::url($imagen);
                $producto->imagen = $imagen;
            }
            if ($request->hasFile('imagen2')){
                //imagen 2
                $imagen2 =  $request->file('imagen2')->store('public/productos/'.$producto->id.'/imagen2');
                $url = Storage::url($imagen2);
                $producto->imagen2 = $imagen2;
            }
            if ($request->hasFile('imagen3')){
                //imagen 3
                $imagen3 =  $request->file('imagen3')->store('public/productos/'.$producto->id.'/imagen3');
                $url = Storage::url($imagen3);
                $producto->imagen3 = $imagen3;
            }
            if ($request->hasFile('imagen4')){
                //imagen 4
                $imagen4 =  $request->file('imagen4')->store('public/productos/'.$producto->id.'/imagen4');
                $url = Storage::url($imagen4);
                $producto->imagen4 = $imagen4;
            }
            //save
            // $producto->bk_estados_id = 13;
            $producto->save();
            return redirect::back();
            //
            // $users->fill($request->all());
            // $foto =  $request->file('foto')->store('public/perfil');
            // $url = Storage::url($foto);
            // $users->foto = $foto;
            // $users->save();
            // $dir = DireccionUsuario::create([
            //  'nombre'=> $request->direccion,
            //  'users_id'=> Auth::user()->id,
            //  'bk_comunas_id'=>$request->bk_comunas_id,
            //  'bk_regiones_id'=> $request->bk_regiones_id
            //  ]);
            // Session::flash('mensaje',['content'=>'Datos Actualizados','type'=>'primary']);
            // return redirect::back();



    }

    public function destroy($id)
    {
        $producto = producto::find($id);
        $producto->delete();
        return redirect::back();
    }
}
