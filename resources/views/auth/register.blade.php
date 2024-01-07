@extends('layouts.app')

<!--No validate nos va apermitir desactivar las validaciones de nuestro formulario HTML-->
@section('titulo')

Registrate en DevStagram

@endsection

@section('contenido')

<div class="md:flex md:justify-center md:gap-10 md:items-center"> <!--esto es un media query md: ,cm:, etc..-->

    <div class="md:w-6/12 p-5">



        <!--asset sirve para cargar los archivos de la carpeta public(apunta directamente a esta carpeta)-->
        <img src="{{asset('img/login.jpg')}}" alt="Imagen registro de usuarios">

    </div>

    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl"><!--Distintas formas de media querys -->


        <form action="{{route('register')}}" method="POST" novalidate >
            
            @csrf

            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nombre
                </label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Tu Nombre"
                    class="border p-3 w-full rounded-lg @error('name')
                    border-red-500       
                    @enderror"
                    value="{{ old('name') }}"
                >

                {{-- old('name')  permite que mantengamos el valor previo de un campo  --}}

                @error('name') <!--directiva---> <!--msjs de error de laravel-->
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    
                @enderror
            </div>
            
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    Username
                </label>

                <input
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Tu Nombre de Usuario"
                    class="border p-3 w-full rounded-lg @error('username')
                    border-red-500       
                    @enderror"
                    value="{{ old('username') }}"
                >

                @error('username') <!--directiva---> <!--msjs de error de laravel-->
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    
                @enderror
            </div>


            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    Email
                </label>

                <input 
                    id="email"
                    name="email"
                    type="email"
                    placeholder="Tu Email de Registro"
                    class="border p-3 w-full rounded-lg @error('email')
                    border-red-500       
                    @enderror"
                    value="{{ old('email') }}"
                >
                @error('email') <!--directiva---> <!--msjs de error de laravel-->
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                    Password
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Password de Registro"
                    class="border p-3 w-full rounded-lg @error('password')
                    border-red-500       
                    @enderror"
                  
                >
                @error('password') <!--directiva---> <!--msjs de error de laravel-->
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    
                @enderror
            </div>

            
            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                    Repetir Password
                </label>

                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="Repite tu Password"
                    class="border p-3 w-full rounded-lg"

                    
                >
            </div>

            <input 
            type="submit"
            value="Crear Cuenta"
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            
            >

        </form>




    </div>




</div>


@endsection