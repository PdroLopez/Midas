<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = "sl_solicitudes";
    protected $fillable = ['nombre','peso','cantidad','altura','largo','profundidad','motivo','Residuos_id','accesos_id','precio','clasificaciones_id','grupos_id','comentario','peso_interno','detalle_retiro','mt3','tipo_producto_id','otro_estado','destruccion_certificada','subcategoria_id','peso_bruto','peso_neto'];

    public function imagen()
    {
    	return $this->hasMany('App\ImagenSolicitud','sl_solicitudes_id');
    }
    public function residuos()
    {
        return $this->belongsTo('App\Residuo','Residuos_id');
    }
    public function accesos()
    {
        return $this->belongsTo('App\Acceso','accesos_id');
    }
    public function grupo()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Grupo','grupos_id');
    }
    public function clasificacion()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Clasificacion','clasificaciones_id');
    }
    public function boleta_solicitud()
    {
        return $this->hasMany('Modules\Workflow\Entities\BoletaSolicitud','sl_solicitudes_id');
    }
    public function tipo_producto()
    {
        return $this->belongsTo('Modules\Backend\Entities\TipoProducto','tipo_producto_id');
    }

    public function subcategoria()
    {
        return $this->belongsTo('Modules\Backend\Entities\SubCategoria','subcategoria_id');
    }

    public function calidad()
    {
        return $this->hasMany('Modules\Workflow\Entities\Calidad','sl_solicitudes_id');
    }
}
