<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller

{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {


        return view('perfil.index');
    }

    public function store(Request $request)
    {

        //Modificar el Request (hacer esto lo menos posible)
        $request->request->add(['username' => Str::slug($request->username)]); //sobrescribimos el valor del username para pasar la validacion

        $this->validate($request, [
            // not_in : sirve para excluir ciertas palabras
            // in:  para forzar que se elija un valor de una lista | Example:-> 'in:CLIENTE,PROVEEDOR,VENDEDOR'

            // por default revisa el name
            // no importa que estes validando el username requiere el id
            // poner en un arreglo cuando hay mas de 3 reglas de validacion
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],

            'email' =>  ['required', 'unique:users,email,' . auth()->user()->id, 'email', 'max:60'],


            

        ]);



        // Evaluar la contraseña actual para el cambio

        if(!$request->password && !$request->newpassword){

            

        }

        else if(!$request->password && $request->newpassword){
            return back()->with('mensaje', ' Ingrese la Contraseña Actual');
        }

        else if (!auth()->attempt(["email" => auth()->user()->email, "password" => $request->password])) {

            return back()->with('mensaje', 'Contraseña Actual Incorrecta'); // Esto va a colocar este mensaje en lo que se conoce como una session  

        }



        if ($request->imagen) {


            $imagen = $request->file('imagen'); // seleccionamos el archivo


            // Str::uuid() (helper de Str) -> Genera un id unico retorna 36 caracteres
            $nombreImagen = Str::uuid() . "." . $imagen->extension();


            //usando intervation image

            //make nos permite crear una imagen de intervetation image
            // se le pasa la img que estamos subiendo

            $imagenServidor = Image::make($imagen); //variable de intervation image como una nueva instancia de intervation 

            //efectos de intervation image

            $imagenServidor->fit(1000, 1000); //corta la img 

            //ruta donde se guardaran las img

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen; //  public_path apunta directamente a public y dentro de la carpeta uploads almacena las img

            //Guardamos la img en una carpeta del server
            $imagenServidor->save($imagenPath);
        }







        //Guardamos cambios

        //Busqueda de Usuario
        $usuario = User::find(auth()->user()->id);

        //username
        $usuario->username = $request->username;

        //imagen
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        // email 
        $usuario->email = $request->email;


        //password
        $usuario->password = $request->newpassword ?? auth()->user()->password;


        $usuario->save();


        //auth()->user()->email; // conserva los valores anteriores del user

        //Redireccionar
        return redirect()->route('posts.index', $usuario->username); // mandamos el usuario que se actulizado o tal vez no




    }
}
