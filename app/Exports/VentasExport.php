<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Modules\Tienda\Entities\Ventas;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Modules\Tienda\Entities\VentaFuera;

class VentasExport implements FromCollection,WithHeadings,WithColumnWidths
{
    public function collection()
    {
        $ventas = VentaFuera::leftjoin('ventas', 'ventas_fuera.id', '=', 'ventas.ventas_fuera_id')
        ->leftjoin('transacciones', 'ventas_fuera.id', '=', 'transacciones.ventas_fuera_id')
        ->leftjoin('bk_regiones', 'ventas_fuera.bk_regiones_id', '=', 'bk_regiones.id')
        ->leftjoin('bk_comunas', 'ventas_fuera.bk_comunas_id', '=', 'bk_comunas.id')
        ->leftjoin('td_productos', 'ventas.td_productos_id', '=', 'td_productos.id')
        ->leftjoin('bk_despacho', 'ventas.bk_despacho_id', '=', 'bk_despacho.id')
        ->leftjoin('bk_cobertura', 'bk_despacho.bk_cobertura_id', '=', 'bk_cobertura.id')
        ->leftjoin('bk_estatus', 'ventas.bk_estatus_id', '=', 'bk_estatus.id')
        ->where('ventas.historial',0)
        ->select(
            'ventas.id as IDventa',
            'ventas_fuera.nombre as nombre_venta',
            'ventas_fuera.telefono',
            'ventas_fuera.correo',
            'bk_regiones.nombre as region',
            'bk_comunas.nombre as comuna',
            'ventas_fuera.direccion',
            'ventas_fuera.detalle',
            'td_productos.nombre as producto',
            'ventas.cantidad',
            'td_productos.precio',
            'ventas.tipo_pago',
            'ventas.estado as estado_venta',
            'ventas.codigo as codigo_venta',
            'ventas.total as total_venta',
            'ventas.created_at as fecha_venta',
            'bk_cobertura.nombre as cobertura',
            'bk_despacho.costo as valor_despacho',
            'bk_estatus.nombre as estatus',
            'transacciones.id as IDTransaccion',
            'transacciones.total as total_transaccion',
            'transacciones.codigo as codigo_transaccion',
            'transacciones.created_at as fecha_transaccion',
            'transacciones.estado as estado_transaccion',
            'transacciones.tipo_tarjeta',
            'transacciones.typecode',
            'transacciones.n_tarjeta',
            'transacciones.cuotas'
        )->get();
       	return $ventas;
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
