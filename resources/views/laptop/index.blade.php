@extends('adminlte::page')

@section('title', 'Dashboard | Laptop')

@section('content')
    <a href="laptops/create" class="btn btn-outline-success mt-3 ml-3 mb-3">Agregar nueva Laptop</a>
    <button class="btn btn-primary btn-estilo" data-bs-toggle="modal" data-bs-target="#addbtn">Agregar en MODAL</button>


    <table id="laptops" class="table table-striped shadow-lg mt-6" width: 100%;>
        <thead class="bg-secondary text-white">
            <tr>
                <th scope="col" style="text-align: center;">ITEM</th>
                <th scope="col" style="text-align: center; display: none;">ID</th>
                <th scope="col" style="text-align: center;">CODIGO</th>
                <th scope="col" style="text-align: center;">DESCRIPCION</th>
                <th scope="col" style="text-align: center;">IMAGEN</th>
                <th scope="col" style="text-align: center;">PRECIO</th>
                <th scope="col" style="text-align: center;">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @php
                $contador = 1;
            @endphp
            @foreach ($laptops as $data)
                <tr>
                    <td>{{ $contador }}</td>
                    <td style="display: none;">{{ $data->id }}</td>
                    <td>{{ $data->codigo }}</td>
                    <td>{{ $data->descripcion }}</td>
                    <td>
                        <img src="/imagen/{{ $data->imagen }}" width="90px" height="90px">
                    </td>
                    <td>{{ $data->precio }}</td>
                    <td style="text-align: center;">
                        <form action="{{ route('laptops.destroy', $data->id) }}" method="POST" class="formEliminar">
                            <a href="/laptops/{{ $data->id }}/edit"
                                class="rounded bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="rounded bg-pink-400 hover:bg-pink-500 text-white font-bold py-2 px-4">Delete</button>
                        </form>
                    </td>
                </tr>
                @php
                    $contador++;
                @endphp
            @endforeach
        </tbody>
    </table>




    <!-- Start modal de registro de consulta -->
    <div class="modal fade custom-modal-bg" id="addbtn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Formulario de<span
                            style="color: #3391E7;">registro / laptops</span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body custom-modal-form">
                    <form action="{{ route('laptops.store') }}" method="POST" enctype="multipart/form-data" class="formAgregar">
                        @csrf
                        <div class="mb-3" style="text-align: left;">
                            <label>CODIGO: <i class='bx bx-barcode' style="color: red; font-size: 30px;" ></i></label>
                            <input type="text" name="codigo" id="codigo" class="form-control" required>
                        </div>
                        <div class="mb-3" style="text-align: left;">
                            <label>DESCRIPCION:</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                        </div>
                        <div class="mb-3" style="text-align: left;">
                            <label>IMAGEN:</label>
                            <input type="file" name="imagen" id="imagen" class="form-control" required>
                        </div>
                        <!-- Para ver la imagen seleccionada, de lo contrario no se -->
                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <img id="imagenSeleccionada" style="max-height: 300px;">
                        </div>
                        {{-- end for view image in time real --}}
                        <div class="mb-3" style="text-align: left;">
                            <label>PRECIO:</label>
                            <input type="number" name="precio" id="precio" class="form-control" required>
                        </div>
                        <div class="mb-3" style="text-align: left;">
                            <div class="checkbox clip-check check-primary">
                                <input type="checkbox" id="agree" value="agree" checked="true" readonly=" true">
                                <label for="agree">
                                    I agree
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-primary">Guardar registro</button>
                            <a type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal-->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

    {{-- tailwind css --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>


    {{-- CDN DataTables Responsive --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />



    {{-- Espaciado para el contenido del cuadro de cantidad en datatable --}}
    <style>
        .dataTables_length select {
            padding: 0px 20px;
            margin: 10px;
            /* Ajusta el valor según tu preferencia */
        }
    </style>
    {{-- Espaciado para el contenido del cuadro de cantidad en datatable --}}

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    {{-- DATATABLE CODE --}}
    <script>
        //new DataTable('#articulos');

        $(document).ready(function() {
            $('#laptops').DataTable({
                responsive: true,
                autoWidth: false,
                "bDestroy": true,
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


    <!--CDN JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <!--Scripts end-->


    {{-- Codigo para validar eliminación de un registro en sweet alert --}}
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
    {{-- end codigo for validation delete register --}}

    <!-- Script para ver la imagen antes de CREAR UN NUEVO PRODUCTO en el datatable-->
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

    {{-- CDN DataTables Responsive --}}
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <!-- Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

    <!--  Datatables JS-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
@stop
