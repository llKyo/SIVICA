
        <div class="twelve wide column">
            <form class="ui form" action="/periods/{{ $period->id}}" method="post">
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="three fields">
                    <div class="field">
                        <label>Fecha Inicial</label>
                        <div class="input">
                            <div class="" id="date_init2">
                              <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" name="init_date" value="{{ $period->init_date}}" required>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label>Fecha Final</label>
                        <div class="input">
                            <div class="" id="date_finish2">
                              <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" name="finish_date" value="{{ $period->finish_date}}"  required>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Fecha Restricion ( Suspencion*) </label>
                        <div class="input">
                            <div class="" id="date_restriction2">
                              <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" name="end_restriction_date" value="{{ $period->end_restriction_date}}" >
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="field">
                        <label>Descripcion</label>
                        <div class="ui mini input">
                            <textarea rows="2" name="description" required>{{ $period->description}}</textarea>
                        </div>
                    </div>

                <div class="actions">
                <button class="ui right floated small green labeled cancel icon button" type="submit">
                    <i class="marker icon"></i> Actualizar
                </button>
                <div class="ui right floated small cancel blue button">Volver</div><br>
                </div>
                </form>

                <script type="text/javascript">
                /**$(document).ready(function() {
                
                $('#date_init2').calendar({
                     type: 'date',
                      monthFirst: false,
                      text: {
                           days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                           months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                           monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                           today: 'Hoy',
                           now: 'Ahora',
                           am: 'AM',
                           pm: 'PM'
                         }
                    });
                    $('#date_finish2').calendar({
                         type: 'date',
                          monthFirst: false,
                          text: {
                               days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                               months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                               monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                               today: 'Hoy',
                               now: 'Ahora',
                               am: 'AM',
                               pm: 'PM'
                             }
                        });
                        $('#date_restriction2').calendar({
                             type: 'date',
                              monthFirst: false,
                              text: {
                                   days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                                   months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                   monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                                   today: 'Hoy',
                                   now: 'Ahora',
                                   am: 'AM',
                                   pm: 'PM'
                                 }
                            });
                            });**/
                </script>
