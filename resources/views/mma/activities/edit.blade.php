
        <div class="twelve wide column">
            <form class="ui form" action="/activities/{{ $activity->id}}" method="post">
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="field">
                        <label>Nombre (Abreviado)</label>
                        <div class="ui mini input">
                            <input type="text" name="name" placeholder="Ingrese Nombre" value="{{ $activity->name}}" required>
                        </div>
                    </div>
                    <div class="field">
                        <label>Color Asociado (haz clic para elegir)</label>
                        <div class="ui input">
                            <input type="color" name="color" value="{{ $activity->color}}" style="height: 35px;"  required>
                        </div>
                    </div>
                    <div class="field">
                        <label>Descripcion</label>
                        <div class="ui mini input">
                            <textarea rows="2" name="description" required>{{ $activity->description}}</textarea>
                        </div>
                    </div>

                <div class="actions">
                <button class="ui right floated small green labeled cancel icon button" type="submit">
                    <i class="refresh icon"></i> Actualizar
                </button>
                <div class="ui right floated small cancel blue button">Volver</div><br>
                </div>
                </form>
