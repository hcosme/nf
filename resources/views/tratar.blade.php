{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Walprint')

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
                  <input type="hidden" class="form-control form-control-sm" name="ID" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->ID;?>" readonly="">
                
                  <label for="exampleInputEmail1">Nome:</label>
                  <input type="text" class="form-control form-control-sm" name="NOME_TOA" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->NOME_TOA;?>" readonly="">
                </div>
                
                  <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Gerente:</label>
                  <input type="text" class="form-control form-control-sm" name="GERENTE" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->GERENTE;?>" readonly="">
                </div>
                
                  <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Coordenador:</label>
                  <input type="text" class="form-control form-control-sm" name="COORDENADOR" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->COORDENADOR;?>" readonly="">
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Supervisor:</label>
                  <input type="text" class="form-control form-control-sm" name="SUPERVISOR" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->SUPERVISOR;?>" readonly="">
                </div>

              
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Motivo:</label>
                  <input type="text" class="form-control form-control-sm" name="STATUS_FINAL" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->STATUS_FINAL;?>" readonly="">
                </div>
                
              </div><br>
               <h5 style="color:#;"><b>Dados da Ocorrência</b></h5>
                  <hr>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data Ocorrência:</label>
                        <input type="text" class="form-control form-control-sm" name="DATA" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->DATA;?>" readonly="">
                    </div>
                
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data Ocorrência:</label>
                        <input type="text" class="form-control form-control-sm" name="DIA" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->DIA;?>" readonly="">
                    </div>
                
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Primeira marcação Aniel:</label>
                        <input type="time" class="form-control form-control-sm" name="PRIMEIRA_MARCACAO" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->PRIMEIRA_MARCACAO;?>" readonly>
                    </div>
                
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Última marcação Aniel:</label>
                        <input type="time" class="form-control form-control-sm" name="ULTIMA_MARCACAO" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->ULTIMA_MARCACAO;?>" readonly>
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Início Atividade TOA:</label>
                        <input type="text" class="form-control form-control-sm" name="INICIO_ATIVIDADE" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->INICIO_ATIVIDADE;?>" readonly="">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Fim Atividade TOA:</label>
                        <input type="text" class="form-control form-control-sm" name="FIM_ATIVIDADE" style="background:#e0e0eb" value="<?php echo $dados['ponto'][0]->FIM_ATIVIDADE;?>" readonly="">
                    </div>
                </div>
<br>
<h5 style="color:#;"><b>Dados da alteração - ADM</b></h5>
                  <hr>
                    <div class="row">
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Marcação inicial ajustada Aniel:</label>
                        <input type="time" class="form-control form-control-sm" name="INICIO_AJUSTADO" style="background:#" value="" >
                    </div>
                
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Marcação final ajustada Aniel:</label>
                        <input type="time" class="form-control form-control-sm" name="FIM_AJUSTADO" style="background:#" value="" >
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Situação:</label>
                        <select name="STATUS_ADM" class="form-control form-control-sm" value="">
                            <option value="Corrigido">Corrigido</option>
                            <option value="Indevido">Indevido</option>
                            <option value="Aguardando gestor">Aguardando gestor</option>
                        </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="exampleFormControlTextarea1">Observação:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="OBSERVACAO"></textarea>
                         </div>
                        
                        
                  </div>
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
<br>
<div class="box-footer">
                <button type="submit" class="btn btn-success">Salvar</button> </a>
                <a href="./ponto"><button type="button" class="btn btn-secondary">Retornar</button> </a>
              </div><br>
            </form>
          </div>
          <!-- /.box -->

         
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')

@stop
