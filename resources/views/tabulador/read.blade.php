{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Ver')

@section('content_header')
@stop
<?php //dd('aqui');?>
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
              <div class="box-body">

                {{ csrf_field()  }}
              <br>
                <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados da Básicos</b></h5>
                 
                  <hr>
              <div class="row">
                
                     <div class="form-group col-md-1">
                        <label for="exampleInputEmail1">ID:</label>
                        <input type="text" class="form-control form-control-sm" name="id" style="background:#" value="<?php echo  $dados['dados'][0]->id;?>" readonly="">
                    </div>
                
                    
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Provedor:</label>
                        <input type="text" class="form-control form-control-sm" name="PROVEDOR" style="background:#" value="<?php echo  $dados['dados'][0]->PROVEDOR;?>" readonly="">
                    </div>
                
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">N Ordem:</label>
                        <input type="text" class="form-control form-control-sm" name="N_ORDEM" style="background:#" value="<?php echo  $dados['dados'][0]->N_ORDEM;?>" readonly>
                    </div>
                        <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Produto:</label>
                        <input type="text" class="form-control form-control-sm" name="PRODUTO" style="background:#" value="<?php echo  $dados['dados'][0]->PRODUTO;?>" readonly>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="exampleInputEmail1">Atividade:</label>
                        <input type="text" class="form-control form-control-sm" name="ATIVIDADE" style="background:#" value="<?php echo  $dados['dados'][0]->ATIVIDADE;?>" readonly>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="exampleInputEmail1">Estado:</label>
                        <input type="text" class="form-control form-control-sm" name="ESTADO" style="background:#" value="<?php echo  $dados['dados'][0]->ESTADO;?>" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Endereco:</label>
                        <input type="text" class="form-control form-control-sm" name="ENDERECO" style="background:#" value="<?php echo $dados['dados'][0]->ENDERECO.' - '.$dados['dados'][0]->COMPLEMENTO.' - '.$dados['dados'][0]->CIDADE;?>" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Cliente:</label>
                        <input type="text" class="form-control form-control-sm" name="CLIENTE" style="background:#" value="<?php echo  $dados['dados'][0]->CLIENTE;?>" readonly>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="exampleInputEmail1">Ordem:</label>
                        <input type="text" class="form-control form-control-sm" name="ORDEM" style="background:#" value="<?php echo  $dados['dados'][0]->ORDEM;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data:</label>
                        <input type="text" class="form-control form-control-sm" name="DATA" style="background:#" value="<?php echo  $dados['dados'][0]->DATA;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Mudança:</label>
                        <input type="text" class="form-control form-control-sm" name="MUDANCA" style="background:#" value="<?php echo  $dados['dados'][0]->MUDANCA;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Telefone 01:</label>
                        <input type="text" class="form-control form-control-sm" name="TELEFONE_1" style="background:#" value="<?php echo  $dados['dados'][0]->TELEFONE_1;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Celular:</label>
                        <input type="text" class="form-control form-control-sm" name="CELULAR" style="background:#" value="<?php echo  $dados['dados'][0]->CELULAR;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Telefone 02:</label>
                        <input type="text" class="form-control form-control-sm" name="TELEFONE_2" style="background:#" value="<?php echo  $dados['dados'][0]->TELEFONE_2;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Telefone 03:</label>
                        <input type="text" class="form-control form-control-sm" name="TELEFONE_3" style="background:#" value="<?php echo  $dados['dados'][0]->TELEFONE_3;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Reserva Atividade:</label>
                        <input type="text" class="form-control form-control-sm" name="RESERVA_ATIVIDADE" style="background:#" value="<?php echo  $dados['dados'][0]->RESERVA_ATIVIDADE;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Velocidade:</label>
                        <input type="text" class="form-control form-control-sm" name="VELOCIDADE" style="background:#" value="<?php echo  $dados['dados'][0]->VELOCIDADE;?>" readonly>
                    </div>
                    
                                </div>
                          </div>
                           </div>
                            </div>
                                    </div>
                            </div>
                            
                            
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
            
                 <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados para contato</b></h5>
                 
                  <hr>
              <div class="row">
                    
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Sucesso no contato?:</label>
                        <select name="SUCESSO_CONTATO" class="form-control form-control-sm" value="" readonly>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                        </select>
                        </div>
                        
                        
                          <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Qual foi resultado no contato 01?</label>
                        <select name="RESULTADO_CONTATO_1" class="form-control form-control-sm" value="" readonly>
                            <option value="COM SUCESSO">COM SUCESSO</option>
                            <option value="SEM SUCESSO">SEM SUCESSO</option>
                        </select>
                        </div>
                        
                        <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Qual foi resultado no contato 02?</label>
                        <select name="RESULTADO_CONTATO_2" class="form-control form-control-sm" value="" readonly>
                            <option value="COM SUCESSO">COM SUCESSO</option>
                            <option value="SEM SUCESSO">SEM SUCESSO</option>
                        </select>
                        </div>
                        
                        <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Qual foi resultado no contato 03?</label>
                        <select name="RESULTADO_CONTATO_3" class="form-control form-control-sm" value="" readonly>
                            <option value="COM SUCESSO">COM SUCESSO</option>
                            <option value="SEM SUCESSO">SEM SUCESSO</option>
                        </select>
                        </div>
                        
                        <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Bucket atual:</label>
                        <select name="BUCKET_ATUAL" class="form-control form-control-sm" value="" readonly >
                            <option value="COM SUCESSO">COM SUCESSO</option>
                            <option value="SEM SUCESSO">SEM SUCESSO</option>
                        </select>
                        </div>
                                     
                        <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Bucket destino:</label>
                        <select name="BUCKET_DESTINO" class="form-control form-control-sm" value="" readonly>
                            <option value="COM SUCESSO">COM SUCESSO</option>
                            <option value="SEM SUCESSO">SEM SUCESSO</option>
                        </select>
                        </div>
                        
                        
                        <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Condições de agendamento?</label>
                        <select name="CONDICOES_AGENDAMENTO" class="form-control form-control-sm" value="" readonly>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                        </select>
                        </div>
                        <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Contato com sucesso?</label>
                        <select name="CONTATO_COM_SUCESSO" class="form-control form-control-sm" value="" readonly>
                            <option value="COM SUCESSO">COM SUCESSO</option>
                            <option value="SEM SUCESSO">SEM SUCESSO</option>
                        </select>
                        </div>

                        
                    
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Nome do contato:</label>
                        <input type="text" class="form-control form-control-sm" name="NOME_CONTATO" style="background:#" value="<?php echo  $dados['dados'][0]->NOME_CONTATO;?>" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Motivo do não agendamento:</label>
                        <input type="text" class="form-control form-control-sm" name="MOTIVO_N_AGENDAMENTO" style="background:#" value="<?php echo  $dados['dados'][0]->MOTIVO_N_AGENDAMENTO;?>" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Data Agendamento:</label>
                        <input type="date" class="form-control form-control-sm" name="DATA_AGENDAMENTO" style="background:#" value="<?php echo  $dados['dados'][0]->DATA_AGENDAMENTO;?>" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Turno:</label>
                        <select name="CONTATO_COM_SUCESSO" class="form-control form-control-sm" value="" readonly>
                            <option value="MANHA">MANHA</option>
                            <option value="TARDE">TARDE</option>
                            <option value="COMERCIAL">COMERCIAL</option>
                        </select>
                    </div>
                       <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Data cadastro:</label>
                        <input type="text" class="form-control form-control-sm" name="DATA_CADASTRO" style="background:#" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y H:i:s');?>" readonly="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Login Cadastro:</label>
                        <input type="text" class="form-control form-control-sm" name="LOGIN_CADASTRO" style="background:#" value="<?php echo  auth()->user()->name;?>" readonly="">
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
                <a href="./tabulador-index"><button type="button" class="btn btn-secondary">Retornar</button> </a>
              </div><br>
          </div>
          <!-- /.box -->

         
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')

@stop
