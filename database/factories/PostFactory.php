<?php
//Laravel tiene integrado la libreria faker (para php) para hacer el testing de nuestra bd

//con tinker vamos a poder ejecutar nuestro factory . tinker es un CLI que ya viene en laravel donde podemos interactuar con nuestra app y bd
namespace Database\Factories;

// "correr el factory"
//el archivo factory ya esta atado al archivo del modelo || ya esta  automaticamente registrado por el nombre (No ejecutamos directamente el archivo factory) -- se recomienda hacerlo muchas veces por que si solo se hace una vez puede que asigne un nuevo id 

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            //Aqui podemos definir nuestros datos falsos para realizar nuestros test
            //cuando corramos este factory va a generar datos de prueba para cada uno de estos campos 


            'titulo'=>$this->faker->sentence(5),//genera una oracion de 5 palabras
            'descripcion'=>$this->faker->sentence(20),
            'imagen'=>$this->faker->uuid() . '.jpg', //genera un id unico y lo concatena con una extencion de imagen
            'user_id'=>$this->faker->randomElement([3, 4, 6, 7]) // elije aleatoriamente un valor de este listado (Estos valores deben estar registrados en tu bd)


        ];
    }
}
