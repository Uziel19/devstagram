<?php

//Router

/* Es Importante el Orden de las Rutas */


use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Models\Follower;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//la fn representa la sintaxis de closhur (es mejor utilizar un controllador)

//Route::get('/', function () {
  //  return view('principal');
//});



Route::get('/', HomeController::class)->name('home');

//get es cuando visitamos un sitio
//post es cuando enviamos informacion hacia un servidor
//Enlaces rotos es algo que previenes con los nombres en las rutas (rutas nombradas)
Route::get('/register',[RegisterController::class,'index'])->name('register'); //name = nombre de esta vista
Route::post('/register',[RegisterController::class,'store']);//asi vacio toma el nombre anterior que hemos declarado


Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

Route::post('logout',[LogoutController::class,'store'])->name('logout');//utilizar un get con un request a un bd tiende a ser inseguro


 // Rutas para el perfil
 Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');


//variable que va estar asociada aun modelo(toma por default su id)
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');//las llaves lo combierte en una variable (se pone un nombre de un modelo) (se esta aplicando algo que le conoce como route model binding )(esta a una ruta asociada aun modelo) (laravel automaticamente consulta ese modelo)

Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');


Route::post('/posts',[PostController::class,'store'])->name('posts.store');

//esta variable por default siempre va a puntar al id 
// se puede tener route model binding con 2 variables y 2 modelos diferentes
Route::get('/{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');


 //Es decir vamos enviar la peticion al post que yo estoy visitando
 Route::post('/{user:username}/posts/{post}',[ComentarioController::class,'store'])->name('comentarios.store');

 Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

 Route::post('/imagenes', [ImagenController::class,'store'])->name('imagenes.store');

 // Like a las fotos
 Route::post('/posts/{post}/likes',[LikeController::class,'store'])->name('posts.likes.store');

 Route::delete('/posts/{post}/likes',[LikeController::class,'destroy'])->name('posts.likes.destroy');


 // Siguiendo a Usuarios
 Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('users.follow');
 Route::delete('/{user:username}/unfollow',[FollowerController::class, 'destroy'])->name('users.unfollow');










