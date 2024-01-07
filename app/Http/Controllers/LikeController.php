<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    
    public function store (Request $request, Post $post)// estamos guardando likes en un post
    {
// tenemos acceso al usuario que esta haciendo esta peticion
      //  dd($request->user()->id);

      $post->likes()->create([ // ya detecta en automatico el id del post por que ya se asocio posts con likes

        'user_id' => $request->user()->id
        
        ]);

        return back(); // nos regresa a la pagina donde se hizo la peticion
     
    }

    public function destroy(Request $request, Post $post){

      //  dd('eliminando like');

        //tiene el user actual

        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();

    }

}
