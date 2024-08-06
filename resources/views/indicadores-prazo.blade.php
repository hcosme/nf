@extends('adminlte::page')

@section('title', 'Indicadores')

@section('content_header')
 <!--  <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop

@section('content')
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />

<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Aguarde...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Aguardando disponibilização da qualidade.</p>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
   $('#myModal').modal('show');
});

// Redireciona o usuário para a página da DevMedia após cinco segundos
setTimeout(function() {
    window.location.href = "https://indicadores.gestaoderecursos.com/public/home";
}, 5000);

</script>
-->

  <div class="box-body responsive no-padding">
    <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Mês', 'Resultado', 'Meta'],
          <?php 
          /* foreach ($dados['indicadores'] as $historico) {
            echo '["'.$historico->MES.'",'.$historico->RESULTADO.'",'.$historico->META.'],';
          } */

          ?>
       
        ]);

        var options = {
          vAxis: {title: ''},
          hAxis: {title: ''},
          seriesType: 'bars',
          series: {2: {type: 'line'}},
            colors: ['#008B8B', '#7FFFD4'],
          bar: {groupWidth: "40%"},
          legend: {position: 'right', maxLines: 8},
          backgroundColor: 
          {
            fill:'white'        
          }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_divH'));
        chart.draw(data, options);
      }
            </script>    
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Dia', 'Anterior', 'Atual', 'Projeção'],
          <?php 
          /*  foreach ($dados['grafico2'] as $historico) {
            echo '["'.$historico->DIA.'",'.$historico->TOTAL_HE.','.$historico->A_TOTAL_HE.','.$historico->PROJECAO.'],'; 
          }*/

          ?>
       
        ]);

        var options = {
          vAxis: {title: ''},
          hAxis: {title: ''},
          seriesType: 'bars',
          series: {3: {type: 'line'}},
            colors: ['#008B8B', '#87ccb4', '#a5fadd'],
          bar: {groupWidth: "90%"},
          legend: {position: 'right', maxLines: 2},
          backgroundColor: 
          {
            fill:'white'        
          }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_divC'));
        chart.draw(data, options);
      }
      
    </script>
  </head>


    <div class="callout callout-secondary">
   <!--      <a class="btn btn-light" data-toggle="in" href="#collapseExample4" role="button" aria-expanded="true" aria-controls="collapseExample4">
    <i class="fa fa-minus-square" aria-hidden="true"></i> Abrir filtro
  </a><p>
 <b>Data da atualização: </b> 
 <?php  
  //  dd($dados['ind']);
  echo $dados['AtualizacaoMontada'][0]->data_atualizacao ;?>
  <IMG SRC="https://preloaders.evidweb.com/images/preloaders/ajax-loading-c7.gif" width="18px" heigh="18px">
</p>
<div class="in" id="collapseExample4">
<form action="./indicadores" method="get">
     <div class="row">
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Filial:</label>
                  <select class="form-control form-control-md" name="filial">
                    <?php 
                        if(isset($_GET['filial'])) {
                            echo '<option value='.$_GET['filial'].'>'.$_GET['filial'].'</option>';
                        }
                        
                        foreach ($dados['filial'] as $filial) {
                            echo '<option value='.$filial->filial.'>'.$filial->filial.'</option>';
                    
                        }
                    ?>
                  </select>
                </div>
      
              <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Tecnologia:</label>
                  <select class="form-control form-control-md" name="indice">
                    <?php 
                        if(isset($_GET['filial'])) {
                            echo '<option value='.$_GET['indice'].'>'.$_GET['indice'].'</option>';
                        }
                        
                        foreach ($dados['indice'] as $indice) {
                            echo '<option value='.$indice->indice.'>'.$indice->indice.'</option>';
                    
                        }
                    ?>
                  </select>
                </div>
        
                      <div class="form-group col-md-5">
                  <label for="exampleInputEmail1">Indicador:</label>
                  <select class="form-control form-control-md" name="indicadores">
                    <?php 
                        if(isset($_GET['ind'])) {
                            echo '<option value='.$_GET['ind'].'>'.$_GET['ind'].'</option>
                            <option value="Instalacao Linha de Cliente - Meta vs Realizado (Gross + Mud)">Instalacao Linha de Cliente - Meta vs Realizado (Gross + Mud)</option>
                        <option value="Cumprimento de Agenda - AGEN">Cumprimento de Agenda - AGEN</option>
                        <option value="Cumprimento de Agenda (Novo) - AGEN">Cumprimento de Agenda (Novo) - AGEN</option>
                        <option value="Eficiencia de Instalacao - EI">Eficiencia de Instalacao - EI</option>
                        <option value="Eficiencia Tecnica de Instalacao - ETI">Eficiencia Tecnica de Instalacao - ETI</option>
                        <option value="Veloc. MUD Linha de Cliente 3D.U. + 1 Visita Ok - VI 3 MUD">Veloc. MUD Linha de Cliente 3D.U. + 1 Visita Ok - VI 3 MUD</option>
                        <option value="Veloc. MUD Linha de Cliente 3D.U. - VI 3 MUD">Veloc. MUD Linha de Cliente 3D.U. - VI 3 MUD</option>
                        <option value="Veloc. INST Linha de Cliente em ate 3D.U. + 1 Visita Ok - VI 3">Veloc. INST Linha de Cliente em ate 3D.U. + 1 Visita Ok - VI 3</option>
                        <option value="Velocidade de Instalacao em ate 5 dias - Visao Cliente">Velocidade de Instalacao em ate 5 dias - Visao Cliente</option>
                        <option value="Veloc. INST Linha de Cliente em ate 10D.U. - VI 10">Veloc. INST Linha de Cliente em ate 10D.U. - VI 10</option>
                        <option value="Linhas em Servico - LIS">Linhas em Servico - LIS</option>
                        <option value="Volume Reparos Entrante">Volume Reparos Entrante</option>
                        <option value="Volume Reparos Entrante Despachado">Volume Reparos Entrante Despachado</option>
                        <option value="TT Abertos p/ Linhas Servico - TT BASE">TT Abertos p/ Linhas Servico - TT BASE</option>
                        <option value="TT Abertos p/ Linhas Servico Desp. Campo - TT BASE DESP">TT Abertos p/ Linhas Servico Desp. Campo - TT BASE DESP</option>
                        <option value="TT Recentes - TT REC">TT Recentes - TT REC</option>
                        <option value="TT Repetidos - TT REP">TT Repetidos - TT REP</option>
                        <option value="Resolucao de TT em ate 24h Visao Agenda - TT 24H AGENDA">Resolucao de TT em ate 24h Visao Agenda - TT 24H AGENDA</option>
                        <option value="Resolucao de TT em ate 24h Visao Agenda - TT 24H AGENDA DESP">Resolucao de TT em ate 24h Visao Agenda - TT 24H AGENDA DESP</option>
                        <option value="Resolucao de TT em ate 24h Visao Cliente - TT 24H VISaO CLIENTE">Resolucao de TT em ate 24h Visao Cliente - TT 24H VISaO CLIENTE</option>
                        <option value="Resolucao de TT Desp. em ate 24h Corridas - TT 24H DESP (ANATEL)">Resolucao de TT Desp. em ate 24h Corridas - TT 24H DESP (ANATEL)</option>
                        <option value="Resolucao de TT em ate 24h Corridas - TT 24H (ANATEL)">Resolucao de TT em ate 24h Corridas - TT 24H (ANATEL)</option>
                        <option value="Resolucao de TT em ate 48h Corridas - TT 48H (ANATEL)">Resolucao de TT em ate 48h Corridas - TT 48H (ANATEL)</option>';
                        } else{
                            echo '<option value="Instalacao Linha de Cliente - Meta vs Realizado (Gross + Mud)">Instalacao Linha de Cliente - Meta vs Realizado (Gross + Mud)</option>
                        <option value="Cumprimento de Agenda - AGEN">Cumprimento de Agenda - AGEN</option>
                        <option value="Cumprimento de Agenda (Novo) - AGEN">Cumprimento de Agenda (Novo) - AGEN</option>
                        <option value="Eficiencia de Instalacao - EI">Eficiencia de Instalacao - EI</option>
                        <option value="Eficiencia Tecnica de Instalacao - ETI">Eficiencia Tecnica de Instalacao - ETI</option>
                        <option value="Veloc. MUD Linha de Cliente 3D.U. + 1 Visita Ok - VI 3 MUD">Veloc. MUD Linha de Cliente 3D.U. + 1 Visita Ok - VI 3 MUD</option>
                        <option value="Veloc. MUD Linha de Cliente 3D.U. - VI 3 MUD">Veloc. MUD Linha de Cliente 3D.U. - VI 3 MUD</option>
                        <option value="Veloc. INST Linha de Cliente em ate 3D.U. + 1 Visita Ok - VI 3">Veloc. INST Linha de Cliente em ate 3D.U. + 1 Visita Ok - VI 3</option>
                        <option value="Velocidade de Instalacao em ate 5 dias - Visao Cliente">Velocidade de Instalacao em ate 5 dias - Visao Cliente</option>
                        <option value="Veloc. INST Linha de Cliente em ate 10D.U. - VI 10">Veloc. INST Linha de Cliente em ate 10D.U. - VI 10</option>
                        <option value="Linhas em Servico - LIS">Linhas em Servico - LIS</option>
                        <option value="Volume Reparos Entrante">Volume Reparos Entrante</option>
                        <option value="Volume Reparos Entrante Despachado">Volume Reparos Entrante Despachado</option>
                        <option value="TT Abertos p/ Linhas Servico - TT BASE">TT Abertos p/ Linhas Servico - TT BASE</option>
                        <option value="TT Abertos p/ Linhas Servico Desp. Campo - TT BASE DESP">TT Abertos p/ Linhas Servico Desp. Campo - TT BASE DESP</option>
                        <option value="TT Recentes - TT REC">TT Recentes - TT REC</option>
                        <option value="TT Repetidos - TT REP">TT Repetidos - TT REP</option>
                        <option value="Resolucao de TT em ate 24h Visao Agenda - TT 24H AGENDA">Resolucao de TT em ate 24h Visao Agenda - TT 24H AGENDA</option>
                        <option value="Resolucao de TT em ate 24h Visao Agenda - TT 24H AGENDA DESP">Resolucao de TT em ate 24h Visao Agenda - TT 24H AGENDA DESP</option>
                        <option value="Resolucao de TT em ate 24h Visao Cliente - TT 24H VISaO CLIENTE">Resolucao de TT em ate 24h Visao Cliente - TT 24H VISaO CLIENTE</option>
                        <option value="Resolucao de TT Desp. em ate 24h Corridas - TT 24H DESP (ANATEL)">Resolucao de TT Desp. em ate 24h Corridas - TT 24H DESP (ANATEL)</option>
                        <option value="Resolucao de TT em ate 24h Corridas - TT 24H (ANATEL)">Resolucao de TT em ate 24h Corridas - TT 24H (ANATEL)</option>
                        <option value="Resolucao de TT em ate 48h Corridas - TT 48H (ANATEL)">Resolucao de TT em ate 48h Corridas - TT 48H (ANATEL)</option>
';
                        }
                        
                       
                    ?>
  
  
                  </select>
                </div>
      
      
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-secondary" value="Filtrar">
              </div>
</form>
        
</div>
</div>
</div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">

 <table id="minhaTabçççela" class="table table-responsive table-sm table-bordered table-hover dataTable">
    <thead>
      <tr class="bg-light text- py-0 align-middle">
        <th style=" background-color:#;color:black;width:200px" colspan="18">[INDICADORES <?php 
          /* if (!empty($_GET['ATIVIDADE'])) {
            echo ' | ATIVIDADE: '.$_GET['ATIVIDADE'].' | FILIAL: '.$_GET['filial'];
          } */
        ?>
        ] </th>
        </tr>
         
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#;color:black;width:50px"><center>Filial</th>
        <th style=" background-color:#;color:black;width:50px" title=""><center>Tec.</th>
        <th style=" background-color:#;color:black;width:600px" title=""><center>Indicador</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Jan</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Fev</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Mar</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Abr</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Mai</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Jun</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Jul</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Ago</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Set</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Out</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Nov</th>
        <th style=" background-color:#;color:black;width:30px" title=""><center>Dez</th>
        </tr>
    </thead>
    <tbody>
          
            <?php 
    
                foreach ($dados['indicadores'] as $gr) {
        
                    echo '<tr class="bg- text-center py-0 align-middle">
                            <td>'.$gr->FILIAL.'</td>
                            <td>'.$gr->INDICE.'</td>
                            <td>'.$gr->INDICADORES.'</td>
                            <td>'.$gr->JANEIRO.'</td>
                            <td>'.$gr->FEVEREIRO.'</td>
                            <td>'.$gr->MARCO.'</td>
                            <td>'.$gr->ABRIL.'</td>
                            <td>'.$gr->MAIO.'</td>
                            <td>'.$gr->JUNHO.'</td>
                            <td>'.$gr->JULHO.'</td>
                            <td>'.$gr->AGOSTO.'</td>
                            <td>'.$gr->SETEMBRO.'</td>
                            <td>'.$gr->OUTUBRO.'</td>
                            <td>'.$gr->NOVEMBRO.'</td>
                            <td>'.$gr->DEZEMBRO.'</td>
                    ';
                }
                 
            ?>

    </tbody>
  </table>
  </form>
 
<br> -->
<i>Criado por André Cavaline - Analista FFA
</i><h3>Resultado RJO</h3>
<img src="https://gestaoderecursos.com/relatorio_rj.png" alt="HTML5 Icon" style="width:1350px;height:900px;">
<p><h3>Resultado SPL</h3>
<img src="https://gestaoderecursos.com/relatorio_sp.png" alt="HTML5 Icon" style="width:1350px;height:900px;">
             
              </div>
          <!-- /.box -->
        </div>
        </div>
        </div>
      </div>
      </div>

@section('js')
<script>

    $(document).ready(function() {
    var table = $('#example').DataTable({
        columnDefs: [{
            orderable: false,
            targets: [1,2,3]
        }]
    });
 
    $('button').click( function() {
        var data = table.$('input, select').serialize();
        alert(
            "The following data would have been submitted to the server: \n\n"+
            data.substr( 0, 120 )+'...'
        );
        return false;
    } );
} );

  $(document).ready(function(){
      $('#minhaTabela').DataTable({
          "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "loadingRecords": "Carregando...",
                "processing":     "Processando...",
                "search":         "Pesquisar:",
                "paginate": {
                    "first":      "Primeira",
                    "last":       "Última",
                    "next":       "Próxima",
                    "previous":   "Anterior"
                },
            }
        });
  });


  $(document).ready(function(){
      $('#minhaTabela2').DataTable({
          "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "loadingRecords": "Carregando...",
                "processing":     "Processando...",
                "search":         "Pesquisar:",
                "paginate": {
                    "first":      "Primeira",
                    "last":       "Última",
                    "next":       "Próxima",
                    "previous":   "Anterior"
                },
            }
        });
  });

  </script>

@stop
@stop
