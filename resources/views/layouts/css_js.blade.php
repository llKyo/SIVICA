<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.semanticui.min.css">
<link rel="stylesheet" href="/css/monthly.css">


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>

<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.semanticui.min.js" type="text/javascript"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.js" type="text/javascript"></script>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI-Calendar/76959c6f7d33a527b49be76789e984a0a407350b/dist/calendar.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI-Calendar/76959c6f7d33a527b49be76789e984a0a407350b/dist/calendar.min.js"></script>
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
{{-- Bootstrap Table --}}
<!-- Latest compiled and minified JavaScript -->
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">



<script type="text/javascript">
window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};
$(document).ready(function() {


    $('.message .close').on('click', function() {
        $(this).closest('.message').transition('fade');
        });

    $('#station_to_element').change(function(){
        var estacion = $( "#station_to_element option:selected").val();
        $.ajax({
            url:'/api/stations/'+estacion+'/elements',
            headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            method: 'GET',
            success: function(data){
				var cantidad = Object.keys(data).length;
				var i;
                $('#element_ajax option').remove();
                $('#element_ajax').dropdown('clear');
				$.each(data,function(i,item){
                         $('#element_ajax').append('<option value="'+item.id+'">Nombre: '+item.name.name+' |  S/N:'+item.sn+'</option>');
				});
                $('#element_ajax').append('<option value="" selected>Sin datos</option>');
            }
        });
    });

    $('#station_to_maintenance').change(function(){
        var estacion = $( "#station_to_maintenance option:selected").val();
        $.ajax({
            url:'api/stations/'+estacion+'/maintenances',
            headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
            method: 'GET',
            success: function(data){
                var cantidad = Object.keys(data).length;
                var i;
                $('#maintenance_ajax option').remove();
                $('#maintenance_ajax').dropdown('clear');
                $.each(data,function(i,item){
                    var state;
                    if (item.state == "scheduled"){ state ="Calendarizado"; }
                    if (item.state == "in_process"){ state ="En Proceso";}
                    if (item.state == "finished"){ state ="Finalizado";}
                         $('#maintenance_ajax').append('<option value="'+item.id+'" >'+item.activity+ ' &nbsp; | &nbsp;  '+item.date+' &nbsp;  | &nbsp;  '+state+'</option>');
                });
                $('#maintenance_ajax').append('<option value="" selected>Sin datos</option>');
            }
        });
    });

    $('.ui.radio.checkbox').checkbox();
    $('select.dropdown').dropdown();
    $('.info-modal-link').each(function () {
        $(this).on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url, function (data) {
            $('.info.modal .content').html(data);
            $(".info.modal").modal({
                closable:true,
                observeChanges:true,
                blurring: true,
                onShow: function(){
                    $('#date2').calendar({
                        type: 'date',
                         monthFirst: false,
                         formatter: {
                           date: function (date, settings) {
                             if (!date) return '';
                             var day = date.getDate();
                             var month = date.getMonth() + 1;
                             var year = date.getFullYear();
                             return year + '/' + month + '/' + day;
                         }},
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
                  }
            }).modal('show');

            });
        });

    });
    dateDesp();

 $('.datatable_log').DataTable({
     "order": [0,'desc']
 });
 $('.datatable').DataTable();
 $('.pop').popup({
    inline: true
  });
  $('.datatable_button').DataTable({
      dom: 'Bfrtip',
      buttons: [{
          extend: 'print',
       title: $('.header_export').text()
   },
   {
        extend: 'copy',
     title: $('.header_export').text()
   },
   {
        extend: 'excel',
     title: $('.header_export').text()
   },
   {
        extend: 'pdf',
     title: $('.header_export').text()
   }

    ]
  });

  $('.ui.dropdown').dropdown();



});

function dateDesp(){
    $('#date').calendar({
         type: 'date',
          monthFirst: false,
          formatter: {
            date: function (date, settings) {
              if (!date) return '';
              var day = date.getDate();
              var month = date.getMonth() + 1;
              var year = date.getFullYear();
              return year + '/' + month + '/' + day;
          }},
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
}



</script>
<style media="screen">
    .ui.vertical.menu .active.item{
        background: rgba(0,0,0,.8) !important;
        color: white;
    }

    .ui.dropdown {
  max-width: 800px;
}

@media only screen and (max-width: 767px) {
    .ui.selection.dropdown .menu {
/*      max-height: 8.01428571rem; /* + 1.335714285 to 9.349999995rem */
/*      max-height: 9.349999995rem; /* Adds a half */
        max-height: 16.02857142rem; /* Double size */
    }
}
@media only screen and (min-width: 768px) {
    .ui.selection.dropdown .menu {
/*         max-height: 10.68571429rem; /* + 1.3357142863 to 12.0214285763rem */
      max-height: 12.0214285763rem;
    }
}
@media only screen and (min-width: 992px) {
    .ui.selection.dropdown .menu {
      max-height: 16.02857143rem; /* + 1.3357142858 to 17.3642857158rem */
    }
}
@media only screen and (min-width: 1920px) {
    .ui.selection.dropdown .menu {
        max-height: 21.37142857rem; /* + 1.3357142856 to 22.7071428556rem */
    }
}

</style>
