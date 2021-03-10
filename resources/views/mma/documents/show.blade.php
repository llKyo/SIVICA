@extends('layouts.app')
@section('content')
<div class="sixteen wide column">

    <style media="screen">
        .show_list_doc li{
                margin-top: 5px;
        }
    </style>
    <h4 class="ui horizontal dividing header"><i class="file text icon"></i> Reporte Operacional</h4>
    <ul class="show_list_doc">

        <li> <span class="ui label red"> # DOCUMENTO</span> :
            @if($document->path != null)
            <a href="{{ url('/docs/reports/'.$document->path)}}">
                    <i class="large download icon"></i>
            </a>
                @else
                    -
                @endif
                @if($document->version != null)
                <small>{{ $document->station->name.' '.$document->code.' '.$document->label.' v'.$document->version }}</small>
                @else
                <small>{{ $document->station->name.' '.$document->code.' '.$document->label}}</small>
                @endif
        </li>
        <li> <span class="ui label blue">DESCRIPCION</span> : {{ $document->description }}</li>
        <li> <span class="ui label blue">ESTACION</span> : {{ $document->station->name }}</li>
        <li> <span class="ui label blue">FECHA INGRESO / EDICION</span>: {{ $document->updated_at }}</li>
        <li> <span class="ui label blue">PERIODO</span> :
            @if(isset($document->period))
          {{ $document->period->description }}
            @else
            -
            @endif
        </li>
        <li> <span class="ui label blue">COMENTARIO MMA</span> : {{ $document->mma_comment}}</li>
        <li> <span class="ui label blue">COMENTARIO EMPRESA</span> : {{ $document->company_comment}}</li>
    </ul>
    <br>
    <div class="actions">
        <a class="ui right floated small blue button" href="/documents">Volver</a><br>
    </div>
</div>
@endsection
