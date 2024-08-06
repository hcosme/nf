@extends('adminlte::page')

@section('title', 'CQ')

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
<div class="row">

<div class="in" id="collapseExample4">
<form action="./cq" method="get">
      <div class="row">
               <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Início:</label>
                  <input type="date" class="form-control form-control-md" name="inicio" value="<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    };?>" id="exampleInputEmail1" >
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Fim:</label>
                  <input type="date" class="form-control form-control-md" name="fim" value="<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    };?>" id="exampleInputEmail1" >
                </div>

                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Estado:</label>
                  <select class="form-control form-control-md" name="estado">
                    <?php if(isset($_GET['estado'])) {
                        echo $_GET['estado'];
                    };?>
                  <option value="TODOS">TODOS</option>
                  <option value="MS">MS</option>
                  <option value="PR">PR</option>
                    
                  </select>
                </div>
                
                 <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Técnico:</label>
                  <select class="form-control form-control-md" name="tecnico">
                    <?php if(isset($_GET['tecnico'])) {
                        echo $_GET['tecnico'];
                    };?>
                  
                  <option value="TODOS">TODOS</option>
                  <?php 
                    foreach ($dados['tecnico'] as $ger) {
                        echo '
                            <option value="'.$ger->tecnico.'">'.$ger->tecnico.'</option>
                            ';    
                    }
                  ?>
                  </select>
                </div>
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-success" value="Buscar">
              </div>
</form>               
                </div>
                </div>
                
                </div>
                </div>

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

    <div class="callout callout-secondary">
  <p>
<div class="row">
    
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-">
              <div class="inner">
                <h3>{{ $dados['pendentes'][0]->QTD }}</h3>

                <p>Pendentes</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="./cq?status=pendente&tecnico=<?php if(isset($_GET['tecnico'])) {
                    echo $_GET['tecnico'];
                    }?>&estado=<?php if(isset($_GET['estado'])) {
                    echo $_GET['estado'];
                    }?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; }?>" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-">
              <div class="inner">
                 <h3>{{ $dados['realizados'][0]->QTD }}</h3>

                <p>Realizados</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="./cq?status=realizados&tecnico=<?php if(isset($_GET['tecnico'])) {
                    echo $_GET['tecnico'];
                    }?>&estado=<?php if(isset($_GET['estado'])) {
                    echo $_GET['estado'];
                    }?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; }?>" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-">
              <div class="inner">
                  <h3>{{ ($dados['pendentes'][0]->QTD+$dados['realizados'][0]->QTD) }}</h3>

                <p>Total</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="./cq" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                </div>
                
</div>
<?php //dd($dados['visaoFFA']);?>




    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
    <div class="box-body table-responsive no-padding">
        <table id="minhaTabela2" class="table table-striped table-sm table-bordered dataTable">
            <thead>
                <tr class="bg-light text-center py-0 align-middle">
                    <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[CHECKLIST POS INSTALAÇÃO] </th> 
                </tr>
                <tr class="bg-light text- py-0 align-middle">
                    <th style=" background-color:#;color:black;width:10px"><center>Nº</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Estado</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Data Execução</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Contrato</th>
                    <th style=" background-color:#;color:black;width:160px"><center>Técnico</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Credenciada</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $numero = 1;
                foreach ($dados['dados'] as $gr) {
                    if ($gr->cidade == 'CAMPO GRANDE') {
                        $cidade = 'MS';
                    } else {
                        $cidade = 'PR';
                    }
                    if ($gr->cracha == '') {
                        $cracha = '<a class="btn btn-success btn-xs" href="./ver_cq?id='.$gr->id.'"><i class="fas fa-phone"></i> Auditar </a>';
                    } else {
                        $cracha = '<a class="btn btn-warning btn-xs" href="./visualizar_cq?id='.$gr->id.'"><i class="fas fa-eye"></i> Visualizar</a>';
                    }
                    
                    echo '<tr class="bg- text- py-0 align-middle">
                            <td>'.$numero++.'</td>
                            <td><center>'.$cidade.'</td>
                            <td>'.$gr->data.'</td>
                            <td>'.$gr->contrato.'</td>
                            <td>'.$gr->tecnico.'</td>
                            <td>'.$gr->empreiteira.'</td>
                            <td><center>
                                '.$cracha.'    
                            </td>
                    ';
                }
            ?>

    </tbody>
  </table>
  </form>



              <!-- /.box-body -->
              </div>
          <!-- /.box -->
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
      $('#minhaTabela2').DataTable({
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
            }
        });
  });

  </script>

@stop
@stop
