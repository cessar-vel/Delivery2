<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuComida extends Model
{
    protected $table = "menu_comida";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'titulo',	
        'preview',
        'enlace',
        'fondo',

    ];

    protected $guarded=[

    ];
}
