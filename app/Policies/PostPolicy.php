<?php

namespace App\Policies;
// A un policy tu vas a poder associarle un modelo y por default tiene un usuario tambien associado



use App\Models\Post; 
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
// Este policy le va a permitir al usuario poder ver o eliminar o actualizar algun registro 
{
  

    // determina si un usuario puede eliminar un modelo

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post)
    {
      return $user->id === $post->user_id; //retorna true o false
    }

   
}
