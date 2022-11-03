<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller;
use App\QrCode as qr;
use Session;
use PDF;
use QrCode;
use Modules\Workflow\Entities\Boleta;

class QrCodeController extends Controller
{
    public function buscar_code(Request $request)
    {
    	$codigo = qr::where('nombre',$request->codigo)->get();
    	if (count($codigo)>0) {
	        Session::flash('mensaje',['content'=>'Código encontrado, producto siendo reciclado','type'=>'primary']);
    	}else{
	        Session::flash('mensaje',['content'=>'Código no encontrado','type'=>'warning']);
    	}
        return Redirect::back();
    }
    public function pdf()
    {
        $codigo = substr(str_shuffle("0123456789abcdefghijklmno0123456789pqrstuvwxyz0123456789ABCDEFGHIJKL0123456789MNOPQRSTUVWXYZ"), 0, 20);
        //return view('PDF.pdf',compact('codigo'));
        $qr = QrCode::format('png')->size(300)->generate($codigo);
        $pdf = PDF::loadView('PDF.pdf',compact('codigo','qr'));
        return $pdf->stream('CertificadoReciclaje'.'.pdf'); 
    }

    public function BoletaQR($id){
        $boleta = Boleta::find($id);
        $url_usar = url('/');
        $link = $url_usar.'/ver/datos/bol/'.$boleta->codigo;
        $qr = QrCode::format('png')->size(300)->generate($link);
        $pdf = PDF::loadView('PDF.qrbol',compact('qr','boleta'));
        return $pdf->stream('QrBoleta'.$boleta->codigo.'.pdf'); 
    }

    public function BoletaVerQR($code){
        $boleta = Boleta::where('codigo',$code)->latest()->first();
        return view('solicitudes.ver-datos-retiro', compact('boleta'));
    }

}
