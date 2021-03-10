@extends('layouts.app')
@section('content')


<div class="sixteen wide column">

        <h2>Editar Comentarios</h2>
        <h4 class="ui horizontal dividing header"><i class="configure icon"></i>Editar comentarios , Documento:  {{$document->label}}</h4>
        <form class="ui form" action="/documents/{{ $document->id }}/comments" method="post">
        {{ csrf_field() }}

    <div class="row">

   
            <div class="field">
                <label>Comentario</label>
                <div class="ui mini input">
                    <textarea  name="company_comment"  rows="2"  required>{{$document->company_comment}}</textarea>
                </div>
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

@endsection