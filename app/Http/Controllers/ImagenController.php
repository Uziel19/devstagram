<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //almacenar las imagenes


    public function store(Request $request){

        //$input = $request->all();// all para ver todos los request

        $imagen = $request->file('file'); // seleccionamos el archivo
      
        
        // Str::uuid() (helper de Str) -> Genera un id unico retorna 36 caracteres
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        
        
        //usando intervation image

        //make nos permite crear una imagen de intervetation image
        // se le pasa la img que estamos subiendo

        $imagenServidor = Image::make($imagen);//variable de intervation image como una nueva instancia de intervation 

        //efectos de intervation image

        $imagenServidor->fit(1000,1000);//corta la img 

        //ruta donde se guardaran las img

        $imagenPath = public_path('uploads') . '/' . $nombreImagen; //  public_path apunta directamente a public y dentro de la carpeta uploads almacena las img

        //Guardamos la img en una carpeta del server
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]); //construimos una respuesta

        
    }
}