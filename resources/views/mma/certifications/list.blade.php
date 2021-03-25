@extends('layouts.app')
@section('content')

<div class="sixteen wide column">
    <h2>Certificacion de Patrones</h2>

    <h4 class="ui horizontal dividing  header"><i class="certificate icon"></i>Lista</h4>
    <table class="ui celled table sortable" id="certifications_table">
        <thead>
            <tr>
                <th> ----- Fecha -----</th>
                <th>Tipo / Marca</th>
                <th>Numero Serie</th>
                <th>Vigencia</th>
                <th>Archivo</th>
                <th>Observacion Empresa</th>
                <th>Observacion MMA</th>
                @if(Auth::user()->rol !='observer')
                <th>Acciones</th>
                @endif
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th> ----- Fecha -----</th>
                <th>Tipo / Marca</th>
                <th>Numero Serie</th>
                <th>Vigencia</th>
                <th>Archivo</th>
                <th>Observacion Empresa</th>
                <th>Observacion MMA</th>
                @if(Auth::user()->rol !='observer')
                <th>Acciones</th>
                @endif
            </tr>
        </tfoot>
        <tbody>
            @forelse($certifications as $certification)
            <tr>
                <td>{{ $certification->dateForChile() }}</td>
                <td>{{ $certification->type_brand }}</td>
                <td>{{ $certification->sn }}</td>
                <td>
                    @if($certification->isValid()=='expired')
                    <i class="red remove icon"></i>
                    @else
                    <i class="green checkmark icon"></i>
                    @endif
                    {{ $certification->isValid() == 'expired' ? 'Expirado' : 'Vigente'}}
                </td>
                <td>
                    @if($certification->path != null)
                    <a href="{{ url('/docs/certifications/'.$certification->path)}}">
                            <i class="large download icon"></i>
                    </a>
                        @else
                            -
                        @endif
                </td>
                <td>{{ $certification->company_observation }}</td>
                <td>{{ $certification->check_observation }}</td>
                @if(Auth::user()->rol !='observer')
                <td>
                    <a class="circular ui mini icon defaut button info-modal-link pop" href="/certifications/{{ $certification->id }}/edit_comments"  title="Comentar" style="float:left;" data-content="Comentar!">
                        <i class="icon blue comment"></i>
                    </a>
                    <!--    <a class="circular ui icon defaut button mini info-modal-link" href="/certifications/{{$certification->id}}/edit"  title="Editar" style="float:left;">
                            <i class="icon blue edit"></i>
                        </a>-->
                        <form  action="/certifications/{{ $certification->id }}" method="post" onSubmit="if(!confirm('Estas seguro de eliminar el registo!?')){return false;}" >
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="circular ui icon mini defaut button" type="submit" title="Eliminar" style="float:left;">
                                <i class="icon red remove"></i>
                            </button>
                        </form>

                </td>
                @endif
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

<script type="text/javascript">
    $(document).ready(function() {

        $('#certifications_table tfoot th').each( function () {
            var title = $(this).text();
            var w = $(this).width() - 5;
            $(this).html( '<input type="text" placeholder="Buscar" style="width:'+w+'px;"/>' );
        });

    var table = $('#certifications_table').DataTable();

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

@endsection
