{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Cadastro')

@section('content_header')
@stop
<?php //dd($dados);?>
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
            <form role="form" method="post" action="./cadastrar_tecnico">
              <div class="box-body">

                {{ csrf_field()  }}
              <br>
                <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados da Básicos</b></h5>
                 
                  <hr>
              <div class="row">
                
                   <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Atividade:</label>
                        <select name="atividade" class="form-control form-control-sm" value="" >
                            <option value="INSTALACAO">INSTALACAO</option>
                            <option value="REPARO">REPARO</option>
                        </select>
                        </div>
                   <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Skill:</label>
                        <select name="skill" class="form-control form-control-sm" value="" >
                            <option value="FTTC">FTTC</option>
                            <option value="FTTH">FTTH</option>
                            <option value="MULTI">MULTI</option> 
                        </select>
                        </div>
                   <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Status:</label>
                        <select name="status" class="form-control form-control-sm" value="ATIVO" READONLY>
                            <option value="ATIVO">Ativo</option>
                        </select>
                        </div>
                        
                   <!--  <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Empresa:</label>
                        <input type="text" class="form-control form-control-sm" name="login_cadastro" style="background:#" value="<?php echo  auth()->user()->credenciada;?>" readonly="">
                    </div> -->
                
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Nome Técnico:</label>
                        <input type="text" class="form-control form-control-sm" name="tecnico" style="background:#" value="" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Matricula:</label>
                        <input type="text" class="form-control form-control-sm" name="matricula" style="background:#" value="" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Matricula TLP:</label>
                        <input type="text" class="form-control form-control-sm" name="matricula_alp" style="background:#" value="" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Placa:</label>
                        <input type="text" class="form-control form-control-sm" name="placa" style="background:#" value="" required>
                    </div>
                    
                      <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Telefone:</label>
                        <input type="text" class="form-control form-control-sm" name="telefone" style="background:#" value="" required>
                    </div>
                    
                    
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Nome Controlador:</label>
                        <input type="text" class="form-control form-control-sm" name="controlador" style="background:#" value="" required>
                    </div>
                    
                           <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Gerente:</label>
                        <select name="gerente" class="form-control form-control-sm" value="">
                            <?php 
                            foreach ($dados['gerente'] as $ger) {
                                echo '<option value="'.$ger->gerente.'">'.$ger->gerente.'</option>';
                                
                            };?>
                          
                        </select>
                        </div>
                        
                       <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Coordenador:</label>
                        <select name="coordenador" class="form-control form-control-sm" value="">
                            <?php 
                            foreach ($dados['coordenador'] as $coord) {
                                echo '<option value="'.$coord->coordenador.'">'.$coord->coordenador.'</option>';
                                
                            }
                            
                            
                            ;?>
                          
                        </select>
                        </div>
                        <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Supervisor:</label>
                        <select name="supervisor" class="form-control form-control-sm" value="">
                            <?php 
                            foreach ($dados['supervisor'] as $sup) {
                                echo '<option value="'.$sup->supervisor.'">'.$sup->supervisor.'</option>';
                                
                            }
                            
                            
                            ;?>
                          
                        </select>
                        </div>
                <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Fiscal:</label>
                        <select name="fiscal" class="form-control form-control-sm" value="">
                            <?php 
                            foreach ($dados['fiscal'] as $fis) {
                                echo '<option value="'.$fis->fiscal.'">'.$fis->fiscal.'</option>';
                                
                            }
                            
                            
                            ;?>
                          
                        </select>
                        </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Data cadastro:</label>
                        <input type="text" class="form-control form-control-sm" name="data_cadastro" style="background:#" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y H:i:s');?>" readonly="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Login Cadastro:</label>
                        <input type="text" class="form-control form-control-sm" name="login_cadastro" style="background:#" value="<?php echo  auth()->user()->name;?>" readonly="">
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
