{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Brigada')

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
            <form role="form" method="post" action="./atualizar_brigada"  enctype="multipart/form-data">
              <div class="box-body">

                {{ csrf_field()  }}
              <br>
                <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados da Básicos</b></h5>
                 
                  <hr>
              <div class="row">
                
                   <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Técnico Anterior:</label>
                        <select name="tecnico_anterior" class="form-control form-control-sm" value="{{ $dados['dados'][0]->tecnico_anterior }}" readonly>
                            <option value="teste">teste</option>
                        </select>
                        </div>
                    <input type="hidden" class="form-control form-control-sm" name="id" style="background:#" value="{{ $dados['dados'][0]->id }}" readonly="">
                    
                   <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Supervisor Anterior:</label>
                        <select name="supervisor_anterior" class="form-control form-control-sm" value="{{ $dados['dados'][0]->supervisor_anterior }}" readonly>
                            <option value="teste">teste</option>
                        </select>
                        </div>                
                  <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data Edição:</label>
                        <input type="text" class="form-control form-control-sm" name="data_edicao" style="background:#" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y H:i:s');?>" readonly="">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Login Edição:</label>
                        <input type="text" class="form-control form-control-sm" name="login_editar" style="background:#" value="<?php echo  auth()->user()->name;?>" readonly="">
                    </div>
              </div><br>
               <h5 style="color:#;"><b>Dados da atividade</b></h5>
                  <hr>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Número da Ordem:</label>
                        <input type="text" class="form-control form-control-sm" name="ordem" style="background:#" value="{{ $dados['dados'][0]->ordem }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Endereço:</label>
                        <input type="text" class="form-control form-control-sm" name="endereco" style="background:#" value="{{ $dados['dados'][0]->endereco }}" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">MSAN:</label>
                        <input type="text" class="form-control form-control-sm" name="msan" style="background:#" value="{{ $dados['dados'][0]->msan }}" readonly>
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Caixa:</label>
                        <input type="text" class="form-control form-control-sm" name="caixa" style="background:#" value="{{ $dados['dados'][0]->caixa }}" readonly>
                    </div>
                    
<br>
                        <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">Causa Abertura:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="causa_abertura" readonly>{{ $dados['dados'][0]->causa_abertura }}</textarea>
                         </div>
                  </div>
                  <br>
               <h5 style="color:#;"><b>Dados da Ocorrência</b></h5>
                  <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">Como foi encontrado?</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="encontrado" required></textarea>
                         </div>
                         
                             <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">O que foi feito?:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="tratamento" required></textarea>
                         </div>
                         
                             <div class="form-group col-md-6">
                            <label for="exampleFormControlTextarea1">Foto do Antes:</label>
                            <input type="file" class="form-control form-control-sm" name="antes" style="background:#" value="" required>
                         </div>
                
                
                             <div class="form-group col-md-6">
                            <label for="exampleFormControlTextarea1">Foto do Depois:</label>
                            <input type="file" class="form-control form-control-sm" name="depois" style="background:#" value="" required>
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
                <a href="./brigada"><button type="button" class="btn btn-secondary">Retornar</button> </a>
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
