@extends('layouts.app')
@section('content')
<div class="sixteen wide column">
    <h1>Equipos</h1>

    <h4 class="ui horizontal dividing  header"><i class="flag icon"></i>Lista / Inventario</h4>
    <table class="ui celled table sortable datatable" id="elements_table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>N/S</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Propietario</th>
                <th>Estacion Asoc.</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>N/S</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Propietario</th>
                <th>Estacion Asoc.</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
            @forelse($elements as $element)
            <tr>
                <td>{{ $element->name->name }}</td>
                <td>{{ $element->brand }}</td>
                <td>{{ $element->model }}</td>
                <td>{{ $element->sn }}</td>
                <td>{{ $element->type->name }}</td>
                <td>{{ $element->state == 'enable' ? 'Operativo' : 'No Operativo' }}</td>
                <td>{{ $element->owner }}</td>
                <td>{{ $element->station == null? 'Sin estacion' : $element->station->name}}</td>
                <td>
                    <a class="circular ui icon defaut mini  button info-modal-link pop" href="/elements_inventary/{{$element->id}}/diag_repair"  title="Mover" style="float:left;" data-content="Ingresar Diagnostico/Reparacion!">
                        <i class="icon black configure"></i>
                    </a>

                </td>
            </tr>
            @empty
            <span>sin registros aun</span>
            @endforelse
        </tbody>
    </table>


    {{-- Modal Edit--}}
    <div class="ui small info modal edit_modal">
        <div class="content"></div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#elements_table tfoot th').each( function () {
                var title = $(this).text();
                var w = $(this).width() - 5;
                $(this).html( '<input type="text" placeholder="Buscar" style="width:'+w+'px;"/>' );
            });

        var table = $('#elements_table').DataTable();

        table.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
                });
        });



    });

    </script>
</div>{{-- div From App--}}
</div>{{-- div From App--}}
@endsection
