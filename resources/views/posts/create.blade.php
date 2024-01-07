{{-- Vamos a heredar --}}
@extends('layouts.app') 


@section('titulo')
    
    Crea una nueva Publicación

@endsection

@push('styles') {{--Le decimos que stack queremos utilizar para cargar los estilos--}}
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

@endpush

@push('scripts')
@vite('resources/js/app.js') <!--Importar  para usar bien dropzone-->    
@endpush



@section('contenido')


<div class="md:flex md:items-center">

        <div class="md:w-1/2 px-10">

            {{-- se requiere almenos una url para subir las img para que aparezca el dropzone --}}

            {{-- enctype="multipart/form-data"   ->  (esto para subir imagenes)--}}
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">

                @csrf <!--necesario poner si no marca un error-->


            </form>

        </div>

        
        <div class="md:w-1/2 p-10 bg-white  rounded-lg shadow-xl mt-10 md:mt-0">

 
            
            <form action="{{route('posts.store')}}" method="POST" novalidate >
            
                @csrf
    
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
    
                    <input
                        id="titulo"
                        name="titulo"
                        type="text"
                        placeholder="Titulo de la Publicación"
                        class="border p-3 w-full rounded-lg @error('name')
                        border-red-500       
                        @enderror"
                        value="{{ old('titulo') }}"
                    />
    
                    {{-- old('name')  permite que mantengamos el valor previo de un campo  --}}
    
                    @error('titulo') <!--directiva---> <!--msjs de error de laravel-->
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>

                    <textarea 
                    id="descripcion"
                    name="descripcion"
                    placeholder="Descripción de la Publicación"
                    class="border p-3 w-full rounded-lg @error('name')
                    border-red-500       
                    @enderror"
                    
                    >{{ old('descripcion') }}</textarea> <!--es obligatorio la apertura y cierre en laravel-->
    
                    {{-- old('name')  permite que mantengamos el valor previo de un campo  --}}
    
                    @error('descripcion') <!--directiva---> <!--msjs de error de laravel-->
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        
                    @enderror
                </div>

                <div class="mb-5">

                    {{-- el name siempre debe llamarse al campo que tenemos en la migracion de la bd para que en automatico se asignen--}}
                    <input

                        name="imagen"
                        type="hidden"
                        value="{{ old('imagen')}}"
                    >

                    @error('imagen') <!--directiva---> <!--msjs de error de laravel-->
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        
                    @enderror

                </div>

                <input 
                type="submit"
                value="Crear Publicación"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                
                >



                </form>

        </div>

        

</div>
    
@endsection