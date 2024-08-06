@extends('adminlte::page')

@section('title', 'Prazo')

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
 <b>Última atualização: </b> 
 <?php 
    date_default_timezone_set('America/Sao_Paulo');
    if (isset($dados['atualizacao'][0])) {
        echo ($dados['atualizacao'][0]->data);    
    } else {
        echo '';
    }
    
 ?>
  <IMG SRC="https://preloaders.evidweb.com/images/preloaders/ajax-loading-c7.gif" width="18px" heigh="18px">
</p>

<div class="in" id="collapseExample4">
<!--<form action="./recente_tecnico" method="get">
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
             
<?php //dd($dados['gerente']);?>

                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Gerente:</label>
                  <select class="form-control form-control-md" name="gerente">
                  <option value="TODOS">TODOS</option>
                  <?php 
                  
                   /* foreach ($dados['gerente'] as $ger) {
                        echo '
                            <option value="'.$ger->gerente.'">'.$ger->gerente.'</option>
                            ';    
                    }*/
                  
                  
                  ?>
                    
                  </select>
                </div>
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Coordenador:</label>
                  <select class="form-control form-control-md" name="coordenador">
                  <option value="TODOS">TODOS</option>
                  <?php 
                /*  
                    foreach ($dados['coordenador'] as $ger) {
                        echo '
                            <option value="'.$ger->coordenador.'">'.$ger->coordenador.'</option>
                            ';    
                    }
                  */
                  
                  ?>
                  </select>
                </div>
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Supervisor:</label>
                  <select class="form-control form-control-md" name="supervisor">
                      <option value="TODOS">TODOS</option>
                  <?php 
                  
                /*    foreach ($dados['supervisor'] as $ger) {
                        echo '
                            <option value="'.$ger->supervisor.'">'.$ger->supervisor.'</option>
                            ';    
                    }
                  */
                  
                  ?>
                  </select>
                </div>
                
            <!--     <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Tecnologia:</label>
                  <select class="form-control form-control-md" name="tecnologia">
                  
                    <option value="TODOS">TODOS</option>
                    <option value="FTTH">GPON</option>
                    <option value="FTTC">METÁLICO</option>
                  </select>
                </div>
                           <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Status:</label>
                  <select class="form-control form-control-md" name="presenca">
                  
                    <option value="TODOS">TODOS</option>
                    <option value="1">PRESENTES</option>
                    <option value="0">AUSÊNTES</option>
                  </select>
                </div>
               
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-secondary" value="Filtrar">
              </div>
</form>  -->
                   <div class="form-group col-md-1">
                    <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                    <a href="https://gestaoderecursos.com/exportacao/prazosp.php" ><input  type="button" class="form-control form-control-md btn btn-secondary" value="Baixar excel"></a>
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

    <div class="callout callout-secondary">
  <p>
<div class="row">
    
          <div class="col-lg-3 col-4">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $dados['vence_6h'][0]->QTD }}</h3>

                <p>Vence em 6h</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="./prazo_sp?status=VENCE EM 6H" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                 <h3>{{ $dados['vence_3h'][0]->QTD }}</h3>

                <p>Vence em 3h</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="./prazo_sp?status=VENCE EM 3H" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                  <h3>{{ $dados['vence_2h'][0]->QTD }}</h3>

                <p>Vence em 2h</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="./prazo_sp?status=VENCE EM 2H" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                
         <!-- ./col -->
          <div class="col-lg-3 col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                  <h3>{{ $dados['vence_1h'][0]->QTD }}</h3>

                <p>Vence em 1h</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="./prazo_sp?status=VENCE EM 1H" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
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
 <table id="tabela" class="table table-striped table-sm table-bordered dataTable">
    <thead>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[PRAZO RJ] </th> 
        </tr>
      <tr class="bg-light text-center py-0 align-middle">
        <th style="background-color:#;color:black;width:100px" title=""><center>Ordem</th>
        <th style=" background-color:#;color:black;width:180px"><center>Supervisor</th>
        <th style=" background-color:#;color:black;width:200px"><center>Técnico</th>
                                <th style=" background-color:#;color:black;width:80px"><center>Estado</th>
                <th style=" background-color:#;color:black;width:80px"><center>Prazo</th>
                <th style=" background-color:#;color:black;width:80px"><center>Vence em</th>
            <!--    <th style=" background-color:#191970;color:white;width:80px"><center>Tempo Ex.</th> -->
        </tr>
    </thead>
 <tbody>
            <?php 
                foreach ($dados['backlog'] as $gr) {
                    $hora = date('H:i:s');
                    if ($gr->COORDENADOR != '') {
                        $coordenador = $gr->COORDENADOR;
                    } else {
                        $coordenador = 'N_IDENTIFICADO';
                    }
                    if ($gr->SUPERVISOR != '') {
                        $supervisor = $gr->SUPERVISOR;
                    } else {
                        $supervisor = 'N_IDENTIFICADO';
                    }
                    if ($gr->PROVEDOR != '') {
                        $tecnico = $gr->PROVEDOR;
                    } else {
                        $tecnico = 'N_IDENTIFICADO';
                    }
                    
                  /*  $data1 = date('d/m/Y H:i:s');
                    $data2 = $gr->FAIXA;
                    
                    $unix_data1 = strtotime($data1);
                    $unix_data2 = strtotime($data2);
                    
                    $nHoras   = ($unix_data2 - $unix_data1) / 3600;
                    $nMinutos = (($unix_data2 - $unix_data1) % 3600) / 60;
                    //$faixa = printf('%02d:%02d', $nHoras, $nMinutos);
                    
                    //printf('%02d:%02d', $nHoras, $nMinutos); // 01:16
                    
                    $start_date = new DateTime($data1);
                    $since_start = $start_date->diff(new DateTime($data2));
                    $faixa = $since_start->h.':'.$since_start->i.':'.$since_start->s;
                    
                    $data1 = date('d/m/Y H:i:s');
                    $data2 = date('d/m/Y').' '.$gr->INICIO;
                    
                    $unix_data1 = strtotime($data1);
                    $unix_data2 = strtotime($data2);
                    
                    $nHoras   = ($unix_data2 - $unix_data1) / 3600;
                    $nMinutos = (($unix_data2 - $unix_data1) % 3600) / 60;
                    //$faixa = printf('%02d:%02d', $nHoras, $nMinutos);
                    
                    //printf('%02d:%02d', $nHoras, $nMinutos); // 01:16
                    
                    $start_date = new DateTime($data1);
                    $since_start = $start_date->diff(new DateTime($data2)); 
                    if ($gr->ESTADO == 'A INICIAR') {
                        $tempo_execucao = '-';
                    } else {
                        $tempo_execucao = $since_start->h.':'.$since_start->i.':'.$since_start->s;
                    }
                    
                    */
                    
                                        
                    if ($gr->BACK_SUP == 1) {
                        $corLetra = 'color:;';
                        $corLinha = 'background:;';
                    }
                    
                    if ($gr->COORDENADOR_T == 1) {
                        $corLetra = 'color:;';
                        $corLinha = 'background:;';
                    }
                    
                    if ($gr->GERENTE_T == 1) {
                        $corLetra = 'color:;';
                        $corLinha = 'background:;';
                    }
                    if ($gr->BACK_SUP == 0) {
                        $corLetra = '';
                        $corLinha = '';
                    }
                    

                    echo '<tr style="'.$corLetra.$corLinha.'">
                    <td>'.$gr->ORDEM.'</td>
                    <td>'.$supervisor.'</td>
                    <td>'.$tecnico.'</td>
                    <td>'.$gr->ESTADO.'</td>
                    <td>'.($gr->FAIXA).'</td>
                    <td>'.$gr->FAIXA_T.'</td>
                   
                    </tr>
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
      $('#tabela').DataTable({
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
     "order": [[ 4, "asc" ]]
        });
  });

  </script>

@stop
@stop
