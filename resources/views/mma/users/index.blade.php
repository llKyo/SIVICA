@extends('layouts.app')
@section('content')
<div class="sixteen wide column">
  <h1>Usuarios</h1>
  <h4 class="ui horizontal dividing header"><i class="user icon"></i>Crear Nuevo</h4>
  <form class="ui form" action="/users" method="post">
    {{ csrf_field() }}
    <div class="three  fields">
      <div class="field">
        <label>Nombre</label>
        <div class="ui mini input">
          <input type="text" name="name" placeholder="Ingrese Nombre" required>
        </div>
      </div>
      <div class="field">
        <label>Apellido</label>
        <div class="ui mini input">
          <input type="text" name="last_name" placeholder="Ingrese Apellido" required>
        </div>
      </div>
      <div class="field">
        <label>Rol en Sistema</label>
        <div class="ui mini input">
          <select class="ui " name="rol" required>
            <option value="observer">Visualizador</option>
            <option value="company">Empresa</option>
            <option value="admin">Administrador (MMA)</option>
          </select>
        </div>
      </div>
    </div>
    <div class="two fields">
      <div class="field">
        <label>Email</label>
        <div class="ui mini input">
          <input type="email" name="email" placeholder="Ingrese Email" required>
        </div>
      </div>
      <div class="field">
        <label>Password</label>
        <div class="ui mini input">
          <input type="password" name="password" placeholder="Ingrese Password" required>
        </div>
      </div>
    </div>
    <button class="ui right floated small green labeled icon button" type="submit" data-content="Crear nuevo usuario">
      <i class="add user icon"></i> Crear Usuario
    </button>
  </form>
  <h4 class="ui horizontal dividing  header"><i class="users icon"></i>Lista</h4>
  <table class="ui celled table sortable">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->last_name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          @if($user->rol == 'admin')
          Administrador MMA
          @elseif($user->rol == 'company')
          Empresa
          @elseif($user->rol == 'observer')
          Observador
          @endif
        </td>
        <td>
          <a class="circular mini ui icon defaut button info-modal-link" href="/users/{{$user->id}}/edit"  title="Editar" style="float:left;">
            <i class="icon  blue edit"></i>
          </a>
          <form id="del_{{ $user->id }}" action="/users/{{ $user->id }}" method="post" onSubmit="if(!confirm('Estas seguro de eliminar al usuario!?')){return false;}" >
            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="circular mini ui icon defaut button" type="submit" title="Eliminar" style="float:left;">
              <i class="icon red remove user"></i>
            </button>
          </form>
        </td>
      </tr>
      @empty
      <span>sin registros aun</span>
      @endforelse
    </tbody>
  </table>
  {{-- Modal Edit--}}
  <div class="ui small info modal edit_modal">
    <div class="content"></div>
  </div>
</div>{{-- div From App--}}
</div>{{-- div From App--}}
@endsection
