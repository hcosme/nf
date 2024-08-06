{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Cadastro')

@section('content_header')
@stop
<?php //dd($dados['funcionarios']);?>
@section('content')
    <div class="callout callout-info">
     
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
            <form role="form" method="post" action="./editar_apontamento_tecnico_atualizar">
              <div class="box-body">

                {{ csrf_field()  }}
              <br>
                <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados da Básicos</b></h5>
                 
                  <hr>
              <div class="row">
                
                  
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">ID:</label>
                        <input type="text" class="form-control form-control-sm" name="id" style="background:#" value="<?php echo  $dados['dados'][0]->id;?>" readonly="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Nome Técnico:</label>
                        <input type="text" class="form-control form-control-sm" name="tecnico" style="background:#" value="<?php echo  $dados['dados'][0]->tecnico;?>" readonly>
                    </div>
                             <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Data Apontamento:</label>
                        <input type="text" class="form-control form-control-sm" name="data" style="background:#" value="<?php echo  $dados['dados'][0]->data;?>" readonly="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Apontamento:</label>
                        <select name="status" class="form-control form-control-sm" value="">
                           
                           
                           
                            <?php 
                           
                                echo '<option value="'.$dados['dados'][0]->status.'">'.$dados['dados'][0]->status.' | Atual</option>';
                    
                            
                            
                            ;?>
                            <option value="PRESENTE - CORRETIVA">PRESENTE - CORRETIVA</option>
                        <option value="PRESENTE - PREVENTIVA">PRESENTE - PREVENTIVA</option>
                        <option value="PRESENTE - RESIDENTE">PRESENTE - RESIDENTE</option>
                        <option value="PRESENTE - IMPLANTAÇÃO">PRESENTE - IMPLANTAÇÃO</option>
                        <option value="DP">DP</option>
                            <option value="SOBREAVISO">SOBREAVISO</option>
                                <option value="SOBREAVISO - ACIONADO">SOBREAVISO - ACIONADO</option>
                                    <option value="ADEQUACAO">ADEQUAÇÃO</option>
                                <option value="ALIVIO">ALÍVIO</option>
                                <option value="MASSIVA">MASSIVA</option>
                                <option value="NOTURNO">NOTURNO</option>
                                <option value="FOLGA - ESCALA">FOLGA - ESCALA</option>
                        <option value="INTERJORNADA">INTERJORNADA</option>
                             <option value="INSTALACAO_FTTC">INSTALACAO_FTTC</option>
                            <option value="INSTALACAO_FTTH">INSTALACAO_FTTH</option>
                            <option value="REPARO_FTTC">REPARO_FTTC</option>
                            <option value="REPARO_FTTH">REPARO_FTTH</option>
                            <option value="FALTA_S_JUSTIFICATIVA">FALTA_S_JUSTIFICATIVA</option>
                            <option value="FOLGA">FOLGA</option>
                            <option value="FERIAS">FERIAS</option>
                            <option value="DUPLADO">DUPLADO</option>
                            <option value="DSR">DSR</option>
                            <option value="ATESTADO">ATESTADO</option>
                            <option value="AFASTADO">AFASTADO</option>
                            <option value="DEMITIDO">DEMITIDO</option>
                            <option value="ALMOX">ALMOX</option>
                            <option value="RH">RH</option>
                            <option value="TREINAMENTO">TREINAMENTO</option>
                            <option value="SUSPENSAO">SUSPENSAO</option>
                            <option value="FROTA">FROTA</option>
                            <option value="EXAME_PERIODICO">EXAME_PERIODICO</option>
                            <option value="BLOQUEADO">BLOQUEADO</option>
                            <option value="REDE_BLINDADA">REDE_BLINDADA</option>
                            <option value="CAMPINAS - SPO">CAMPINAS - SPO</option>
                            <option value="CAMPINAS - Inloco">CAMPINAS - Inloco</option>

                          
                        </select>
                        </div>
                            <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">Observação:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="obs"><?php echo $dados['dados'][0]->obs;?></textarea>
                         </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Data Alteração:</label>
                        <input type="text" class="form-control form-control-sm" name="data_alteracao" style="background:#" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y H:i:s');?>" readonly="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Login Alteração:</label>
                        <input type="text" class="form-control form-control-sm" name="login_alteracao" style="background:#" value="<?php echo  auth()->user()->name;?>" readonly="">
                    </div>
              </div><br>
               
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
                <a href="./index"><button type="button" class="btn btn-secondary">Retornar</button> </a>
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
