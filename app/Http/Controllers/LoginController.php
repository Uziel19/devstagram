<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    
    public function index()
    {
        return view('auth.login');
    }
    
    
    public function store(Request $request)
    {
        //dd('Autenticando...');
      //  dd($request->remember);

        $this->validate($request,[

            'email' => 'required|email',
            'password' => 'required'
            
            ]);




            // Evaluar la autenticación
            if(!auth()->attempt($request->only('email','password'),$request->remember)){

                return back()->with('mensaje','Credenciales Incorrectas');// Esto va a colocar este mensaje en lo que se conoce como una session  

            }

            return redirect()->route('posts.index',auth()->user()->username); //redirecciona a esta pagina y manda el username para que este sea usado en el url


    }






}
