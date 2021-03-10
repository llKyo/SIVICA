@extends('layouts.app')
@section('content')

<div class="sixteen wide column">
    <h1>Periodos</h1>
    <h4 class="ui horizontal dividing header"><i class="settings icon"></i>Crear Nuevo Periodo</h4>
    <form class="ui form" action="/periods" method="post">
        {{ csrf_field() }}
        <div class="three fields">
            <div class="field">
                <label>Fecha Inicial*</label>
                <div class="input">
                    <div class="ui calendar date_period" id="date_init">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" name="init_date" placeholder="Date" required>
                      </div>
                    </div>
                </div>
            </div>

            <div class="field">
                <label>Fecha Final*</label>
                <div class="input">
                    <div class="ui calendar date_period" id="date_finish">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" name="finish_date" placeholder="Date" required>
                      </div>
                    </div>
                </div>
            </div>
            
            <div class="field">
                <label>Fecha Restricion ( Suspencion*) </label>
                <div class="input">
                    <div class="ui calendar date_period">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" name="end_restriction_date" placeholder="Date">
                      </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="field">
                <label>Descripcion</label>
                <div class="ui input">
                    <textarea rows="2" name="description" ></textarea>
                </div>
            </div>


        <button class="ui right floated small green labeled icon button" type="submit" data-content="Crear nuevo Periodo">
            <i class="setting icon"></i> Crear Periodo
        </button>
    </form>

    <h4 class="ui horizontal dividing  header"><i class="settings icon"></i>Lista de Periodos</h4>
    <table class="ui celled table sortable">
        <thead>
            <tr>
                <th>Fecha Inicial</th>
                <th>Fecha Final</th>
                <th>Restringido Desde:</th>
                <th>Descripcion</th>
                <th>Acciones</th>

            </tr>
        </thead>
        <tbody>
                @forelse($periods as $period)
                <tr>
                <td>{{ $period->init_date}}</td>
                <td>{{ $period->finish_date}}</td>
                <td>{{ $period->end_restriction_date}}</td>
                <td>{{ $period->description}}</td>
                <td>
                    <a class="circular ui mini icon defaut button info-modal-link" href="/periods/{{ $period->id }}/edit"  title="Editar" style="float:left;">
                        <i class="icon blue edit"></i>
                    </a>
                    <form id="del_" action="/periods/{{ $period->id }}" method="post" onSubmit="if(!confirm('Estas seguro de eliminar el periodo !?, sus datos asociados podrian perderse')){return false;}" >
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="circular mini ui icon defaut button" type="submit" title="Eliminar" style="float:left;">
                                <i class="icon red remove"></i>
                        </button>
                    </form>
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
$('.date_period').calendar({
     type: 'date',
      monthFirst: false,
      formatter: {
        date: function (date, settings) {
          if (!date) return '';
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          return year + '/' + month + '/' + day;
      }},
      text: {
           days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
           months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
           monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
           today: 'Hoy',
           now: 'Ahora',
           am: 'AM',
           pm: 'PM'
         }
    });
</script>
@endsection
