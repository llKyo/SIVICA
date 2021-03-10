<h2>Editar Comentarios</h2>
<h4 class="ui horizontal dividing header"><i class="configure icon"></i>Editar comentarios Certificacion</h4>
<form class="ui form" action="/certifications/{{ $certification->id }}/comments" method="post">
{{ csrf_field() }}
    <div class="row">
    @if(Auth::user()->rol == 'admin')
            <div class="field">
                <label>Comentario</label>
                <div class="ui mini input">
                    <textarea  name="check_observation"  rows="2"  required>{{ $certification->check_observation }}</textarea>
                </div>
            </div>
    @endif

    @if(Auth::user()->rol == 'company')
            <div class="field">
                <label>Comentario Empresa</label>
                <div class="ui mini input">
                    <textarea  name="company_observation"  rows="2"  required>{{ $certification->company_observation }}</textarea>
                </div>
            </div>
    @endif
    </div>
    <br>
    <div class="actions">
    <button class="ui right floated small green labeled cancel icon button" type="submit">
        <i class="lab icon"></i> Actualizar
    </button>
    <div class="ui right floated small cancel blue button">Volver</div><br>
    </div>
</form>
