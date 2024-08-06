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
            <form role="form" method="post" action="./editar_apontamento_tecnico_atualizar_controlador">
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
                   
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Data Alteração:</label>
                        <input type="text" class="form-control form-control-sm" name="data_alteracao" style="background:#" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y H:i:s');?>" readonly="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Login Alteração:</label>
                        <input type="text" class="form-control form-control-sm" name="login_alteracao" style="background:#" value="<?php echo  auth()->user()->name;?>" readonly="">
                    </div>
                    </div>
                       <br>
                    <div class="form-group col-md-4">
                      <b>1. Técnico está com rota ativa?
                             <select class="form-control form-control-sm" name="rota_ativa[]" required>
                                 <option selected disabled value=""></option>
                                 
                           <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                        <b>2. Técnico está com atividades atribuidas?
                             <select class="form-control form-control-sm" name="atividades_atribuidas[]" required>
                                 <option selected disabled value=""></option>
                           <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            </div>
                            
                             <div class="form-group col-md-4">
                            <b>3. Técnico está com atividade iniciada as 8h?
                             <select class="form-control form-control-sm" name="atividade_iniciada[]" required>
                                 <option selected disabled value=""></option>
                           <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            </div>
                           
                           <div class="form-group col-md-4">
                            <b>4. As atividades iniciadas possuem CA?
                                <select name="atividade_iniciada_ca[]" class="form-control form-control-sm" value="" required>
                                <option selected disabled value=""></option>
                           <option value="S">SIM</option>
                            <option value="N">NÃO</option>

                                </select>
                            </div>
                            
                            <div class="form-group col-md-4">
                            <b>5. O técnico já está conectado no SuperApp?
                             <select class="form-control form-control-sm" name="superapp[]" required>
                                 <option selected disabled value=""></option>
                           <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
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
