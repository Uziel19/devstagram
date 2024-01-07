<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
//Archivo de logica 
//Aqui no estan disponibles los request livewire tiene su propia forma de hacerlo
//en este archivo podemos consultar a la bd o tener validacion 
{

    public $post; // ya esta la varible disponible en la vista
    public $isLiked;
    public $likes;

// recibe igual este parametro cuando se instancia este componente
   public function mount($post)//fn del ciclo de vida de livewire // esta fn se va ejecutar automaticamente cuando se alla instanciado este likePost
   {
        $this->isLiked = $post->checkLike(auth()->user());// regresa un 1 si ya le dio like caso contrario no regresa nada
        $this->likes = $post->likes->count();

   }   


    public function like ()
    {

     if($this->post->checkLike(auth()->user())){

         $this->post->likes()->where('user_id', auth()->user()->id)->delete();
         $this->isLiked = false;
          $this->likes--;

     } else {

        $this->post->likes()->create([
            
            'user_id' => auth()->user()->id
            
            
            ]);

            $this->isLiked=true;
             $this->likes++;

     }


    }





    public function render() // muestra una vista
    {

        return view('livewire.like-post');
    }
}
