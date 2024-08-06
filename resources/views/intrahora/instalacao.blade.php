@extends('adminlte::page')

@section('title', 'Instalação')

@section('content_header')
 <!--  <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop
<style>
  .google-data-studio {
        position: relative;
        padding-bottom: 56.25%;
        padding-top: 30px; height: 0; overflow: hidden;
        }
        
        .google-data-studio iframe,
        .google-data-studio object,
        .google-data-studio embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        }
</style>
@section('content')
<div class="callout callout-secondary">
    <a class="btn btn-light" data-toggle="in" href="#collapseExample4" role="button" aria-expanded="true" aria-controls="collapseExample4">
    <i class="fa fa-minus-square" aria-hidden="true"></i> Abrir filtro
  </a><p>
 <b>Fonte de dados:</b> TOA | <b>Última atualização: </b> <?php date_default_timezone_set('America/Sao_Paulo');
  echo date('d/m/Y H:i:s', strtotime($dados['AtualizacaoMontada'][0]->data_atualizacao));?>
  <IMG SRC="https://preloaders.evidweb.com/images/preloaders/ajax-loading-c7.gif" width="18px" heigh="18px">
</p>
<div class="in" id="collapseExample4">
<form action="./backlog_tlp" method="get">
    
</div>
</div>
</div>




 

    <div class="row">
      <div class="col-12">
        <div class="card">
       


 
  </form>



       
        <div class="google-data-studio">
            <iframe width="1600" height="1500" src="https://lookerstudio.google.com/embed/reporting/8164792a-962a-4bc9-b477-74b61b274858/page/bDDQD" frameborder="0" style="border:0" allowfullscreen></iframe>
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
      $('#minhaTabela').DataTable({
          "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
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
            }
        });
  });


  $(document).ready(function(){
      $('#minhaTabela2').DataTable({
          "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
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
            }
        });
  });

  </script>

@stop
@stop
