<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    protected $table = "alimento";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[	
        'portada',	
        'precio',
        'descripcion',
        'precio',

    ];

    protected $guarded=[

    ];
}
