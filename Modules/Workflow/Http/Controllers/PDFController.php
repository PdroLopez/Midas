<?php

namespace Modules\Workflow\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Workflow\Entities\Boleta as b;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Redirect;
use Session;
use Modules\Workflow\Entities\Ticket;
use Modules\Backend\Entities\TipoProducto;
use Excel;
use App\Exports\OrdenesServicioExport;



class PDFController extends Controller
{

    public function verPDF($id)
    {
        $boleta = b::where('id',$id)->get();

        return view('workflow::private.pdf',compact('boleta'));
    }
    public function DescargarPDF($id)
    {
        $boleta = b::find($id);
        $pdf = PDF::loadview('workflow::private.pdf',compact('boleta'));

        return $pdf->download('certificado'.$boleta->codigo.'.pdf');
    }

    public function DescargarTicketPDF($id)
    {
        $ticket = Ticket::where('boletas_id',$id)->first();
        $boleta = b::find($id);
        $tipo_producto = TipoProducto::where('activo',0)->get();

        if ($ticket != null) {
            $pdf = PDF::loadview('workflow::private.pesajes.pdf_ticket',compact('ticket','boleta','tipo_producto'));
            return $pdf->download('TicketPesajeN'.$ticket->id.'.pdf');
        }else{
            Session::flash('mensaje',['content'=>'No tiene Ticket de Pesaje','type'=>'primary']);
            return redirect::back();
        }
    }

    public function ExcelSolicitud(){
        return Excel::download(new OrdenesServicioExport, 'ordenesservicio.xlsx');
    }
}
