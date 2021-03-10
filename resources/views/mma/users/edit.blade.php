
<div class="twelve wide column">
  <h4 class="ui horizontal dividing header"><i class="user icon"></i>Editar Usuario</h4>
  <form class="ui form" action="/users/{{ $user->id}}" method="post">
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="three  fields">
      <div class="field">
        <label>Nombre</label>
        <div class="ui mini input">
          <input type="text" name="name" value="{{ $user->name}}" required>
        </div>
      </div>
      <div class="field">
        <label>Apellido</label>
        <div class="ui mini input">
          <input type="text" name="last_name" value="{{ $user->last_name}}" required>
        </div>
      </div>
      <div class="field">
        <label>Rol en Sistema</label>
        <div class="ui mini input">
          <select class="ui dropdown" name="rol" required>
            <option value="company" {{ $user->rol == 'company' ? 'selected="selected"' : ''}} >Empresa</option>
            <option value="admin" {{ $user->rol == 'admin' ? 'selected="selected"' : ''}} >Administrador (MMA)</option>
              <option value="observer" {{ $user->rol == 'observer' ? 'selected="selected"' : ''}} >Visualizador </option>
          </select>
        </div>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Email</label>
        <div class="ui mini input">
          <input type="email" name="email" value="{{ $user->email}}" required>
        </div>
      </div>
      <div class="field">
        <label>Password</label>
        <div class="ui mini input">
          <input type="password" name="password" placeholder="Ingresa nuevo, para actualizar" >
        </div>
      </div>
    </div>
    <div class="actions">
      <button class="ui right floated small green labeled cancel icon button" type="submit">
        <i class="add user icon"></i> Actualizar
      </button>
      <div class="ui right floated small cancel blue button">Volver</div><br>
    </div>
  </form>
</div>
