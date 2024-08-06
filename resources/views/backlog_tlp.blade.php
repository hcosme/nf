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
    <!-- <div class="row">
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Início:</label>
                  <input type="date" class="form-control form-control-md" name="inicio" value="<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    };?>" id="exampleInputEmail1" >
                </div>
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Fim:</label>
                  <input type="date" class="form-control form-control-md" name="fim" value="<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    };?>" id="exampleInputEmail1" >
                </div>  
             
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Gerência:</label>
                  <select class="form-control form-control-md" name="gerencia">
                      <option value="">TODOS</option>
                <?php 
                    foreach ($dados['gerencia'] as $ger) {
                        echo '<option value="'.$ger->gerencia.'">'.$ger->gerencia.'</option>';    
                    }
                    ?>
                  </select>
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Tipo Atividade:</label>
                  <select class="form-control form-control-md" name="atividade">
                       <option value="">TODOS</option>
                <?php 
                    foreach ($dados['atividade'] as $ger) {
                        echo '<option value="'.$ger->atividade.'">'.$ger->atividade.'</option>';    
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">GROSS:</label>
                  <select class="form-control form-control-md" name="gross">
                   <?php if(isset($_GET['gross'])) {
                         
                    echo '<option value="'.$_GET['gross'].'">'.$_GET['gross'].'| Seleção atual</option>';
                    };?>
                    <option value="3">TODOS</option>
                    <option value="0">NÃO</option>
                    <option value="1">SIM</option>
                  </select>
                </div>
          
                <!--
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Tipo de Backlog:</label>
                  <select class="form-control form-control-md" name="tipo_backlog">
                       <option value="">TODOS</option>
                   <?php 
                    foreach ($dados['tipo_backlog'] as $ger) {
                        echo '<option value="'.$ger->tipo_backlog.'">'.$ger->tipo_backlog.'</option>';    
                    }
                    ?>
                  </select>
                </div>
                
              <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-secondary" value="Filtrar">
              </div>
</form>
              <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
              </div> -->
</div>
</div>
</div>




 

    <div class="row">
      <div class="col-12">
        <div class="card">
       


 
  </form>



              <!-- /.box-body -->
      <!--         </div>
          <!-- /.box -->
   <!--      </div>
        </div>
        </div>
-->
        <div class="google-data-studio">
            <iframe width="1600" height="1500" src="https://datastudio.google.com/embed/reporting/53149e35-4185-4465-a4d0-933a1df9a87b/page/3HG9C" frameborder="0" style="border:0" allowfullscreen></iframe>
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
