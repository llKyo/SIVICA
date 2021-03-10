@extends('layouts.app')
@section('content')
<div class="sixteen wide column">
    <h2>Certificacion de Patrones</h2>
    <h4 class="ui horizontal dividing header"><i class="certificate icon"></i>Ingresar Certification</h4>
    <form class="ui form" action="/certifications" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="four  fields">
            <div class="field">
                <label>Fecha de Certificacion</label>
                <div class="input">
                    <div class="ui calendar" id="date">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" name="date" placeholder="Date">
                      </div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Tipo / Marca</label>
                <div class="ui input">
                    <input type="text" name="type_brand"  required>
                </div>
            </div>
            <div class="field">
                <label>Numero de Serie</label>
                <div class="ui input">
                    <input type="text" name="sn" placeholder="Ingrese Numero de Serie" required>
                </div>
            </div>
            <div class="field">
                <label>Duracion (Meses)</label>
                <div class="ui input">
                    <input type="number" name="duration_time" placeholder="Ingrese duracion en meses" required>
                </div>
            </div>

        </div>
        <div class="three fields">
            <div class="field">
                <label>Documento</label>
                <input  type="file" id="doc_cert" placeholder="" name="doc" class=""/>
            </div>
        </div>
        <button class="ui right floated small green labeled icon button" type="submit" data-content="Crear nuevo equipo">
            <i class="certificate icon"></i> Registrar
        </button>
    </form>

    <h4 class="ui horizontal dividing  header"><i class="certificate icon"></i>Lista</h4>
    <table class="ui celled table sortable">
        <thead>
            <tr>
                <th> ----- Fecha -----</th>
                <th>Tipo / Marca</th>
                <th>Numero Serie</th>
                <th>Vigencia</th>
                <th>Archivo</th>
                <th>Observacion MMA</th>
                <th>Observacion Empresa</th>
            </tr>
        </thead>
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
                <td>{{ $certification->check_observation }}</td>
                <td>{{ $certification->company_observation }}
                    <a class="circular ui mini icon defaut button info-modal-link pop" href="/certifications/{{ $certification->id }}/edit_comments"  title="Comentar" style="float:right;" data-content="Editar Comentario!">
                    <i class="icon blue comment"></i></a>
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
