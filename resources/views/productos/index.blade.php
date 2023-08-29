@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Interfaz || productos</h1>
@stop

@section('content')

    {{-- <div class="row justify-content-center">
        <div class="box-login shadow">
            <form class="form-login" method="post">
                <legend> <span style="color: #3391E7; font-weight: bold;">SysteMedic</span> || Login Pacientes</legend>
                <br><br>
                <fieldset>
                    <div class="form-group">
                        <p>Ingresa tu correo electrónico</p>
                        <span class="input-icon">
                            <input type="text" class="form-control"
                                style="height: 25px; outline: none; border:none; background: none; border-bottom: 1px solid #3391E7;"
                                name="username" placeholder="Usuario">
                            <i class="fa fa-user"></i>
                        </span>
                    </div><br>
                    <div class="form-group form-actions">
                        <p>Ingresa tu contraseña</p>
                        <span class="input-icon">
                            <input type="password" class="form-control password"
                                style="height: 25px; outline: none; border:none; background: none; border-bottom: 1px solid #3391E7;"
                                name="password" placeholder="Contraseña">
                            <i class="fa fa-lock"></i>
                        </span>
                        <a href="forgot-password.php">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="loginUser" class="btn btn-primary pull-right">
                            Ingresar <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>
                </fieldset>
            </form>
            <br>
            <div class="new-account">
                ¿Aún no tienes una cuenta creada?
                <!-- <a href="registration.php">Crear una cuenta</a> -->
                <br>
                <button class="btn btn-outline-success btn-estilo" data-bs-toggle="modal" data-bs-target="#addbtn">Crear
                    cuenta <i class='bx bxs-user-account'></i></button>
            </div>
            <br>
            <div class="copyright">
                <p style="font-size: 12px">&copy; <span style="font-weight: bold;">SYSTEMEDIC</span>; Todos los derechos
                    reservados</p>
            </div>
        </div>
    </div> --}}

    {{-- Agregar producto --}}
    <button class="btn btn-outline-success mb-2" data-bs-toggle="modal" data-bs-target="#addbtn">Agregar producto</button>

    {{-- Contenido de tabla --}}
    <table id="registros" class="table table-border table-hover" width="100%">
        <thead>
            <tr class="thead-custom" style="color: #fff !important; font-weight: bold; background-color: rgb(192, 32, 59);">
                <th scope="col" class="th-tabla">ITEM
                </th>
                <th scope="col" style="display: none;">ID</th>
                <th scope="col">imagen</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">DESCRIPCION</th>
                <th scope="col">IMAGEN</th>
                <th scope="col">PRECIO</th>
                <th scope="col">ACCION</th>
            </tr>
        </thead>
        <tbody>
            @php
                $contador = 1;
            @endphp
            @foreach ($productos as $data)
                <tr>
                    <td>{{ $contador }}</td>
                    <td style="display: none;">{{ $data->id }}</td>
                    <td>{{ $data->codigo }}</td>
                    <td>{{ $data->nombre }}</td>
                    <td>{{ $data->descripcion }}</td>
                    <td>
                        <img src="/image/{{ $data->imagen }}" width="90px" height="90px">
                    </td>
                    <td>{{ $data->precio }}</td>
                    <td style="text-align: center;">
                        <form action="{{ route('productos.destroy', $data->id) }}" class="formEliminar" method="POST">
                            {{--  <a href="/productos/{{ $data->id }}/edit" class="btnEdit"><i class='bx bx-edit-alt'></i></a> --}}
                            <a href="#edit{{ $data->id }}" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $data->id }}">
                                <i class='bx bx-edit-alt'></i>
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit"><i class='bx bxs-eraser'></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @php
                $contador++;
            @endphp
        </tbody>
    </table>
    {{-- End contenido tabla --}}

    {{-- Start contenido modal --}}
    <div class="modal fade custom-modal" id="addbtn" data-bs-backdrop="static" data-bs-keybodard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Registro de productos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class='bx bx-message-alt-x' style="color: rgb(192, 32, 59); font-weight: bold; font-size: 28px;"></i>
                    </button>
                </div>
                <div class="modal-body custom-modal-form">
                    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data"
                        class="formAgregar">
                        @csrf
                        <div class="mb-3">
                            <label>
                                <i class='bx bx-barcode'></i>
                                <span>Codigo</span>
                            </label>
                            <input type="text" name="codigo" id="codigo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>
                                <i class='bx bx-rename'></i>
                                <span>Nombre</span>
                            </label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>
                                <i class='bx bx-file'></i>
                                <span>Descripcion</span>
                            </label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>
                                <i class='bx bx-image-add'></i>
                                <span>Elegir imagen</span>
                            </label>
                            <input type="file" name="imagen" id="imagen" class="form-control" class="hidden"
                                required>
                        </div>
                        <!-- Visualización previa de la imagen adjuntada -->
                        <div class="grid grid-cols-1 mt-2 mx-7" style="display: grid; place-items: center;">
                            <img id="imagenSeleccionada" style="max-height: 300px;">
                        </div>
                        {{-- end for view image in time real --}}
                        <div class="mb-3 mt-2">
                            <label>
                                <i class='bx bx-money-withdraw'></i>
                                <span>Precio</span>
                            </label>
                            <input type="number" step="0.01" name="precio" id="precio" class="form-control"
                                required>
                        </div>
                        <div class="modal-footer bg-secondary">
                            <button type="submit" class="btn btn-outline-primary text-light">Guardar registro</button>
                            <a type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    {{-- End contenido Modal --}}

    {{-- Para modal de edición de registros --}}
    @foreach ($productos as $data)
        <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center" id="editModalLabel{{ $data->id }}">
                            <b class="me-2" style="color: black; font-weight: bold; font-size: 30px;">Editar Producto</b>
                            <i class='bx bx-arrow-from-left me-2' style="color: rgb(192, 32, 59); font-size: 30px"></i>
                            <span style="font-weight: bold; font-size: 26px; color: rgb(192, 32, 59)">ID: {{ $data->id }}</span>
                        </h5>
                        <button type="button" data-bs-dismiss="modal" aria-label="Cerrar"><i
                                class='bx bx-message-alt-x'
                                style="color: rgb(192, 32, 59); font-weight: bold; font-size: 28px;"></i></button>
                    </div>
                    {{-- {{ route('productos.update', ['producto' => $data->id]) }} --}}
                    <div class="modal-body">
                        <form id="{{ $data->id }}" action="{{ route('productos.update', ['producto' => $data->id]) }}" method="POST"
                            enctype="multipart/form-data" class="formEdicionRegistro">
                            @csrf
                            @method('PUT')
                            <!-- Campos de edición del producto aquí -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-2 mx-3">
                                <div class="grid grid-cols-0">
                                    <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold">codigo:</label>
                                    <input name="codigo" id="codigo"
                                        class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                        type="text" required value="{{ $data->codigo }}" />
                                </div>
                                <div class="grid grid-cols-0">
                                    <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold">Nombre:</label>
                                    <input name="nombre" id="nombre"
                                        class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                        type="text" required value="{{ $data->nombre }}" />
                                </div>
                                <div class="grid grid-cols-0">
                                    <label
                                        class="uppercase md:text-sm text-xs text-gray-500 font-semibold">Descripción:</label>
                                    <input name="descripcion" id="descripcion"
                                        class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                        type="text" required value="{{ $data->descripcion }}" />
                                </div>
                                <div class="grid grid-cols-0">
                                    <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold">Precio:</label>
                                    <input name="precio"
                                        class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                        type="number" step="0.01" required value="{{ $data->precio }}" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 mt-2 mx-3">
                                <label class="uppercase md:text-sm text-xs text-gray-500 font-semibold mb-1">Subir
                                    Imagen</label>
                                <div class='flex items-center justify-center w-full'>
                                    <label
                                        class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                                        <div class='flex flex-col items-center justify-center pt-3'>
                                            <svg class="w-10 h-8 text-purple-400 group-hover:text-purple-600"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p
                                                class='text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>
                                                Seleccione la imagen</p>
                                        </div>
                                        <input name="imagen" id="imagenEdit" type='file' class="hidden" />
                                    </label>
                                </div>
                            </div>
                            {{-- Codigo para mostrar la imagen centrada --}}
                            <div class="grid grid-cols-1 mt-2 mb-2" style="display: grid; place-items: center;">
                                <img src="/image/{{ $data->imagen }}" width="200px" id="imagenEdicionSeleccionada">
                            </div>
                            {{-- end for view image in time real --}}

                            <div class='flex items-center justify-center  md:gap-8 gap-4 pt-3 pb-3 modal-footer'>
                                {{-- <a href="{{ route('productos.index') }}" class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a> --}}
                                <a type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</a>
                                <button type="submit" id="updateButton{{ $data->id }}"
                                    class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Guardar</button>
                            </div>
                            <!-- ... (campos de edición) ... -->
                            {{-- <button type="button" class="btn btn-primary" id="updateButton{{ $data->id }}">Actualizar</button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal edit --}}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    {{-- tailwind stile --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- Code for container-shadow with Bootstrap --}}

    {{-- <!-- BOOTSTRAP -->
    <style>
        .box-login {
            max-width: 400px;
            margin: 20px;
            /* Añade un margen para separar el contenido del borde de la pantalla */
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Estilo adicional para centrar el contenido */
        .justify-content-center {
            display: flex;
            justify-content: center;
            align-items: center;
            /* Asegura que el contenido ocupe al menos la altura de la ventana */
        }
    </style> --}}
    {{-- End code for container-shadow --}}

    {{-- BOXICONS --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- Code for datatables and more --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
    <!--  Datatables Responsive  -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    {{-- Espaciado para el contenido del cuadro de cantidad en datatable --}}
    <style>
        .dataTables_length select {
            padding: 0px 20px;
            margin: 10px;
            /* Ajusta el valor según tu preferencia */
        }
    </style>
    {{-- Espaciado para el contenido del cuadro de cantidad en datatable --}}

    {{-- Style btnFormTable --}}
    <style>
        .btnDelete {
            background-color: transparent;
            color: rgb(192, 32, 59);
            border: none;
            outline: none;
            font-size: 30px;
        }

        .btnDelete:hover {
            color: grey;
        }

        .btnEdit {
            background-color: transparent;
            color: grey;
            border: none;
            outline: none;
            font-size: 30px;
        }

        .btnEdit:hover {
            color: rgb(192, 32, 59);
        }


        /* Style for icones in modal */
        .mb-3 label {
            display: flex;
            align-items: center;
            align-content: center;
        }

        .mb-3 label span {
            padding-left: 10px;
        }

        .mb-3 label>i {
            font-size: 26px;
            color: rgb(192, 32, 59);
            font-weight: bold;
        }
    </style>

    {{-- For MODAL --}}
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>


    {{-- Scripts for datatables and more --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <!--Bootstrap JS-->
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script> --}}

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <!-- Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <!-- Datatables responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <!--  Datatables JS-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>


    {{-- CODE TO DATATABLE --}}
    <script>
        $(document).ready(function() {
            $('#registros').DataTable({
                responsive: true,
                autoWidth: false,
                bDestroy: true,
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                "language": {
                    "zeroRecords": "No se encontraron registros",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtro de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "lengthMenu": "Mostrar _MENU_ registros por página"
                }
            });
        });
    </script>
    {{-- ENDE CODE DATATABLE --}}

    {{-- Start code for modal --}}
    <script></script>
    {{-- End code for modal --}}

    {{-- For modal --}}
    <!--CDN JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <!--Scripts end-->

    {{-- Codifo para la visualización previa de una imagen en el modal o cuaquier form --}}
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
    {{-- End view prec --}}

    {{-- Sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- CODE FOR ALERT IN ELIMINATION OF REGISTER --}}
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.formEliminar')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault()
                        event.stopPropagation()
                        Swal.fire({
                            title: 'Está seguro de eliminar el registro?',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#20c997',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Confirmar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                                Swal.fire('¡Eliminado!',
                                    'El registro a sido eliminado correctamente',
                                    'success'
                                );
                            }
                        })
                    }, false)
                })
        })()
    </script>
    {{-- END CODE DELETE --}}
    {{-- START CODE FOR ALERT ADD REGISTER --}}
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.formAgregar')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault()
                        event.stopPropagation()
                        Swal.fire({
                            title: '¿Está seguro de agregar el producto?',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#20c997',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Confirmar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                                Swal.fire('¡Producto agregado!',
                                    'El registro a sido agregado correctamente a la base de datos',
                                    'success'
                                );
                            }
                        })
                    }, false)
                })
        })()
    </script>
    {{-- END CODE FOR ALERT ADD --}}

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

    {{-- Code js for edicion imagen: --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(e) {
            $('#imagenEdit').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenEdicionSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
    {{-- end --}}
@stop
