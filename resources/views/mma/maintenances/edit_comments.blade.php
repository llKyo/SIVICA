@extends('layouts.app')
@section('content')
<div class="sixteen wide column">

<h4 class="ui horizontal dividing header"><i class="configure icon"></i>Editar comentarios Mantencion</h4>
<form class="ui form" action="/maintenances/{{ $maintenance->id }}/comments" method="post">
{{ csrf_field() }}

    <div class="column">
@if(Auth::user()->rol == 'admin')
        <div class="field">
            <label>Comentarios</label>
            <div class="ui fluid input">
                <textarea  name="mma_comment"  rows="2"  required>{{$maintenance->mma_comment}}</textarea>
            </div>
        </div>
@endif
@if(Auth::user()->rol == 'company')
        <div class="field">
            <label>Comentarios</label>
            <div class="ui fluid input">
                <textarea  name="company_comment"  rows="2"  required>{{$maintenance->company_comment}}</textarea>
            </div>
        </div>
@endif
    </div>

    <br>
    <div class="actions">
    <button class="ui right floated small green labeled cancel icon button" type="submit">
        <i class="lab icon"></i> Actualizar
    </button>
    <a class="ui right floated small cancel blue button" href="/maintenances">Volver</a><br>
    </div>
</form>

</div>{{-- div From App--}}
</div>{{-- div From App--}}
@endsection
