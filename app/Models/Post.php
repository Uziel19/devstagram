<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //laravel tiene una propiedad llamada el fillable que es la informacion que se va a llenar en la bd (para que laravel sepa que es la informacion que tiene que leer y que informacion tiene que procesar antes de enviarla hacia la bd )es una forma de proteger mi bd

    protected $fillable = [
            'titulo',
            'descripcion',
            'imagen',
            'user_id'
        
        ];


        
        //un post pertenece a un usuario
        //Crear relacion

        public function user()
        {
            //De esta manera podemos obtener solo ciertos campos
         return $this->belongsTo(User::class)->select(['name','username']);  
        }



        //Relacion-> Un post va a tener multiples comentarios

        public function comentarios()
        
        {

           return $this->hasMany(Comentario::class);



        }


        public function likes() // lo nombramos asi por que de igual manera se llama asi nuestra tabla en la bd y el modelo
        {

            //un Post va a tener muchos likes

            return $this->hasMany(Like::class);

        }


        public function checkLike(User $user)
        {

            return $this->likes->contains('user_id', $user->id);
            
        }









    }
