
        <div class="twelve wide column">
            <form class="ui form" action="/names/{{ $name->id}}" method="post">
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="field">
                        <label>Nombre</label>
                        <input type="text" name="name" value="{{ $name->name}}" placeholder="Ingrese Nombre de Equipo" required>
                    </div>

                <div class="actions">
                <button class="ui right floated small green labeled cancel icon button" type="submit">
                    <i class="refresh icon"></i> Actualizar
                </button>
                <div class="ui right floated small cancel blue button">Volver</div><br>
                </div>
            </form>
        </div>
