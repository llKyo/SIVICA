<div class="ui container">{{--Continue in content()--}}
    <div class="ui grid stackable">{{--Continue in content()--}}
@if(Auth::user()->rol =='admin')

    <div class="sixteen wide column">
        <div class="ui inverted  menu">
          <a id="statistics" href="/statistics" class="{{ $page == 'statistics' ? 'black item active' : 'item'}}">
            <i class="bar chart icon"></i>
            Inicio
          </a>
          <div class="ui dropdown item"><i class="calendar icon"></i>  Mantenciones <i class="dropdown icon"></i>
              <div class="menu">
                <a href="/maintenances" class="{{ $page == 'maintenances' ? 'black item active' : 'item'}}"> <i class="calendar icon"></i> Calendario</a>
                <a href="/activities" class="{{ $page == 'activities' ? 'black item active' : 'item'}}"><i class="settings icon"></i>Actividades</a>
                <a href="/list_certifications" class="{{ $page == 'list_certifications' ? 'black item active' : 'item'}}"><i class="certificate icon"></i>Certificaciones</a>
                <a href="/periods" class="{{ $page == 'periods' ? 'black item active' : 'item'}}"><i class="settings icon"></i>Periodos</a>
              </div>
          </div>
          <a  href="/documents" class="{{ $page == 'documents' ? 'black item active' : 'item'}}" > <i class="file text icon"></i>Reportes Operacionales</a>

          <div class="ui dropdown item"><i class="laptop icon"></i>  Equipos <i class="dropdown icon"></i>
              <div class="menu">
                <a href="/elements_inventary" class="{{ $page == 'elements_inventary' ? 'black item active' : 'item'}}"><i class="browser icon"></i> Inventario</a>
                <a href="/elements_movement" class="{{ $page == 'elements_movement' ? 'black item active' : 'item'}}"><i class="exchange icon"></i> Movimientos </a>
                <a href="/diag_repair" class="{{ $page == 'diag_repair' ? 'black item active' : 'item'}}"><i class="configure icon"></i> Diagnostico & Reparacion</a>
                <a href="/names" class="{{ $page == 'names' ? 'black item active' : 'item'}}"><i class="settings icon"></i>Nombres Equipos</a>
                <a href="/types" class="{{ $page == 'types' ? 'black item active' : 'item'}}"><i class="settings icon"></i>Tipos Equipos</a>
              </div>
          </div>
          <a href="/stations" class="{{ $page == 'stations' ? 'black item active' : 'item'}} "><i class="marker icon"></i>Estaciones</a>
          <a href="/reports" class="{{ $page == 'reports' ? 'black item active' : 'item'}}"><i class="filter icon"></i>Informes</a>
          <a href="/logs" class="{{ $page == 'logs' ? 'black item active' : 'item'}}"><i class="file icon"></i>Logs</a>
          <a href="/users" class="{{ $page == 'users' ? 'black item active' : 'item'}}"><i class="users icon"></i>Usuarios</a>

        </div>
    </div>

@elseif(Auth::user()->rol =='company')

<div class="sixteen wide column">
    <div class="ui inverted compact menu">
      <a id="statistics" href="/statistics" class="{{ $page == 'statistics' ? 'black item active' : 'item'}}"><i class="bar chart icon"></i>Inicio</a>
      <a href="/documents" class="{{ $page == 'documents' ? 'black item active' : 'item'}}"><i class="file text icon"></i> Reportes Operacionales</a>
      <a href="/assign_document" class="{{ $page == 'assign_document' ? 'black item active' : 'item'}}">
          <i class="file text icon"></i>
          <i class="caret right icon"></i>
          <i class="calendar icon"></i>
           Asignacion Reporte
       </a>
       <a href="/certifications" class="{{ $page == 'certifications' ? 'black item active' : 'item'}}"><i class="certificate icon"></i> Cert. Patrones</a>
       <a href="/list_elements" class="{{ $page == 'list_elements' ? 'black item active' : 'item'}}"><i class="flag icon"></i> Equipos</a>
       <a href="/elements_movement" class="{{ $page == 'elements_movement' ? 'black item active' : 'item'}}"><i class="exchange icon"></i> Mov. Equipos</a>
       <a href="/diag_repair" class="{{ $page == 'diag_repair' ? 'black item active' : 'item'}}"><i class="configure icon"></i> Diagnostico & Reparacion</a>
    </div>
</div>

@elseif(Auth::user()->rol =='observer')
<div class="sixteen wide column">
    <div class="ui inverted menu">
      <a id="statistics" href="/statistics" class="{{ $page == 'statistics' ? 'black item active' : 'item'}}">
        <i class="bar chart icon"></i>
        Inicio
      </a>
      <a  href="/maintenances" class="{{ $page == 'maintenances' ? 'black item active' : 'item' }}">
          <i class="calendar icon"></i>Mantenciones
      </a>
      <a  href="/list_certifications" class="{{ $page == 'list_certifications' ? 'black item active' : 'item'}}" >
          <i class="certificate icon"></i>Certificaciones
      </a>
      <a  href="/documents" class="{{ $page == 'documents' ? 'black item active' : 'item'}}" >
          <i class="file text icon"></i>Reportes Operacionales</a>

      <div class="ui dropdown item"><i class="laptop icon"></i>  Equipos <i class="dropdown icon"></i>
          <div class="menu">
            <a href="/elements_inventary" class="{{ $page == 'elements_inventary' ? 'black item active' : 'item'}}"><i class="browser icon"></i> Inventario</a>
            <a href="/elements_movement" class="{{ $page == 'elements_movement' ? 'black item active' : 'item'}}"><i class="exchange icon"></i> Movimientos </a>
            <a href="/diag_repair" class="{{ $page == 'diag_repair' ? 'black item active' : 'item'}}"><i class="configure icon"></i> Diagnostico & Reparacion</a>
          </div>
      </div>
      <a href="/stations" class="{{ $page == 'stations' ? 'black item active' : 'item'}} "><i class="marker icon"></i>Estaciones</a>
      <a href="/reports" class="{{ $page == 'reports' ? 'black item active' : 'item'}}"><i class="filter icon"></i>Informes</a>
    </div>
</div>

@endif
