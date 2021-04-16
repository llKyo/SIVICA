@extends('layouts.app')
@section('content')

<div class="sixteen wide column">

    <h1>Reportes Operacionales</h1>

@if(Auth::user()->rol == 'company')


    <h4 class="ui horizontal dividing header"><i class="file text icon"></i>Subir/Registrar Reporte</h4>
    @if ($errors->any())
    <div class="ui error message">
            <i class="close icon"></i>
            <div class="header">
            Existen los siguientes errores en el formulario:
            </div>
            <ul class="list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
    </div>
    @endif
    <form class="ui form" action="/documents" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="four fields">
            <div class="field">
                <label>Estacion Asociada</label>
                <select class="ui station_select" name="station_id" id="station_id" required>
                    @forelse($stations as $station)
                        <option value="{{$station->id}}">{{$station->name}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            <div class="field">
                <label>Codigo (Correlativo)</label>

                    <input type="text" name="code"  id="code_doc"  value="{{ old('code') }}" required>

                <small style="color:red" id="msg_code"></small>
            </div>
            <div class="field">
                <label>Version</label>
                <select class="ui dropdown" name="version" id="version" required>
                        <option value="1">v.1</option>
                        <option value="2">v.2</option>
                        <option value="3">v.3</option>
                        <option value="4">v.4</option>
                        <option value="5">v.5</option>
                        <option value="6">v.6</option>
                        <option value="7">v.7</option>
                        <option value="8">v.8</option>
                </select>
            </div>
            <div class="field">
                <label>Fecha (Año-Mes-Dia)</label>
                <div class="ui input">
                    <input type="text" name="label"  required value="{{ old('label') }}">
                </div>
                <!--<small style="color:red">El nombre de ser correlativo y de la misma nomenclatura</small>-->
            </div>

        </div>
            <div class="three fields">
                <div class="field">
                    <label>Descripcion (Que hay en el documento...pag, parrafo etc.)</label>
                    <div class="ui input">
                        <textarea rows="2" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="field">
                    <label>Subir Archivo (doc/pdf)</label>
                    <input  type="file" id="doc_cert" placeholder="" name="doc" class="" required/>
                </div>
                <div class="field">
                    <label>Periodos (Solo sin Restriccion)</label>
                    <select class="ui search dropdown" name="period_id" required>
                        @forelse($periods as $period)

                        @if( $date_now < $period->end_restriction_date )
                            <option value="{{$period->id}}"> {{$period->description}}</option>
                        @endif
                        @empty
                        @endforelse
                    </select>
                    <small style="color:red;">Los periodos en restriccion o pasados no apareceran.</small>
                </div>
            </div>



        <button class="ui right floated small green labeled icon button" type="submit" data-content="Subir Reporte">
            <i class="file text icon"></i> Subir Reporte
        </button>
    </form>

@endif
    <h4 class="ui horizontal dividing  header"><i class="file text icon"></i>Lista General Reportes</h4>
    <h4 class="ui horizontal dividing  header"><i class="filter icon"></i>Filtro por Periodo</h4>
        <form class="ui form" action="" method="post">
            <div class="two fields">
                <div class="field">
                    <label>Periodos</label>
                    <select class="ui  dropdown"  id="periods">
                        <option value="all" >Todos</option>
                        @foreach($periods as $period)
                        <option value="{{ $period->id }}">{{ $period->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label>&nbsp;&nbsp;</label>
                    <a class="ui fluid left floated small blue labeled icon button" href="javascript:filterDataTableDocuments()" data-content="Filtrar">
                        <i class="filter icon"></i> Filtrar
                    </a>
                </div>
            </div>
        </form>

    


    <table class="ui celled table sortable" id="documents_table" >
        <thead>
            <tr>
{{-- 
                <th>Ingreso | Edicion <br></th>
                <th>Periodo <br></th>
                <th>Codigo <br></th>
                <th>Version <br></th>
                <th>Reporte <br></th>
                <th>Estacion <br></th>
                <th>Mantencion Asoc. <br></th>
                <th>MMA <i class="icon comment"></i> <br></th>
                <th>Empresa <i class="icon comment"></i> <br></th>
                <th>Otros <i class="icon comment"></i> <br></th>
                <th>Contingencias <i class="icon warning"></i> <br></th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Acciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></th> --}}
            </tr>
        </thead>
    </table>


    {{-- Modal Edit--}}
    <div class="ui small info modal edit_modal">
        <div class="content"></div>
    </div>

</div>{{-- div From App--}}
</div>{{-- div From App--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}

<script type="text/javascript">
    $(document).ready(function() {

        $('#code_doc').blur(function(){
            var code = $('#code_doc').val();
            var station_id = $( "#station_id option:selected" ).val();

            $.ajax({
                url:'/api/valid_code/code/'+code+'/station/'+station_id,
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                method: 'GET',
                success: function(data){
                    if(data == "ok")
                    {
                        $('#msg_code').text('Codigo Correcto');
                        $('#msg_code').css('color','green');

                    }
                    else
                    {
                        $('#msg_code').text('Codigo Usado (Omitir mensaje si es una version 2 o mas)');
                        $('#msg_code').css('color','red');
                    }
                }
            });

        });

    $('#code_doc').click(function(){

    var station_id = $( "#station_id option:selected" ).val();
    $.ajax({
            url:'/api/valid_code_max/station/'+station_id,
            headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            method: 'GET',
            success: function(data){
                $('#msg_code').text('El codigo que debes usar es : '+data);
                $('#msg_code').css('color','green');
                //$('#code_doc').val(data);
            }
        });

    });

});

var $table = $('#documents_table');

function chargeTable() {
    console.log('/api/documents/period/'+$('#periods :selected').val()+'/user/{{ \Auth::user()->id }}');
    $table.bootstrapTable({
        method: 'get',
        exportDataType: 'selected',
        showExport: true,
        queryParams: function (p) {
        },
        url: '/api/documents/period/'+$('#periods :selected').val()+'/user/{{ \Auth::user()->id }}',
        cache: true,
        striped: true,
        pagination: true,
        pageSize: 5,
        pageList: [5, 10, 20, 50, 100],
        search: true,
        showColumns: true,
        showRefresh: true,
        minimumCountColumns: 2,
        clickToSelect: false, 
        onClickRow: function (row, element, field) {
            switch (field) {
                case 'Edit':
                    console.log('nepe pa que edita');
                    break;
            
                default:
                    break;
            }
        },
        columns: [ {
                field: 'date',
                title: 'Ingreso | Edicion',
                align: 'center',
                valign: 'center',
                sortable: true,
                // formatter: function (value, row) { },
            }, {
                field: 'code',
                title: 'Código',
                align: 'center',
                valign: 'center',
                sortable: true,
                // formatter: function (value, row) { },
            }, {
                field: 'version',
                title: 'Versión',
                align: 'center',
                valign: 'center',
                sortable: true,
                // formatter: function (value, row) { },
            }, {
                field: 'documents',
                title: 'Reporte',
                align: 'center',
                valign: 'center',
                sortable: true,
                // formatter: function (value, row) { },
            }, {
                field: 'station',
                title: 'Estación',
                align: 'center',
                valign: 'center',
                sortable: true,
                // formatter: function (value, row) { },
            }, {
                field: 'maintenances',
                title: 'Mantencion<br>Asoc.',
                align: 'center',
                valign: 'center',
                sortable: true,
                // formatter: function (value, row) { },
            }, {
                field: 'mma_comment',
                title: 'MMA <i class="icon comment"></i>',
                align: 'center',
                valign: 'center',
                sortable: true,
                // formatter: function (value, row) { },
            }, {
                field: 'company_comment',
                title: 'Empresa <i class="icon comment"></i>',
                align: 'center',
                valign: 'center',
                sortable: true,
                // formatter: function (value, row) { },
            }, {
                field: 'another_comment',
                title: 'Otros <i class="icon comment"></i>',
                align: 'center',
                valign: 'center',
                sortable: true,
                // formatter: function (value, row) { },
            }, {
                field: 'contingency',
                title: 'Contingencia',
                align: 'center',
                valign: 'center',
                sortable: true,
                // formatter: function (value, row) { },
            }, {
                field: 'actions',
                title: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Acciones &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                align: 'center',
                valign: 'center',
                sortable: false,
                // formatter: function (value, row) { },
            }, 
        ],
        formatLoadingMessage: function () {
            return 'Cargando, espere por favor'
        },
        formatSearch: function () {
            return 'Buscar'
        },
        formatRecordsPerPage (pageNumber) {
            return `${pageNumber} filas por página`
        },
        formatShowingRows (pageFrom, pageTo, totalRows, totalNotFiltered) {
            if (totalNotFiltered !== undefined && totalNotFiltered > 0 && totalNotFiltered > totalRows) {
            return `Mostrando ${pageFrom} a ${pageTo} de ${totalRows} filas (filtrado de ${totalNotFiltered} filas totales)`
            }

            return `Mostrando ${pageFrom} a ${pageTo} de ${totalRows} filas`
        },
    })
}


function filterDataTableDocuments()
{ 
    $table.bootstrapTable('destroy');
    chargeTable();
}

</script>
@endsection
