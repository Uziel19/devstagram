<?php
// un facade es un grupo de fn's que realizan algo muy especifico
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

//en un controller se van a ir a grupando diferentes metodos y diferentes rutas
// Laravel es un framework que esta enfocado a la seguridad
//Se asegura que no sufras ataques que se les conoce como XSRF 

class RegisterController extends Controller
{
    //

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        // dd($request);   fn de laravel que solo ejecuta (imprime) lo que se le pasa y ya no ejecuta las siguientes lineas (request contiene informacion del envio de info que hicimos por el metodo )

        //dd($request->get('name'));


        //Modificar el Request (hacer esto lo menos posible)
        $request->request->add(['username'=> Str::slug($request->username)]); //sobrescribimos el valor del username para pasar la validacion




        // Validación

        //request - reglas de validacion por cada campo

        $this->validate($request, [
            'name' => ['required', 'max:30'],   //'required|min:5',  minimo 5 caracteres
            'username' => 'required|unique:users|min:3|max:20', //unique:tabla
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'

        ]);


        //dd('Creando Usuario');
        //metodo estatico que nos va a permitir crear nuevos registros
        //arreglo asociativo
        // todo lo que se requiere para crear un registro
         //Str::lower convierte a minusculas (funciona )
         //slug va a combertirlo a una url  (No funciona)
        User::create([
            'name' => $request->name,
            'username' =>$request->username,
            'email' => $request->email,
            'password' => $request->password

        ]);

        //Autenticar un usuario

        auth()->attempt([ //fn que intenta  autenticar el usuario
            'email' => $request->email,
            'password'=>$request->password

            ] ); //retorna un bool si el usuario se pudo autenticar


         //Otra forma de autenticar

            auth()->attempt($request->only('email','password'));





        //Redireccionar 
        return redirect()->route('posts.index');

        //laravel tambien ya te da autenticacion y te da una serie de helpers para comprobar que un usuario este autentificado
    }
}
