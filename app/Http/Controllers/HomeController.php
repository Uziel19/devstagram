<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


// se definio asi la fn por que es la unica que tendremos en este controller
    public function __invoke(){ // se manda a llamar automaticamente
        


        //Obtener a quienes seguimos
        // pluck se va a traer ciertos campos
        //toArray convierte un obj a un array

        //where filtra por un valor
        //whereIn filtra por un arreglo de valores

        $ids=auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id',$ids)->latest()->paginate(20); //es importante el orden para que ordene los post desde los mas nuevos hasta los mas viejos y despues se hace la paginacion

        //dd($posts);

        return view('home',[

            'posts' => $posts
            
            ]);



    }


}
