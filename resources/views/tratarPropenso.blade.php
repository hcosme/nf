{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Propenso')

@section('content_header')
@stop
<?php //dd($dados['funcionarios']);?>
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
            <form role="form" method="post" action="./gravarHistoricoPropenso">
              <div class="box-body">

                {{ csrf_field()  }}
              <br>
                <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados da Básicos</b></h5>
                 
                  <hr>
              <div class="row">
                 <input type="hidden" class="form-control form-control-sm" name="ID" style="background:white" value="<?php echo $dados['propenso'][0]->ID;?>" readonly="">
                
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">PSR:</label>
                  <input type="text" class="form-control form-control-sm" name="PSR" style="background:white" value="<?php echo $dados['propenso'][0]->PSR;?>" readonly="">
                </div>
                  <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Técnico:</label>
                  <input type="text" class="form-control form-control-sm" name="TECNICO" style="background:white" value="<?php echo $dados['propenso'][0]->TECNICO;?>" readonly="">
                </div>
                
                  <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Coordenador:</label>
                  <input type="text" class="form-control form-control-sm" name="COORDENADOR" style="background:white" value="<?php echo $dados['propenso'][0]->COORDENADOR;?>" readonly="">
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Supervisor:</label>
                  <input type="text" class="form-control form-control-sm" name="SUPERVISOR" style="background:white" value="<?php echo $dados['propenso'][0]->SUPERVISOR;?>" readonly="">
                </div>

              
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Situação:</label>
                  <input type="text" class="form-control form-control-sm" name="ESTADO" style="background:white" value="<?php echo $dados['propenso'][0]->ESTADO;?>" readonly="">
                </div>
                
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">SID:</label>
                  <input type="text" class="form-control form-control-sm" name="SID" style="background:white" value="<?php echo $dados['propenso'][0]->SID;?>" readonly="">
                </div>
                
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Protocolo:</label>
                  <input type="text" class="form-control form-control-sm" name="Protocolo" style="background:white" value="<?php echo $dados['propenso'][0]->Protocolo;?>" readonly="">
                </div>
                
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Data Registro:</label>
                  <input type="text" class="form-control form-control-sm" name="DataRegistro" style="background:white" value="<?php echo $dados['propenso'][0]->DataRegistro;?>" readonly="">
                </div>
                
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Nome Consumidor:</label>
                  <input type="text" class="form-control form-control-sm" name="Nome_Consumidor" style="background:white" value="<?php echo $dados['propenso'][0]->Nome_Consumidor;?>" readonly="">
                </div>
                
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Prioridade:</label>
                  <input type="text" class="form-control form-control-sm" name="PRIORIDADE" style="background:white" value="<?php echo $dados['propenso'][0]->PRIORIDADE;?>" readonly="">
                </div>
                
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Ordem:</label>
                  <input type="text" class="form-control form-control-sm" name="ORDEM_BUSSOLA" style="background:white" value="<?php echo $dados['propenso'][0]->ORDEM_BUSSOLA;?>" readonly="">
                </div>
                
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Situação Prazo 24hs:</label>
                  <input type="text" class="form-control form-control-sm" name="CLASSIFICACAO_24H_CRIACAO_WFM" style="background:white" value="<?php echo $dados['propenso'][0]->ESTADO;?>" readonly="">
                </div>
                
                
                 <div class="form-group col-md-10">
                  <label for="exampleInputEmail1">Assunto:</label>
                  <input type="text" class="form-control form-control-sm" name="Assunto" style="background:white" value="<?php echo $dados['propenso'][0]->Assunto;?>" readonly="">
                </div>
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Responsável:</label>
                  <input type="text" class="form-control form-control-sm" name="RESPONSAVEL" style="background:white" value="<?php echo $dados['propenso'][0]->RESPONSAVEL;?>" readonly="">
                </div>
              </div><br>
              
<h5 style="color:#;"><b>Status de Tratamento</b></h5>
                  <hr>
                    <div class="row">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Situação:</label>
                        <select name="STATUS_HISTORICO" class="form-control form-control-sm" value="">
                            <option value="Acompanhamento">Acompanhamento</option>
                            <option value="Casa Fechada - Contato sem sucesso">Casa Fechada - Contato sem sucesso</option>
                            <option value="Concluido no TOA">Concluido no TOA</option>
                            <option value="Contato sem sucesso">Contato sem sucesso</option>
                            <option value="Em tratativa de campo">Em tratativa de campo</option>
                            <option value="ISOC">ISOC</option>
                            <option value="Mais de 3 contatos sem sucesso">Mais de 3 contatos sem sucesso</option>
                            <option value="Massiva ISOC">Massiva ISOC</option>
                            <option value="Massiva NOC">Massiva NOC</option>
                            <option value="Pendencia contato com cliente">Pendencia contato com cliente</option>
                            <option value="Primeiro agendamento">Primeiro agendamento</option>
                            <option value="Reagendamento - Adequação predial">Reagendamento - Adequação predial</option>
                            <option value="Reagendamento - Contato sem sucesso">Reagendamento - Contato sem sucesso</option>
                            <option value="Reagendamento - Conveniência cliente">Reagendamento - Conveniência cliente</option>
                            <option value="Reagendamento - Equipamento">Reagendamento - Equipamento</option>
                            <option value="Resolvido">Resolvido</option>
                            <option value="Retornar contato">Retornar contato</option>
                            <option value="VoIP">VoIP</option>
                        </select>
                        </div>
                        <div class="form-group col-md-12">
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
                <a href="./propenso"><button type="button" class="btn btn-secondary">Retornar</button> </a>
              </div><br>
            </form>
          </div>
          <!-- /.box -->
          </div>
          </div>
          </div>
          </div>
          </div>


  <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
  <div class="box-body table-responsive no-padding">
 <table id="minhaTabela2" class="table table-striped table-sm table-bordered dataTable">
    <thead>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[HISTÓRICO] </th> 
        </tr>
      <tr class="bg-light text-center py-0 align-middle">
          
        <th style=" background-color:#191970;color:white;width:360px"><center>Data</th>
        <th style=" background-color:#191970;color:white;width:160px"><center>SID</th>
        <th style=" background-color:#191970;color:white;width:160px"><center>Usuário</th>
        <th style=" background-color:#191970;color:white;width:160px"><center>Situação</th>
        <th style=" background-color:#191970;color:white;width:360px"><center>Descrição</th>
        </tr>
    </thead>
    <tbody>
            <?php 
                foreach ($dados['informacoes'] as $gr) {
                   
                 
                    echo '<tr class="bg- text-center py-0 align-middle">
                            <td>'.date('d/m/Y H:i:s', strtotime($gr->data_cadastro)).'</td> 
                            <td>'.$gr->sid.'</td>
                            <td>'.$gr->usuario.'</td>
                            <td>'.$gr->status.'</td>
                            <td>'.$gr->historico.'</td>
                            
                    ';
                }
            ?>

    </tbody>
  </table>


         
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')

@stop
