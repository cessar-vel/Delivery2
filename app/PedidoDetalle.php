<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    protected $table = "pedido_detalle";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'idpedido',	
        'producto',
        'cantidad',
        'precio',

    ];

    protected $guarded=[

    ];
}
