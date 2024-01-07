<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //

    public function store (){

   
        auth()->logout(); // va permitir cerrar la session

        return redirect()->route('login');// no es una buena forma de hacer esto por cuestiones de Inseguridad (Estamos a disposicion de un ataque)
    }
}
