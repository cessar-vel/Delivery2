<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedidos";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'iduser',	
        'fecha',
        'direccion',
        'total_pagado',
        'estado',
        'tiempo_estimado',
    ];

    protected $guarded=[

    ];
}
