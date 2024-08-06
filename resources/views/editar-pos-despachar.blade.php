{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Depachar Pós')

@section('content_header')
@stop
<?php //dd($dados['funcionarios']);?>
@section('content')
    <div class="callout callout-info">
     
      <p><b>Fontes de dados:</b> TOA.</p>
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
            <form role="form" method="post" action="./editarPos-despachado">
              <div class="box-body">

                {{ csrf_field()  }}
              <br>
                <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados da Básicos</b></h5>
                 
                  <hr>
              <div class="row">
                <div class="form-group col-md-3">
                  <input type="hidden" class="form-control form-control-sm" name="id" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->id;?>" readonly="">
                
                  <label for="exampleInputEmail1">Cliente:</label>
                  <input type="text" class="form-control form-control-sm" name="cliente" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->cliente;?>" readonly="">
                </div>
                
                
                   <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Contato:</label>
                  <input type="text" class="form-control form-control-sm" name="telefone" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->telefone;?>" readonly="">
                </div>
                
                  <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">UF:</label>
                  <input type="text" class="form-control form-control-sm" name="uf" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->uf;?>" readonly="">
                </div>
                 
                  <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Técnico:</label>
                  <input type="text" class="form-control form-control-sm" name="ordem" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->tecnico;?>" readonly="">
                </div>
                
                
                  <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Ordem:</label>
                  <input type="text" class="form-control form-control-sm" name="ordem" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->ordem;?>" readonly="">
                </div>
                
                  <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Service:</label>
                  <input type="text" class="form-control form-control-sm" name="service" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->service;?>" readonly="">
                </div>
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Atividade:</label>
                  <input type="text" class="form-control form-control-sm" name="tipo_atividade" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->tipo_atividade;?>" readonly="">
                </div>
                
              </div><br>
               <h5 style="color:#;"><b>Dados da Alteração</b></h5>
                  <hr>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data tratamento:</label>
                        <input type="text" class="form-control form-control-sm" name="data_tratamento" style="background:#e0e0eb" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y H:i:s');?>" readonly="">
                    </div>
                    
                   <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Operador:</label>
                        <input type="text" class="form-control form-control-sm" name="operador" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->operador;?>" readonly="">
                    </div>
                    
                      <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Parametros estão OK?</label>
                        <input type="text" class="form-control form-control-sm" name="parametro" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->parametro;?>" readonly="">
                    </div>
                 
                   <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Contato feito com sucesso?</label>
                          <input type="text" class="form-control form-control-sm" name="com_sucesso" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->com_sucesso;?>" readonly="">
                    </div>
                       
                   <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Técnico deixou o contato?</label>
                          <input type="text" class="form-control form-control-sm" name="deixou_telefone_contato" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->deixou_telefone_contato;?>" readonly="">
                    </div>
                    
                         <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Necessita abertura de BD?</label>
                         <input type="text" class="form-control form-control-sm" name="proativo" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->proativo;?>" readonly="">
                    
                    </div>
                       <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Número proativo?</label>
                           <input type="text" class="form-control form-control-sm" name="n_proativo" style="background:#e0e0eb" value="<?php echo $dados['pos'][0]->n_proativo;?>" readonly="">
                        </div>
                
   
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Despachado?</label>
                        <select name="despachado" style="background:#00FF7F"  class="form-control form-control-sm">
                            <option value="NÃO">NÃO</option>
                            <option value="SIM">SIM</option>
                        </select>
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
                <a href="./pos"><button type="button" class="btn btn-secondary">Retornar</button> </a>
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
