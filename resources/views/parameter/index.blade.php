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
            List Parameters
        </div>
        <div class="card-body">
            <table id="paramerts_list" class="table">
                <thead class="thead-dark">
                    <tr>
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
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script> --}}
        <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>




<script>
    $(document).ready(function(){

        var table = $('#paramerts_list').DataTable({
            bProcessing: true,
            bStateSave: true,
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
    });

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


                        // reload datatable 
                        var Table = $('#paramerts_list').DataTable();
                            Table.ajax.reload();
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                }
            })
    }

    function edit(value){

        axios.get("{{ route('parameter.edit') }}",{
            params: {
                id: 6
            }
        })
        .then(function (response) {
            console.log(response);
            
            // 1- asiganar valores a los input 
            document.getElementById('name').value = response.data.name;
            
            // 2- abrir el modal 
            $('#myModal').modal('show');
            
            if(response.data.success){
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
        .catch(function (error) {
            Swal.fire(
                'Error!',
                'Your file has been deleted.',
                'error'
            )
        })
    }

</script>
@endsection

