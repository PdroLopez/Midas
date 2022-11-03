<?php

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model;

class TicketTipoProducto extends Model
{
    protected $table = "ticket_tipoproducto";
    protected $fillable = ['ticket_id','tipo_producto_id','cantidad','otro_estado'];

    public function ticket()
    {
        return $this->belongsTo('Modules\Backend\Entities\Ticket','ticket_id');
    }

    public function tipo_producto()
    {
        return $this->belongsTo('Modules\Workflow\Entities\TipoProducto','tipo_producto_id');
    }
}
