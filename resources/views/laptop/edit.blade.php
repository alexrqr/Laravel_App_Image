@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Interfaz de edición de registro</p>

    <form action="/laptops/{{$laptop->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold">codigo:</label>
                <input name="codigo"
                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                    type="text" required value="{{$laptop->codigo}}"/>
            </div>
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold">Descripción:</label>
                <input name="descripcion"
                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                    type="text" required value="{{$laptop->descripcion}}"/>
            </div>
        </div>

        {{-- Codigo para mostrar la imagen centrada --}}
        <div class="grid grid-cols-1 mt-5 mx-7">
            <img src="/imagen/{{ $laptop->imagen }}" width="200px" id="imagenSeleccionada">
        </div>
        {{-- end for view image in time real --}}

        <div class="grid grid-cols-1 mt-5 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold mb-1">Subir Imagen</label>
            <div class='flex items-center justify-center w-full'>
                <label
                    class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                    <div class='flex flex-col items-center justify-center pt-7'>
                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <p class='text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Seleccione la
                            imagen</p>
                    </div>
                    <input name="imagen" id="imagen" type='file' class="hidden" />
                </label>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
                <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold">Precio:</label>
                <input name="precio"
                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                    type="number" required value="{{$laptop->precio}}"/>
            </div>
        </div>

        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
            <a href="{{ route('laptops.index') }}"
                class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
            <button type="submit"
                class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Guardar</button>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    {{-- tailwind stile --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
@stop

@section('js')
    {{-- Script para mostrar la imagen al subir al form --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(e) {
            $('#imagen').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
    {{-- end code for view prev image --}}
@stop
