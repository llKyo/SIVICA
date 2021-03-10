@extends('layouts.app')
@section('content')


<div class="sixteen wide column">
    @if(Auth::user()->rol == 'admin')
        <h4 class="ui horizontal dividing header"><i class="configure icon"></i>Assignar Mantencion -> Documento : {{$document->label}}</h4>
        <form class="ui form" action="/documents/{{ $document->id }}/comments" method="post">
        {{ csrf_field() }}
    @else
        <h2>Editar Comentarios</h2>
        <h4 class="ui horizontal dividing header"><i class="configure icon"></i>Editar comentarios , Documento:  {{$document->label}}</h4>
        <form class="ui form" action="/documents/{{ $document->id }}/comments" method="post">
        {{ csrf_field() }}
    @endif
        
    

    <div class="row">
    @if(Auth::user()->rol == 'admin')
            <div class="field">
<div class="ui form">
  <span class="ui label blue">Documento:</span> {{ $document->path }} <br><br>
  <span class="ui label ">Codigo:</span> {{ $document->code }} <br><br>
  <span class="ui label blue ">Descripcion:</span> {{ $document->description }} <br><br>
  <span class="ui label">Periodo:</span> {{ $document->period->description }} <br>
  <h5>Mantenciones Asignadas</h5>
    
  <div class="inline field">
    <p>Selecciona para editar asignacion</p>

    <select name="skills" multiple="" class="label ui selection fluid dropdown">
      @foreach($maintenances_assing as $m_assing)
      <option value="{{ $m_assing->id }}" selected="selected">{{ $m_assing->activity->name }} | {{ $m_assing->month_mma }}{{ $m_assing->year_mma }}</option>
      @endforeach
      @foreach($maintenances_diff as $m_diff)
      <option value="{{ $m_diff->id }}" >{{ $m_diff->activity->name }} | {{ $m_diff->month_mma }}{{ $m_diff->year_mma }}</option>  
      @endforeach

      

    </select>
  </div>
  

   
</div>
  <br>
            </div>
            <div class="field">
                <label>Comentario</label>
                <div class="ui mini input">
                    <textarea  name="mma_comment"  rows="2"  required>{{$document->mma_comment}}</textarea>
                </div>
            </div>
    @endif
    @if(Auth::user()->rol == 'company')
            <div class="field">
                <label>Comentario</label>
                <div class="ui mini input">
                    <textarea  name="company_comment"  rows="2"  required>{{$document->company_comment}}</textarea>
                </div>
            </div>
    @endif
        </div>
        <br>

        <div class="actions">
        <button class="ui right floated small green labeled cancel icon button" type="submit">
            <i class="refresh icon"></i> Actualizar
        </button>
        <a class="ui right floated small blue button" href="/documents">Volver</a><br>
        </div>
    </form>
</div>
<script>
    $('.label.ui.dropdown').dropdown();

$('.no.label.ui.dropdown').dropdown({
  useLabels: false
});

$('.ui.button').on('click', function () {
  $('.ui.dropdown')
    .dropdown('restore defaults')
});

</script>
@endsection