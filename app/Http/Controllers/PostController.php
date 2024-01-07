<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //todo en este controlador tiene que  estar protegido para realizar ciertas acciones (protegemos el controller) 


    public function __construct()
    {
            //con except le decimos al controlador que algunos metodos no van a estar protegidos

        $this->middleware('auth')->except(['show','index']); //middleware de autenticacion (con esto protegemos) de esta manera revisa que el usuario este autentiticado
        
    }


//para mostrar un listado total
    public function index(User $user) //espera un modelo (la respuesta del modelo(instancia del usuario))//le pasamos el usuario
    {
        //dd(auth()->user()); //revisa que usuario esta autentificado actualmente

        //dd($user->username);//imprimiendo la info del usuario que tiene ese id
//automaticamente cuando mandamos a llamar un modelo ya se situa en su tabla correspondiente (laravel ya lo hace automaticamente)
        //dd($user->id);

//Laravel te ofrece la paginacion de los registros // toma cuantos resultados quieres tener para poder paginar paginate()

// otro tipo de paginacion simplePaginate()

        //modelo de Eloquent-- si se puede paginar
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20); //filtramos por user_id || con get() se trae los resultados

        //dd($posts);//trea unicamente la informacion del modelo (si no se coloca el get)

        return view('dashboard',[
            'user' => $user,
            'posts' => $posts
            
            ]);// se envia la info del user que visitamos
    }


    public function create()
    {

    
        return view('posts.create');

    }

    public function store (Request $request)//siempre estara el request
    {
        
        $this->validate($request,[
                'titulo' => 'required|max:255',
                'descripcion' => 'required',
                'imagen'=>'required'
            ]);

            //uso del modelo Post

            //creando un nuevo post
            // siempre esta info es la que estara en el fillable
          /*  Post::create([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'imagen' => $request ->imagen,
                'user_id' => auth()->user()->id //usuario que esta autenticado
                
                
            ]);
            */

            //Otra forma

                 /*
                $post = new Post;
                
                $post -> titulo = $request->titulo;
                $post -> descripcion = $request->descripcion;
                $post -> imagen= $request ->imagen;
                $post -> user_id = auth()->user()->id;
                $post -> save(); //guarda el registro  en la bd

                */

                //Forma de registrar  con las relaciones

                $request->user()->posts()->create([
                    
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'imagen' => $request ->imagen,
                'user_id' => auth()->user()->id
                    
                    ]);




            //Agregar propiedades de manera individual
            return redirect()->route('posts.index',auth()->user()->username);



    }


    //para mostrar solo un recurso
    public function show ( User $user ,Post $post){



        return view('posts.show',[
            
            'post' => $post,
            'user' => $user
            
            
            ]);

    }

    public function destroy (Post $post)
    {

    /*    if($post->user_id === auth()->user()->id){

            dd('Si es la misma persona');
        }else {

            dd('No es la misma persona');
        }
        */

        //Lo mismo de arriba lo podemos hacer con este policy
        $this->authorize('delete',$post);

        // si se pasa la autorizacion se elimina el post
        $post->delete();

        // Eliminar la Imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

 //file es un facades de laravel
        if(File::exists($imagen_path)){ // esta funcion comprueba si el archivo existe

            unlink($imagen_path); // fn de php para eliminar esa Imagen
            //File::delete();  funciona en algunos casos tambien para eliminar imagenes


        }








        //redireccionamos 
        return redirect()->route('posts.index', auth()->user()->username);

    }



}


 