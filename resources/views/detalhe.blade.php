{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Ponto')

@section('content_header')
@stop
<?php //dd($dados['funcionarios']);?>
@section('content')
    <div class="callout callout-info">
     
      <p><b>Fontes de dados:</b> Aniel Point x TOA.</p>
    </div>
      <div class="callout callout-info">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="./cadastrarPj">
              <div class="box-body">

                {{ csrf_field()  }}
              <br>
                <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados da Básicos</b></h5>
                 
                  <hr>
              <div class="row">
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Nome:</label>
                  <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->NOME_TOA;?>" readonly="">
                </div>
                
                  <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Gerente:</label>
                  <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->GERENTE;?>" readonly="">
                </div>
                
                  <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Coordenador:</label>
                  <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->COORDENADOR;?>" readonly="">
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Supervisor:</label>
                  <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->SUPERVISOR;?>" readonly="">
                </div>

              
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Motivo:</label>
                  <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->STATUS_FINAL;?>" readonly="">
                </div>
                
              </div><br>
               <h5 style="color:#;"><b>Dados da Ocorrência</b></h5>
                  <hr>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data Ocorrência:</label>
                        <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->DATA;?>" readonly="">
                    </div>
                
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data Ocorrência:</label>
                        <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->DIA;?>" readonly="">
                    </div>
                
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Primeira marcação Aniel:</label>
                        <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->PRIMEIRA_MARCACAO;?>" readonly="">
                    </div>
                
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Última marcação Aniel:</label>
                        <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->ULTIMA_MARCACAO;?>" readonly="">
                    </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Início Atividade TOA:</label>
                        <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->INICIO_ATIVIDADE;?>" readonly="">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Fim Atividade TOA:</label>
                        <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->FIM_ATIVIDADE;?>" readonly="">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Primeira Ativ TOA:</label>
                        <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->PRI_ATIV_TOA.' - '.$dados['ponto'][0]->STATUS_PRI_ATIV_TOA;?>" readonly="">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Ultima Ativ TOA:</label>
                        <input type="text" class="form-control form-control-sm" name="" style="background:" value="<?php echo $dados['ponto'][0]->ULTIMA_ATIV_TOA.' - '.$dados['ponto'][0]->STATUS_ULTIMA_ATIV_TOA;?>" readonly="">
                    </div>
                </div>
<br> <!--
<h5 style="color:#;"><b>Dados da localização</b></h5>
                  <hr>
 <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {
        "packages":["map"],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        "mapsApiKey": "AIzaSyC6a5-_Ba4h1gtx2EBj1wCnkJfJrAj_Huc"
      });
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Lat', 'Long', 'Name'],
          [37.4232, -122.0853, 'Work'],
          [37.4289, -122.1697, 'University'],
          [37.6153, -122.3900, 'Airport'],
          [37.4422, -122.1731, 'Shopping']
        ]);

        var map = new google.visualization.Map(document.getElementById('map_div'));
        map.draw(data, {
          showTooltip: true,
          showInfoWindow: true
        });
      }

    </script>
  </head>
<br><br>     
 <div id="map_div" style="width: 500px; height: 300px"></div>
<br><br> -->
<div class="box-footer">
                <a href="<?php echo $dados['ponto'][0]->URL_CHEGADA;?>" target="_blank"><button type="button" class="btn btn-success"><b>Inicio</b> - Marcação x Atividade</button> </a>
                <a href="<?php echo $dados['ponto'][0]->URL_SAIDA;?>" target="_blank"><button type="button" class="btn btn-success"><b>Fim</b> - Marcação x Atividade</button> </a>
            <!--    <a href="./tratar?id=<?php echo $dados['ponto'][0]->ID;?>"><button type="button" class="btn btn-warning">Tratar marcação</button> </a> -->
                <a href="./ponto"><button type="button" class="btn btn-secondary">Retornar</button> </a>
                <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-">Relatório da ocorrência</button>
              </div><br>
            </form>
          </div>
          <!-- /.box -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Relatório da Ocorrência</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                     <?php
                     
                            echo '
                            <b>Empresa:</b> TLP SERVIÇOS
                            <br><b>Gerente:</b> '.$dados['ponto'][0]->GERENTE.'
                            <br><b>Coordenador:</b> '.$dados['ponto'][0]->COORDENADOR.'
                            <br><b>Supervisor:</b> '.$dados['ponto'][0]->SUPERVISOR.'
                            <br><br>
                            
                            <b>Relato:</b><br>
                            
                            O colaborador <b>'.$dados['ponto'][0]->NOME_TOA.'</b>, no dia <b>'.date('d/m/Y', strtotime($dados['ponto'][0]->DATA)).' ('.$dados['ponto'][0]->DIA.')</b>, realizou a primeira marcação de ponto às 
                            <b>'.$dados['ponto'][0]->PRIMEIRA_MARCACAO.'</b>, dando início a primeira atividade às <b>'.$dados['ponto'][0]->INICIO_ATIVIDADE.'</b>. Considerando que o expediente do mesmo, inicia 
                            às <b>08:00:00</b> o colaborador, teve diferença de <b>'.$dados['ponto'][0]->DIF_INI_PONT_ATIV.'</b>, em relação a primeira marcação, com início da atividade.
                            <br>
                            Já na marcação última marcação, o colaborador marcou às 
                            <b>'.$dados['ponto'][0]->ULTIMA_MARCACAO.'</b>, dando fim a última atividade às <b>'.$dados['ponto'][0]->FIM_ATIVIDADE.'</b>. Considerando que o expediente do mesmo, 
                            encerra-se às <b>17:00:00</b> o colaborador, teve diferença de <b>'.$dados['ponto'][0]->DIF_FIM_PONT_ATIV.'</b>, em relação a última marcação, com fim da atividade.
                    ';?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <!-- <button type="button" class="btn btn-success">Imprimir</button> -->
                  </div>
                </div>
              </div>
            </div>
         
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')

@stop
