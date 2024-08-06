@extends('adminlte::page')

@section('title', 'Pós Dashboard')

@section('content_header')
<!--<meta http-equiv="refresh" content="30">
   <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop

@section('content')

<style>
   .blink_me {
  animation: blinker 5s linear infinite;
}

#circuloVermelho {
width: 10px;
height: 10px;
border-radius: 50%;
background-color: #FF0000;
margin: 0px;
}

@keyframes blinker {  
  50% { opacity: 0; }
}

</style>

    <div class="callout callout-secondary">
  <p>
 
  <IMG SRC="https://preloaders.evidweb.com/images/preloaders/ajax-loading-c7.gif" width="18px" heigh="18px">
</p>

<div class="in" id="collapseExample4">
<form action="./pos-dashboard" method="get">
      <div class="row">
               <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Início:</label>
                  <input type="date" class="form-control form-control-md" name="inicio" value="<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    };?>" id="exampleInputEmail1" >
                </div>
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Fim:</label>
                  <input type="date" class="form-control form-control-md" name="fim" value="<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    };?>" id="exampleInputEmail1" >
                </div>
             


                            <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Filial:</label>
                  <select class="form-control form-control-md" name="filial">
                  
                    <option value="TODOS">TODOS</option>
                    <option value="RJ">RJ</option>
                    <option value="SP">SP</option>
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
</div>
<?php //dd($dados['visaoFFA']);?>


<div class="content">
                <div class="container-fluid">
                    
<style>
   .blink_me {
  animation: blinker 5s linear infinite;
}

#circuloVermelho {
width: 10px;
height: 10px;
border-radius: 50%;
background-color: #FF0000;
margin: 0px;
}

@keyframes  blinker {  
  50% { opacity: 0; }
}

</style>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Copper", 8.94, "#b87333"],
        ["Silver", 10.49, "silver"],
        ["Gold", 19.30, "gold"],
        ["Platinum", 21.45, "color: #e5e4e2"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Density of Precious Metals, in g/cm^3",
        width: 800,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>



  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Descrição", "Quantidade", { role: "style" } ],
        ["Total", <?php echo $dados['total_instalacao'][0]->QTD;?>, "#b87333"],
        ["Tratado", <?php echo $dados['instalacaoAuditadas'][0]->QTD;?>, "silver"],
        ["Pendente", <?php echo $dados['tratar_instalacao'][0]->QTD;?>, "gold"],
        ["Proativo", <?php echo $dados['instalacaoProativo'][0]->QTD;?>, "color: #e5e4e2"],
        ["A despachar", <?php echo $dados['instalacaoDespachar'][0]->QTD;?>, "color: #e5e4e2"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
       /* title: "Estratificação do Pós", */
        width: 600,
        height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values1"));
      chart.draw(view, options);
  }
  </script>




      
      
    <div class="callout callout-secondary">
  <p>
    <h3>[TOTAL]</h3><br>
<div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3 style="color:">{{ ($dados['total_reparo'][0]->QTD+ $dados['total_instalacao'][0]->QTD) }}</h3>

                <p>Atividades</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                 <h3 style="color:">{{ ($dados['tratar_reparo'][0]->QTD+$dados['tratar_instalacao'][0]->QTD) }}</h3>

                <p>Pendente de tratamento</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                 <h3 style="color:">{{ ($dados['reparoAuditadas'][0]->QTD+$dados['instalacaoAuditadas'][0]->QTD) }}</h3>

                <p>Tratados</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3 style="color:">{{ ($dados['reparoProativo'][0]->QTD+$dados['instalacaoProativo'][0]->QTD) }}</h3>

                <p>Abertura de Proativo</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           </div>
   <p>
    <h3>[INSTALAÇÕES]</h3><br>
<div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3 style="color:">{{ $dados['total_instalacao'][0]->QTD }}</h3>

                <p>Atividades</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                 <h3 style="color:">{{ $dados['tratar_instalacao'][0]->QTD }}</h3>

                <p>Pendente de tratamento</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                 <h3 style="color:">{{ $dados['instalacaoAuditadas'][0]->QTD }}</h3>

                <p>Tratados</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3 style="color:">{{ $dados['instalacaoProativo'][0]->QTD }}</h3>

                <p>Abertura de Proativo</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
       
                </div>



  <p>
    <h3>[REPARO]</h3><br>
<div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3 style="color:">{{ $dados['total_reparo'][0]->QTD }}</h3>

                <p>Atividades</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                 <h3 style="color:">{{ $dados['tratar_reparo'][0]->QTD }}</h3>

                <p>Pendente de tratamento</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                 <h3 style="color:">{{ $dados['reparoAuditadas'][0]->QTD }}</h3>

                <p>Tratados</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3 style="color:">{{ $dados['reparoProativo'][0]->QTD }}</h3>

                <p>Abertura de Proativo</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
       
                </div>
                </div>
                </div>



  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Situação', 'Quantidade'],
          ['Concluído',     11],
          ['Pendente',    7]
        ]);

        var options = {
          title: 'Situação de tratamento - Proativo',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Situação', 'Quantidade'],
          ['Concluído',     11],
          ['Pendente',    7]
        ]);

        var options = {
          title: 'Situação de tratamento - Proativo',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart1'));
        chart.draw(data, options);
      }
    </script>
    
       
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Situação', 'Quantidade'],
          ['Concluído',     11],
          ['Pendente',    7]
        ]);

        var options = {
          title: 'Situação de tratamento - Proativo',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
        chart.draw(data, options);
      }
    </script>
  </head>
 
<p>



<!--


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div id="donutchart" style="width: 600px; height: 400px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div id="donutchart1" style="width: 600px; height: 400px;"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div id="donutchart2" style="width: 600px; height: 400px;">
                            </div>
                        </div>
                    </div>






-->









<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
           
              <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Rank Auditores</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                       <th style="background-color:#fff;color:;width:120px">#</th>
                    <th style="background-color:#fff;color:;width:450px">Nome</th>
                     <th style="background-color:#fff;color:;width:20px">Quantidade</th>
                  </tr>
                  </thead>
                  <tbody>
                   
                     <?php 
                        $qtdColuna = 1;
                        foreach ($dados['rank_auditoria'] as $gr) {
                        
                            
                            echo '<tr>
                              <td><center>'.$qtdColuna++.'</td>
                            <td>'.$gr->operador.'</td>
                            <td><center>'.$gr->qtd.'</td>
                            
                            
                            </tr>
                            ';
                        }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Rank Despachados</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
         <th style="background-color:#fff;color:;width:120px">#</th>
                    <th style="background-color:#fff;color:;width:450px">Nome</th>
                     <th style="background-color:#fff;color:;width:20px">Quantidade</th>
                  </tr>
                  </thead>
                  <tbody>
                   
                     <?php 
                        $qtdColuna = 1;
                        foreach ($dados['rank_despacho'] as $gr) {
                        
                            
                            echo '<tr>
                              <td><center>'.$qtdColuna++.'</td>
                            <td>'.$gr->usuario_despacho.'</td>
                            <td><center>'.$gr->qtd.'</td>
                            
                            
                            </tr>
                            ';
                        }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
    
        

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
      $('#tbl_atribuicao').DataTable({
          "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Realize o filtro",
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
            },
         "order": [[ 2, "desc" ]]
        });
  });

  </script>

@stop
@stop
