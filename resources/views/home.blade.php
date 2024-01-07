
@extends('layouts.app')

@section('titulo')

Página Principal

@endsection

@section('contenido')

   <x-listar-post :posts="$posts"  />{{--Si no se tiene la diagonal se aceptan slots--}}

   {{-- <x-slot:titulo>Para añadir mas slots

        <header>Esto es un header</header>

    </x-slot:titulo>
   

    <h1>Mostrando post desde slot</h1> slot por default

 

   </x-listar-post>
   --}}
    

   {{-- @forelse ($posts as $post ) Revisa si hay posts si no ejecuta la parte del empty

        <h1>{{ $post->titulo }}</h1>
        
    @empty

    <p>No Hay Posts</p>
        

    @endforelse

--}}


@endsection
