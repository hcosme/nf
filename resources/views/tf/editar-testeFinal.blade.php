{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Teste Final')

@section('content_header')
@stop

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
            <form role="form" method="post" action="./editar-testefinal">
              <div class="box-body">

                {{ csrf_field()  }}
              <br>
                <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados da Básicos</b></h5>
                 
                  <hr>
              <div class="row">
                
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">ID:</label>
                        <input type="text" class="form-control form-control-sm" name="id" style="background:#" value="{{ $dados['dados'][0]->id }}" readonly>
                    </div>
                   
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data:</label>
                        <input type="date" class="form-control form-control-sm" name="data" style="background:#" value="{{ $dados['dados'][0]->DATA }}" required>
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Numero da Ordem:</label>
                        <input type="text" class="form-control form-control-sm" name="numero_ordem" style="background:#" value="{{ $dados['dados'][0]->NUMERO_ORDEM }}" required>
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Serviço:</label>
                        <select name="servico" class="form-control form-control-sm" value="" required>
                            <option value="{{ $dados['dados'][0]->SERVICO }}">{{ $dados['dados'][0]->SERVICO }}</option>
                            <option value="INSTALACAO">Instalação</option>
                            <option value="REPARO">Reparo</option>
                        </select>
                    </div>     
                
                   <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Técnico:</label>
                        <input type="text" class="form-control form-control-sm" name="tecnico" style="background:#" value="{{ $dados['dados'][0]->TECNICO }}">
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Status:</label>
                        <select name="status" class="form-control form-control-sm" value="" required>
                            <option value="{{ $dados['dados'][0]->STATUS }}">{{ $dados['dados'][0]->STATUS }}</option>
                            <option value="NOK">NOK</option>
                            <option value="OK">OK</option>
                        </select>
                    </div> 
                    
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Execução:</label>
                        <select name="execucao" class="form-control form-control-sm" value="" required>
                            <option value="{{ $dados['dados'][0]->EXECUCAO }}">{{ $dados['dados'][0]->EXECUCAO }}</option>
                            <option value="EXECUTADO">Executado</option>
                            <option value="N_EXECUTADO">Não Executado</option>
                        </select>
                    </div> 
                    
                    
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Operador:</label>
                        <input type="text" class="form-control form-control-sm" name="operador" style="background:#" value="{{ auth()->user()->name }}" readonly="">
                    </div>
                    
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Regional:</label>
                        <select name="regional" class="form-control form-control-sm" value="" required>
                            <option value="{{ $dados['dados'][0]->REGIONAL }}">{{ $dados['dados'][0]->REGIONAL }}</option>
                            <option value="RJ">RJ</option>
                            <option value="SP">SP</option>
                        </select>
                    </div> 
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Contato Cliente:</label>
                        <input type="text" class="form-control form-control-sm" name="contato_cliente" style="background:#" value="{{ $dados['dados'][0]->CONTATO_CLIENTE }}">
                    </div>
                    

                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Produção:</label>
                        <select name="producao" class="form-control form-control-sm" value="" required>
                            <option value="FFA">FFA</option>
                        </select>
                    </div> 
                    
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Tecnologia:</label>
                        <select name="tecnologia" class="form-control form-control-sm" value="" required>
                            <option value="{{ $dados['dados'][0]->TECNOLOGIA }}">{{ $dados['dados'][0]->TECNOLOGIA }}</option>
                            <option value="FTTC">FTTC</option>
                            <option value="FTTH">FTTH</option>
                        </select>
                    </div> 
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Evidencia Modem:</label>
                        <select name="evidencia_modem" class="form-control form-control-sm" value="" required>
                            <option value="{{ $dados['dados'][0]->EVIDENCIA_MODEM }}">{{ $dados['dados'][0]->EVIDENCIA_MODEM }}</option>
                            <option value="NAO">NÃO</option>
                            <option value="SIM">SIM</option>
                        </select>
                    </div> 
           
<br>
                        <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">Observação:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="obs" required>{{ $dados['dados'][0]->OBS }}</textarea>
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
                <a href="./testefinal"><button type="button" class="btn btn-secondary">Retornar</button> </a>
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
