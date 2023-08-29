@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')

    <div class="row justify-content-center">
        <div class="box-login shadow">
            <form action="/productos" class="form-login" method="POST">
                @csrf
                <fieldset>Registro de un nuevo producto</fieldset>
                <div class="mb-3">
                    <label for="" class="form-label">Codigo</label>
                    <input type="text" name="codigo" id="codigo" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descipcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Precio</label>
                    <input type="number" name="precio" id="precio" step="any" value="0.00" tabindex="1" class="form-control">
                </div>
                <a href="/productos" class="btn btn-danger">Close</a>
                <button type="submit" class="btn btn-success">Guardar registro</button>
            </form>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
        .box-login {
            max-width: 600px;
            margin: 20px;
            /* Añade un margen para separar el contenido del borde de la pantalla */
            padding: 15px;
            border-radius: 8px;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Estilo adicional para centrar el contenido */
        .justify-content-center {
            display: grid;
            place-items: center;
            /* Asegura que el contenido ocupe al menos la altura de la ventana */
        }
        fieldset{
            border-bottom: 1px solid #000;
            margin-bottom: 20px;
            font-size: 25px;
            font-weight: bold;
        }
    </style>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
@stop
