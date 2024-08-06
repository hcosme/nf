@extends('adminlte::page')

@section('title', 'Logins')

@section('content_header')
<!--<meta http-equiv="refresh" content="30">
   <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop

@section('content')

<style>
   .blink_me {
  animation: blinker 5s linear infinite;
}

#circuloVermelho {
width: 10px;
height: 10px;
border-radius: 50%;
background-color: #FF0000;
margin: 0px;
}

@keyframes blinker {  
  50% { opacity: 0; }
}

</style>

 
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
           
           <iframe width="1150" height="1100" src="https://lookerstudio.google.com/embed/reporting/127f4e37-4118-4a1d-867b-1f444742e076/page/p_ts4yshfb4c" frameborder="0" style="border:0" allowfullscreen></iframe>
           
           
           </div>
          <!-- /.box -->
        </div>
      </div>
      </div>

@section('js')
<script>

    $(document).ready(function() {
    var table = $('#example').DataTable({
        columnDefs: [{
            orderable: false,
            targets: [1,2,3]
        }]
    });
 
    $('button').click( function() {
        var data = table.$('input, select').serialize();
        alert(
            "The following data would have been submitted to the server: \n\n"+
            data.substr( 0, 120 )+'...'
        );
        return false;
    } );
} );

  $(document).ready(function(){
      $('#minhaTabela2').DataTable({
            
          "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Realize o filtro",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "loadingRecords": "Carregando...",
                "processing":     "Processando...",
                "search":         "Pesquisar:",
                "paginate": {
                    "first":      "Primeira",
                    "last":       "Última",
                    "next":       "Próxima",
                    "previous":   "Anterior"
                },
            },
                     "order": [[ 0, 'asc' ], [ 3, 'desc' ]]
        });
  });

  </script>

@stop
@stop
