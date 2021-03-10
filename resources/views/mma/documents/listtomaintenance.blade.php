@extends('layouts.app')
@section('content')


<div class="sixteen wide column">
    <h1>Asignacion de Reportes</h1>
    <h4 class="ui horizontal dividing  header"><i class="calendar icon"></i>Lista Mantenciones</h4>


    <form class="ui form" action="" method="post">
        <div class="four fields">
            <div class="field">
                <label>Estacion </label>
                    <select class="ui  search dropdown" id="station_filter" >
                        @forelse($stations as $station)
                        <option value="{{ $station->id}}" >{{ $station->name}}</option>
                        @empty
                        <span>Sin Datos Aun</span>
                        @endforelse
                    </select>

            </div>

            <div class="field">
                <label>Año</label>
                <select class="ui  dropdown"  id="year_filter">
                    @forelse($years as $year)
                    <option value="{{ $year->year_mma }}" >{{  $year->year_mma }}</option>
                    @empty
                    @endforelse
                </select>
            </div>

            <div class="field">
                <label>Mes</label>
                <select class="ui  dropdown"  id="month_filter">
                    <option value="all" >Todos</option>
                    <option value="Enero" >Enero</option>
                    <option value="Febrero" >Febrero</option>
                    <option value="Marzo" >Marzo</option>
                    <option value="Abril" >Abril</option>
                    <option value="Mayo" >Mayo</option>
                    <option value="Junio" >Junio</option>
                    <option value="Julio" >Julio</option>
                    <option value="Agosto" >Agosto</option>
                    <option value="Septiembre" >Septiembre</option>
                    <option value="Octubre" >Octubre</option>
                    <option value="Noviembre" >Noviembre</option>
                    <option value="Diciembre" >Diciembre</option>
                </select>
            </div>
            <div class="field">
                <label>&nbsp;&nbsp;</label>
                <a class="fluid ui  left floated green labeled icon button" href="javascript:filterDataTableCompany()" data-content="Filtrar">
                    <i class="filter icon"></i> Filtrar
                </a>
            </div>
        </div>
    </form>

    <h2 class="ui horizontal dividing  header"></h2>
    <table class="ui celled table sortable datatable" id="maintenances_table">
        <thead>
            <tr>
                <th>Estacion</th>
                <th>Actividad</th>
                <th>Año</th>
                <th>Mes</th>
                <th>Verificacion</th>
                <th><i class="icon green comment"></i> MMA</th>
                <th><i class="icon blue comment"></i> Empresa</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
                @forelse($maintenances as $maintenance)
                <tr>
                    <td>{{ $maintenance->station->name}}</td>
                    <td>
                        <a href="#"  class="tiny ui basic button pop" data-placement="top" data-variation="inverted" title="{{ $maintenance->activity->description }}">
                            {{ $maintenance->activity->name }}
                        </a>
                        </td>
                    <td>{{ $maintenance->year_mma}}</td>
                    <td>{{ $maintenance->month_mma}}</td>

                    <td>
                        {{ $maintenance->execution_date  }} <hr>

                        @forelse($maintenance->documents as $document)

                                @if($document->version != null)
                                <small>{{ $document->station->name.' '.$document->code.' '.$document->label.' v'.$document->version }}</small>
                                @else
                                <small>{{ $document->station->name.' '.$document->code.' '.$document->label}}</small>
                                @endif
                                <a href="{{ url('/docs/reports/'.$document->path)}}">
                                    <i class="large download icon"></i>
                                </a><br>
                        @empty
                        @endforelse
                        <small> </small>

                        <a class="circular ui mini icon green button pop" href="/assign_document/{{ $maintenance->id }}" data-variation="inverted" data-placement="top"  title="Asignar Documento">
                            <i class="plus left icon"></i><i class="file text icon"></i>
                        </a>


                    </td>
                    <td>{{ $maintenance->mma_comment }}</td>
                    <td>
                        {{ $maintenance->company_comment}}
                        <a class="circular ui mini icon defaut button pop" href="/maintenances/{{ $maintenance->id }}/edit_comments" data-variation="inverted" title="Editar Comentarios"  data-content="Editar Comentario">
                            <i class="icon blue comment"></i>
                        </a>
                    </td>
                    <td>
                        @if($maintenance->state == 'scheduled')
                            Calendarizada
                        @endif
                        @if($maintenance->state == 'in_process')
                            En proceso
                        @endif
                        @if($maintenance->state == 'finished')
                            Finalizada
                        @endif
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

</div>{{-- div From App--}}
</div>{{-- div From App--}}

<script type="text/javascript">
function filterDataTableCompany()
{
    $('#maintenances_table').DataTable().destroy();
    $.getJSON('/api/maintenances_assign/station/'+$('#station_filter :selected').val()+'/year/'+$('#year_filter :selected').val()+'/month/'+$('#month_filter :selected').val(), function(data){
        $('#maintenances_table').DataTable({
           "aaData": data,
           "aoColumns": [
                {"mDataProp":"station"},
                {"mDataProp":"activity"},
                {"mDataProp":"year"},
               {"mDataProp":"month"},
                {"mDataProp":"validation"},
                {"mDataProp":"mma_comment"},
                {"mDataProp":"company_comment"},
                {"mDataProp":"status"}
           ],
           "paging":   true,
           "ordering": true,
           "info":     true,
           fixedHeader: true,
           destroy: true,
       });
   });
}
</script>
@endsection
