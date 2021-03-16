@extends('layouts.app')
@section('content')

<div class="sixteen wide column">
  @if(Auth::user()->rol !='observer')
  <div class="row">
    <div class="column">
      <h1 class="ui header">Notificaciones</h1>
      <div class="ui divider"></div>
      <!--Certifications Alerts-->

      <!--Docs Alerts-->
    @if(Auth::user()->rol !='company')
      @if($maintenances->count() > 0)
      <div class="ui floating  warning message">
        <i class="close icon"></i>
        Atencion! Tienes
        <a class="ui label red">
          {{ $maintenances->count() }}
        </a>
        <strong>Mantenciones</strong> sin verificacion en el mes en Curso! ( <strong>{{ $maintenances->first()->month_mma }}</strong>  )
      </div>
      @endif
      <div class="ui floating  warning message">
        <i class="close icon"></i>
        Atencion! <strong>Faltan</strong> los siguientes documentos correlativos:
        <ul>
          @foreach ($faltantes as $f)
              <li> {{$f}} </li>
          @endforeach
        </ul>
      </div>
    @endif
      @if($period->count() > 0)
      @if($period->last()->documents->count() > 0)
      <div class="ui floating  info message">
        <i class="close icon"></i>
        Atencion! Tienes
        <a class="ui label red">
          {{ $period->last()->documents->count()}}
        </a>
        <a class="pop" href="{{url('/documents')}}" data-content="Ir a Reportes">Reportes</a> del ultimo Periodo!
      </div>
      @endif
      @endif

    </div>
  </div>
  <br>
  <br>
  @endif
  <div class="row">
    <div class="column">
      <h1 class="ui header">Estadisticas</h1>
      <div class="ui divider"></div>
      <div class="ui four statistics">
        <div class="statistic">
          <div class="value">
            <i class="blue marker icon"></i> {{$stations_count}}
          </div>
          <div class="label">
            Estaciones
          </div>
        </div>
        <div class="statistic">
          <div class="value">
            <i class=" blue flag icon"></i> {{$elements_count}}
          </div>
          <div class="label">
            Equipos Registrados
          </div>
        </div>
        <div class="statistic">
          <div class="value">
            <i class=" green flag icon"></i> {{ $elements_enable }}
          </div>
          <div class="label">
            Equipos Operativos
          </div>
        </div>
        <div class="statistic">
          <div class="value">
            <i class="red flag icon"></i>{{ $elements_disabled }}
          </div>
          <div class="label">
            Equipos No Operativos
          </div>
        </div>
        <div class="statistic">
          <div class="value">
            <i class="orange flag icon"></i>{{$elements_retire_count}}<i class="orange exchange icon"></i>
          </div>
          <div class="label">
            Equipos Retirados
          </div>
        </div>
        <div class="statistic">
          <div class="value">
            <i class="red flag icon"></i>{{$elements_retire_disable_count}}<i class="red exchange icon"></i>
          </div>
          <div class="label">
            Equipos Retirados - No Operativos
          </div>
        </div>
        <div class="statistic">
          <div class="value">
            <i class="yellow certificate icon"></i> {{$certification_valid_count}}
          </div>
          <div class="label">
            Certificaciones Vigentes
          </div>
        </div>
      </div>
    </div>
  </div>
</div>{{-- div From App--}}
</div>{{-- div From App--}}

@endsection
