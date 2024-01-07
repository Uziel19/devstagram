<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // lo unico que se llena son estos campos en la tabla likes

    protected $fillable = [
            'user_id',
            //'post_id' (Ya no lo requerimos por que ya lo va a detectar automaticamente gracias a la relacion)
        
        ];
}
