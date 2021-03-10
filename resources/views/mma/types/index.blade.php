@extends('layouts.app')
@section('content')
<div class="sixteen wide column">
  <h1>Tipos de Equipos</h1>
  <h4 class="ui horizontal dividing header"><i class="settings icon"></i>Crear Nuevo Tipo de Equipo</h4>
  <form class="ui form" action="/types" method="post">
    {{ csrf_field() }}
    <div class="field">
      <label>Nombre</label>
      <input type="text" name="name" placeholder="Ingrese Tipo de Equipo" required>
    </div>
    <button class="ui right floated small green labeled icon button" type="submit" data-content="Crear nuevo Tipo de Equipo">
      <i class="plus icon"></i> Crear Nuevo Tipo Equipo
    </button>
  </form>
  <br>
  <br>
  <h4 class="ui horizontal dividing  header"><i class="settings icon"></i>Lista de Tipos Equipos</h4>
  <table class="ui celled table sortable">
    <thead>
      <tr>
        <th>Id</th>
        <th>Tipo Equipo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($types as $type)
      <tr>
        <td>{{ $type->id}}</td>
        <td>{{ $type->name}}</td>
        <td>
          <a class="circular ui mini icon defaut button info-modal-link" href="/types/{{ $type->id }}/edit"  title="Editar" style="float:left;">
            <i class="icon blue edit"></i>
          </a>
          <form id="del_" action="/types/{{ $type->id }}" method="post" onSubmit="if(!confirm('Estas seguro de eliminar el tipo de equipo !?, sus datos asociados podrian perderse')){return false;}" >
            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="circular mini ui icon defaut button" type="submit" title="Eliminar" style="float:left;">
              <i class="icon red remove"></i>
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
