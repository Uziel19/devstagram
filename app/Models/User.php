<?php
//usualmente el nombre de nuestros modelos van hacer en singular
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ //datos que se esperan para ser registrados
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    //La relacion va hacer un metodo que existe en los modelos
    //palabra reservada para las relaciones
    //hasMany -> One to Many

    //un usuario puede tener muchos post´s

//relacion
    public function posts ()
    {
        return $this->hasMany (Post::class); //relacion-- modelo con el cual se relaciona
    }

    public function likes ()
    {
        //un usuario puede dar like a todas las publicaciones que desee
        return $this->hasMany(Like::class);
    }

    //Almacena los seguidores de un usuario


    public function followers (){
                                                            //se posiciona en el user actual para registro de sus seguidores
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');

    }


    public function followings (){

        return $this->belongsToMany(User::class, 'followers','follower_id','user_id');

    }


    public function siguiendo(User $user){

        return $this->followers->contains($user->id);

    }








}
