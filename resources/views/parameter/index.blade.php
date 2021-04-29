@extends('layouts.backend')

@section('css_datatable')
    {{-- dataTables CSS --}}
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    {{-- sweetalert2 --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">


@endsection

@section('titulo')
 - Parametros
@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row d-flex d-flex justify-content-between">
                <h6 class="ml-2 mt-2">Listado de parámetros</h6>
                <button type="button" class="btn btn-sm btn-primary | mx-3" onclick="create()">Ingresar parametro</button>
            </div>
        </div>
        <div class="card-body">
            <table id="paramerts_list" class="table table-sm w-100">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col"></th>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Abreviatura</th>
                        <th scope="col">Unidad</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
            </table>
            
        </div>
    </div>

    {{-- Modal de ingreso  --}}
    <div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="title">Ingresar parametro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <div class="row">

                            {{-- id  --}}
                            <input type="hidden" name="id" id="id">

                            {{-- Nombre  --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre: <span class="text-danger ml-2">*</span></label>
                                    <input  type="text" 
                                            class="form-control" 
                                            id="nombre" 
                                            name="nombre" 
                                            required>
                                    <div id="error-nombre" class="d-none">
                                        <p id="text-nombre" class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
    
                            {{-- Abreviatura  --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="abreviatura">Abreviatura: <span class="text-danger ml-2"></span></label>
                                    <input  type="text" 
                                            class="form-control" 
                                            id="abreviatura" 
                                            name="abreviatura" 
                                            required>
                                    <div id="error-abreviatura" class="d-none">
                                        <p id="text-abreviatura" class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
    
                            {{-- Unidad de medida  --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="unidad_medida">Unidad: <span class="text-danger ml-2"></span></label>
                                    <input  type="text" 
                                            class="form-control" 
                                            id="unidad_medida" 
                                            name="unidad_medida" 
                                            required>
                                    <div id="error-unidad_medida" class="d-none">
                                        <p id="text-unidad_medida" class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
    
                            {{-- descripcion  --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción: <span class="text-danger ml-2"></span></label>
                                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control w-100"></textarea>
                                    <div id="error-descripcion" class="d-none">
                                        <p id="text-descripcion" class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
    
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button  id="btnstore" type="button" class="btn btn-primary" onclick="store()">Ingresar</button>
                    <button  id="btnupdate" type="button" class="btn btn-primary" onclick="update()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js_after')

        {{-- dataTables jS--}}
        <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>


    // ****************************************************************************************************************
    // 									       Document Ready
    // ****************************************************************************************************************
    $(document).ready(function(){


        // **************************************** DataTable **********************************************************
        var table = $('#paramerts_list').DataTable({
            // bProcessing: true,
            // bStateSave: true,
            deferRender: true,
            responsive: true,
            processing: true,
            searching: true,
            pageLength: 10,
            ajax:{
                url: "{{ route('parameter.index') }}",
                type: 'GET'
            },
            language:{
                url: "{{ asset('js/plugins/datatables/spanish.json') }}",
            },
            columns: [
                {
                    data: 'id', 
                    name: 'id',
                    visible: false
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nombre', 
                    name: 'nombre'
                },
                {
                    data: 'abreviatura', 
                    name: 'abreviatura'
                },
                {
                    data: 'unidad_medida', 
                    name: 'unidad_medida'
                },
                {
                    data: 'descripcion', 
                    name: 'descripcion'
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                }
            ]
        });
    // ****************************************************************************************************************

    });
    // ****************************************************************************************************************


    // ****************************************************************************************************************
    // 									       Create
    // ****************************************************************************************************************
    function create(){
        clear();

        document.getElementById('title').innerHTML = 'Ingresar parámetro';
        document.getElementById('btnstore').classList.remove('d-none');
        document.getElementById('btnupdate').classList.add('d-none');

        $('#modal').modal('show');
    }
    // ****************************************************************************************************************

    
    // ****************************************************************************************************************
    // 									       Store
    // ****************************************************************************************************************
    function store(){

        axios.post("{{ route('parameter.store') }}", {
            nombre          : document.getElementById('nombre').value,
            abreviatura     : document.getElementById('abreviatura') .value,
            unidad_medida   : document.getElementById('unidad_medida').value,
            descripcion     : document.getElementById('descripcion').value
        })
        .then(function (response) {
             
            $('#modal').modal('hide');

            Swal.fire(
                'Ingreso exitoso!',
                'Se ingreso exitosamente el parámtro.',
                'success'
            )

            clearErrors();
        })
        .catch(function (error) {
            if(error.response.status == 422) {
                clearErrors();
                displayErrors(error.response.data.errors);
            }
        })
        .finally(() => {

            var Table = $('#paramerts_list').DataTable();
                Table.ajax.reload();
        });
    }
    // ****************************************************************************************************************


    // ****************************************************************************************************************
    // 									       Edit
    // ****************************************************************************************************************
    function edit(value){


        document.getElementById('title').innerHTML = 'Actualizar parámetro';
        document.getElementById('btnstore').classList.add('d-none');
        document.getElementById('btnupdate').classList.remove('d-none');

        axios.get("{{ route('parameter.edit') }}",{
            params: {
                id: value
            }
        })
        .then(function (response) {
            
            document.getElementById('id').value             = response.data.data.id;
            document.getElementById('nombre').value         = response.data.data.nombre;
            document.getElementById('abreviatura') .value   = response.data.data.abreviatura;
            document.getElementById('unidad_medida').value  = response.data.data.unidad_medida;
            document.getElementById('descripcion').value    = response.data.data.descripcion;
            
            $('#modal').modal('show');
        
        })
        .catch(function (error) {
            Swal.fire(
                'Error!',
                'Your file has been deleted.',
                'error'
            )
        })
    }
    // ****************************************************************************************************************


    // ****************************************************************************************************************
    // 									       Update
    // ****************************************************************************************************************
    function update(){

        axios.post("{{ route('parameter.update') }}", {
            id              : document.getElementById('id').value,
            nombre          : document.getElementById('nombre').value,
            abreviatura     : document.getElementById('abreviatura') .value,
            unidad_medida   : document.getElementById('unidad_medida').value,
            descripcion     : document.getElementById('descripcion').value
        })
        .then(function (response) {
             
            $('#modal').modal('hide');

            Swal.fire(
                'Actualización exitoso!',
                'Se actualización exitosamente el parámtro.',
                'success'
            )

            clearErrors();
        })
        .catch(function (error) {
            if(error.response.status == 422) {
                clearErrors();
                displayErrors(error.response.data.errors);
            }
        })
        .finally(() => {

            var Table = $('#paramerts_list').DataTable();
                Table.ajax.reload();
        });
    }
    // ****************************************************************************************************************

    // ****************************************************************************************************************
    // 									       Deleted
    // ****************************************************************************************************************
    function deleted(value){

        Swal.fire({
            title: '¿Está seguro(a) que desea eliminar el parámetro?',
            text: "Esta acción no es reversible!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.value) {

                    axios.delete("{{  route('parameter.delete') }}", {
                        params: {
                            id: value
                        }
                    })
                    .then(function (response) {
                        console.log(response);
                        
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )

                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .finally(() => {

                        var Table = $('#paramerts_list').DataTable();
                            Table.ajax.reload();
                    });
                }
            })
    }
    // ****************************************************************************************************************


    // ****************************************************************************************************************
    // 									       Clear
    // ****************************************************************************************************************
    function clear(){

        let inputs = ['nombre', 'abreviatura', 'unidad_medida', 'descripcion'];

        inputs.forEach(element => {
            document.getElementById(element).value = '';
        });
    }
    // ****************************************************************************************************************


    // ****************************************************************************************************************
    // 									       Errors
    // ****************************************************************************************************************
    function displayErrors(errors){

        if(typeof errors.nombre !== 'undefined') {
            create_elements(errors.nombre, 'nombre');
        }
        if(typeof errors.abreviatura !== 'undefined') {
            create_elements(errors.abreviatura, 'abreviatura');
        }
        if(typeof errors.unidad_medida !== 'undefined') {
            create_elements(errors.unidad_medida, 'unidad_medida');
        }
        if(typeof errors.descripcion !== 'undefined') {
            create_elements(errors.descripcion, 'descripcion');
        }
    }
    // ****************************************************************************************************************

     // ****************************************************** Clear Error **********************************************
     function clearErrors() 
    {
        let inputs = ['nombre', 'abreviatura', 'unidad_medida', 'descripcion'];

        inputs.forEach(element => {
            document.getElementById('text-'+element).innerHTML = '';
            document.getElementById('error-'+element).classList.add('d-none');
            document.getElementById(element).classList.remove('is-invalid');
        });
    };
    // *********************************************************************************************************************

    
    // ****************************************************** Create Elements **********************************************
    function create_elements(error, input) 
    {
        error.forEach(element => {
            document.getElementById('text-'+input).innerHTML = element;
            document.getElementById('error-'+input).classList.remove('d-none');
            document.getElementById(input).classList.add('is-invalid');
        });
    };
    // *********************************************************************************************************************

</script>
@endsection

