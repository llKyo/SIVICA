@extends('layouts.app')
@section('content')
<div class="sixteen wide column">
    <h1>Equipos</h1>
@if(Auth::user()->rol !='observer')
    <h4 class="ui horizontal dividing header"><i class="flag icon"></i>Crear Nuevo</h4>
    <form class="ui form" action="/elements_inventary" method="post">
        {{ csrf_field() }}
        <div class="three  fields">
            <div class="field">
                <label>Equipo</label>
                <select class="ui search dropdown" name="name_id" required>
                    @forelse($names as $name)
                            <option value="{{ $name->id }}" >{{ $name->name }}</option>
                    @empty
                    @endforelse

                </select>
            </div>
            <div class="field">
                <label>Tipo</label>

                    <select class="ui search dropdown" name="type_id" required>

                        @forelse($types as $type)
                                <option value="{{ $type->id }}" >{{ $type->name }}</option>
                        @empty
                        @endforelse
                    </select>

            </div>
            <div class="field">
                <label>Marca</label>
                <div class="ui  input">
                    <input type="text" name="brand" placeholder="Ingrese Marca" required>
                </div>
            </div>
        </div>
        <div class="three  fields">
            <div class="field">
                <label>Modelo</label>
                <div class="ui  input">
                    <input type="text" name="model" placeholder="Ingrese Modelo" required>
                </div>
            </div>
            <div class="field">
                <label>Numero de Serie</label>
                <div class="ui  input">
                    <input type="text" name="sn" placeholder="Ingrese Numero de Serie" required>
                </div>
            </div>
            <div class="field">
                <label>Propietario</label>
                <div class="ui  input">
                    <input type="text" name="owner" placeholder="Ingrese Propietario" required>
                </div>
            </div>

        </div>
        <div class="three fields">
            <div class="field">
                <label>Estado</label>
                <select class="ui dropdown" name="state" required>
                    <option value="enable" selected="selected">Operativo</option>
                    <option value="disable">No Operativo</option>
                </select>

            </div>
            <div class="field">
                <label>N/I</label>
                <div class="ui  input">
                    <input type="text" name="ni" placeholder="Ingrese N/I" required>
                </div>
            </div>
            <div class="field">
                <label>Garantia</label>
                <div class="ui  input">
                    <input type="date" name="warranty" placeholder="Ingrese Garantía" required>
                </div>
            </div>
        </div>
        <div class="three fields">
            <div class="field">
                <label>Estacion Asociada</label>

                    <select class="ui search dropdown" name="station_id">
                        <option value="" >Sin Estacion</option>
                        @forelse($stations as $station)
                        <option value="{{ $station->id}}" >{{ $station->name}}</option>
                        @empty
                        <span>Sin Datos Aun</span>
                        @endforelse
                    </select>

            </div>
            <div class="field">
                <label>Descripcion</label>
                <div class="ui  input">
                    <textarea  rows="2" name="description" required></textarea>
                </div>
            </div>
        </div>
        <button class="ui right floated small green labeled icon button" type="submit" data-content="Crear nuevo equipo">
            <i class="flag icon"></i> Crear Equipo
        </button>
    </form>
    @endif
    <h4 class="ui horizontal dividing  header"><i class="flag icon"></i>Lista / Inventario</h4>
    <table class="ui celled table sortable" id="elements_table">
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>N/S</th>
                <th>N/I</th>
                <th>Garantia</th>
                <th>Tipo</th>
                <th>Propietario</th>
                <th>Estado</th>
                <th>Estacion Asoc.</th>
                @if(Auth::user()->rol !='observer')
                <th> ------- Acciones ---------- </th>
                @endif
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Equipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>N/S</th>
                <th>N/I</th>
                <th>Garantia</th>
                <th>Tipo</th>
                <th>Propietario</th>
                <th>Estado</th>
                <th>Estacion Asoc.</th>
                @if(Auth::user()->rol !='observer')
                <th></th>
                @endif
            </tr>
        </tfoot>
        <tbody>
            @forelse($elements as $element)
            <tr>
                <td>{{ $element->name == null ? ' - ': $element->name->name  }}</td>
                <td>{{ $element->brand }}</td>
                <td>{{ $element->model }}</td>
                <td>{{ $element->sn }}</td>
                <td>{{ $element->ni }}</td>
                <td>{{ $element->warranty == "" ? "n.a." : $element->warranty}}</td>
                <td>{{ $element->type == null ? ' - ': $element->type->name }}</td>
                <td>{{ $element->owner }}</td>
                <td>{{ $element->state == 'enable' ? 'Operativo' : 'No Operativo' }}</td>
                <td>{{ $element->station == null? 'Sin estacion' : $element->station->name}}</td>
                @if(Auth::user()->rol !='observer')
                <td>


                    <a class="circular ui icon defaut mini button info-modal-link pop" href="/elements_inventary/{{$element->id}}/edit"  title="Ver y Editar" style="float:left;" data-content="Ver y Editar!">
                        <i class="icon blue edit"></i>
                    </a>
                    <form id="" action="/elements_inventary/{{ $element->id }}" method="post" onSubmit="if(!confirm('Estas seguro de eliminar el elemento!?')){return false;}" >
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="circular ui icon mini defaut button pop" type="submit" title="Eliminar" style="float:left;" data-content="Eliminar!">
                            <i class="icon red remove"></i>
                        </button>
                    </form>

                    <a class="circular ui icon defaut mini  button info-modal-link pop" href="/elements_inventary/{{$element->id}}/move"  title="Mover" style="float:left;" data-content="Mover, Retirar o Instalar!">
                        <i class="icon green exchange"></i>
                    </a>
                    <a class="circular ui icon defaut mini  button info-modal-link pop" href="/elements_inventary/{{$element->id}}/diag_repair"  title="Diagnosticar" style="float:left;" data-content="Ingresar Diagnostico/Reparacion!">
                        <i class="icon black configure"></i>
                    </a>

                </td>
                @endif
            </tr>
            @empty
            <span>sin registros aun</span>
            @endforelse
        </tbody>
    </table>


    {{-- Modal Edit--}}
    <div class="ui info modal edit_modal">
        <div class="content"></div>
    </div>


</div>{{-- div From App--}}
</div>{{-- div From App--}}

<script type="text/javascript">
    $(document).ready(function() {

        $('#elements_table tfoot th').each( function () {
            var title = $(this).text();
            var w = $(this).width() - 5;
            $(this).html( '<input type="text" placeholder="Buscar" style="width:'+w+'px;"/>' );
        });

    var table = $('#elements_table').DataTable();

    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
            });
    });



});

</script>
@endsection
