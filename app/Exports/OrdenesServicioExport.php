<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Modules\Tienda\Entities\Ventas;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Modules\Tienda\Entities\VentaFuera;
use Modules\Workflow\Entities\Boleta;

class OrdenesServicioExport implements FromCollection,WithHeadings,WithColumnWidths
{
    public function collection()
    {
        $ordenes = Boleta::leftjoin('empresas', 'empresas.id', '=', 'boletas.empresas_id')
        ->leftjoin('users', 'users.id', '=', 'boletas.users_id')
        ->leftjoin('boleta_solicitud', 'boleta_solicitud.boletas_id', '=', 'boletas.id')
        ->leftjoin('sl_solicitudes', 'sl_solicitudes.id', '=', 'boleta_solicitud.sl_solicitudes_id')
        ->select(
            'boletas.*',
            'empresas.*',
            'users.*',
            'boleta_solicitud.*',
            'sl_solicitudes.*'
        )->get();

        dd($ordenes);
       	return $ordenes;
    }

    public function headings(): array
    {
        return [
            'Id venta',
            'Nombre',
            'Telefono',
            'Correo',
            'Region',
            'Comuna',
            'Direccion',
            'Detalle',
            'Nombre Producto',
            'Cantidad',
            'Costo Producto',
            'Tipo Pago',
            'Estado',
            'Codigo Venta',
            'Total Venta',
            'Fecha Venta',
            'Cobertura',
            'Despacho',
            'Estatus',
            'Id transaccion',
            'Total transaccion',
            'Codigo transaccion',
            'Fecha transaccion',
            'Tipo Tarjeta',
            'typecode',
            'Ultimos 4 NTarjeta',
            'cuotas'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'B' => 30,
            'C' => 15,
            'D' => 30,            
            'E' => 30,            
            'F' => 20,            
            'G' => 30,            
            'H' => 30,            
            'I' => 15,                        
            'L' => 15,            
            'M' => 15,            
            'N' => 15,            
            'P' => 20,            
            'Q' => 15,            
            'S' => 15,            
            'V' => 20,            
            'W' => 15,            
            'X' => 15,          
        ];
    }
}
