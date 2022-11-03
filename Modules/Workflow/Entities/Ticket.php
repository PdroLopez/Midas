<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "ticket";
    protected $fillable = ['diferencia_peso_kg','diferencia_peso','tipo_producto_id','otro_estado','observaciones','descargado_por','preparado_por','fecha_entrega','boletas_id'];

    public function ticket_estado()
    {
        return $this->HasMany('Modules\Workflow\Entities\TicketTipoProducto','ticket_id');
    }

    public function boleta()
    {
        return $this->belongsTo('Modules\Workflow\Entities\Boleta','boletas_id');
    }
}
