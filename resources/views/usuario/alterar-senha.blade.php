{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Cadastro')

@section('content_header')
@stop
@section('content')
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
            <form role="form" method="post" action="./editar_usuario_alterar">
              <div class="box-body">

                {{ csrf_field()  }}
              <br>
                <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados da Básicos</b></h5>
                 
                  <hr>
              <div class="row">
                
                 
              
                        <input type="hidden" class="form-control form-control-sm" name="id" style="background:#" value="<?php echo  $dados['dados'][0]->id;?>" readonly="">
              
                
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Nome:</label>
                        <input type="text" class="form-control form-control-sm" name="name" style="background:#" value="<?php echo  $dados['dados'][0]->name;?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">E-mail:</label>
                        <input type="text" class="form-control form-control-sm" name="email" style="background:#" value="<?php echo  $dados['dados'][0]->email;?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Senha:</label>
                        <input type="password" class="form-control form-control-sm" name="senha" style="background:#" value="<?php echo  $dados['dados'][0]->password;?>" required>
                    </div>
                 
                        </div>
                 
                        
                        <br>
               
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
                <a href="./consultar-nf"><button type="button" class="btn btn-secondary">Retornar</button> </a>
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
