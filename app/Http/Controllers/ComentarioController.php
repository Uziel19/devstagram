<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{

public function store(Request $request, User $user, Post $post ){

//dd($user->username); // info de usuario del post
  //  dd($post); // viene toda la info del post donde estamos comentando

    // validar 

    $this->validate($request, [
        'comentario' => 'required|max:255'
        ]);

    // almacenar el resultado

    Comentario::create([
        'user_id' => auth()->user()->id, // user autenticado
        'post_id' => $post->id ,
        'comentario' => $request->comentario
    
    ]);

   

    //Imprimir un mensaje
    return back()->with('mensaje','Comentario Realizado Correctamente'); // regresamos a la pagina anterior con estos datos una variable con un texto (Estos with los vamos a imprimir con una session)



}

}
