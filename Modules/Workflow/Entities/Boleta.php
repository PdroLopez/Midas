<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    protected $table = "boletas";
    protected $fillable = ['total','codigo','empresas_id','bk_estados_id','users_id','horarios_id','horarios_dias_id','bk_direcciones_user_id','bk_direcciones_empresas_id','retiro_propio','fecha_hora','camionero_id','comentario_cancelar','camiones_id','creador_id','marcas_id','observaciones','nombre','telefono','correo','comuna_id','direccion_rc','detalle','tipo_pago','n_guia_despacho','grua','encargado_grua','tipo_servicio_id','destino','destino_id','estacion_camion','desde','hasta','observacion_retirado','n_contenedor','destruccion_certificada'];

    public function user()
    {
        return $this->belongsTo('App\User','users_id');
    }
    public function creador()
    {
        return $this->belongsTo('App\User','creador_id');
    }

    public function chofer()
    {
        return $this->belongsTo('App\User','camionero_id');
    }
    public function camiones()
    {
        return $this->belongsTo('Modules\Backend\Entities\Camion','camiones_id');
    }
	public function estado()
    {
        return $this->belongsTo('Modules\Backend\Entities\Estados','bk_estados_id');
    }
    public function empresas()
    {
        return $this->belongsTo('App\Empresa','empresas_id');
    }
    public function horario()
    {
        return $this->belongsTo('App\Horario','horarios_id');
    }
    public function dia()
    {
        return $this->belongsTo('App\HorarioDia','horarios_dias_id');
    }
    public function solicitudes()
    {
        return $this->hasMany('Modules\Workflow\Entities\BoletaSolicitud','boletas_id');
    }
    public function marcas()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Marcas','marcas_id');
    }

    public function direccion()
    {
        return $this->belongsTo('App\DireccionUsuario','bk_direcciones_user_id');
    }
    public function direccion_empresa()
    {
        return $this->belongsTo('Modules\Backend\Entities\DireccionEmpresa','bk_direcciones_empresas_id');
    }

    public function comuna()
    {
        return $this->belongsTo('Modules\Backend\Entities\Comunas','comuna_id');
    }

    public function tipo_servicio()
    {
        return $this->belongsTo('Modules\Backend\Entities\TipoServicio','tipo_servicio_id');
    }

    public function destino_resi()
    {
        return $this->belongsTo('Modules\Backend\Entities\Destino','destino_id');
    }

    public function venta()
    {
        return $this->HasMany('Modules\Tienda\Entities\Ventas','boletas_id');
    }

    public function retiro()
    {
        return $this->HasMany('App\Retiro','boletas_id');
    }

    public function ticket()
    {
        return $this->HasMany('Modules\Workflow\Entities\Ticket','boletas_id');
    }

    public function calidad()
    {
        return $this->HasMany('Modules\Workflow\Entities\Calidad','boletas_id');
    }
}
