@extends('layouts.app')
@section('content')

<div class="sixteen wide column">

  <h4 class="ui horizontal dividing header"><i class="configure icon"></i>Assignar Mantencion -> Documento : {{$document->label}}</h4>
    <form class="ui form" action="/documents/{{ $document->id }}/maintenances" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}

    <div class="row">

            
<div class="ui form">
  <span class="ui label blue">Documento:</span> {{ $document->path }} <br><br>
  <span class="ui label ">Codigo:</span> {{ $document->code }} <br><br>
  <span class="ui label blue ">Descripcion:</span> {{ $document->description }} <br><br>
  <span class="ui label">Periodo:</span> {{ $document->period->description }} <br>
  <h5>Mantenciones</h5>
  

  <div class="inline field">
    <p>Selecciona la mantencion a agregar...</p>

    <select name="maintenances[]" multiple="" class="ui search dropdown" id="maintenances_diff">
        <option value="null" >Ninguna</option>
      @foreach($maintenances_diff as $m_diff)
      <option value="{{ $m_diff->id }}" >{{ $m_diff->activity->name }} | {{ $m_diff->month_mma }}{{ $m_diff->year_mma }}</option>  
      @endforeach
    </select>
  </div>
  

           
        </div>
          <br>
            </div>
            <div class="field">
                <label>Observacion para Mantencion</label>
                <small>solo si se selecciona una mantencion</small>
                <div class="ui mini input">
                    <textarea  name="check_observation"  rows="2" ></textarea>
                </div>
            </div>
            <div class="field">
                <label>Observacion General (Reporte)</label>
                <div class="ui mini input">
                    <textarea  name="mma_comment"  rows="2"  required>{{$document->mma_comment}}</textarea>
                </div>
            </div>
            <div class="field">
                <label>Referencias</label>
                <div class="ui mini input">
                    <textarea  name="another_comment"  rows="2" >{{$document->another_comment}}</textarea>
                </div>
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
/**$('.label.ui.dropdown').dropdown();

$('.no.label.ui.dropdown').dropdown({
  useLabels: false
});

$('.ui.button').on('click', function () {
  $('.ui.dropdown')
    .dropdown('restore defaults')
});**/

</script>
@endsection