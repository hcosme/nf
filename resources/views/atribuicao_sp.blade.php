@extends('adminlte::page')

@section('title', 'Atribuição')

@section('content_header')
<!--<meta http-equiv="refresh" content="30">
   <h1 class="m-0 text-dark">Report Instalação</h1> -->
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
        <h5 class="modal-title">Atenção!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Estamos com instabilidade na extração da base de backlog da tim.</p>
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
/*setTimeout(function() {
    window.location.href = "https://indicadores.gestaoderecursos.com/public/home";
}, 5000);*/

</script>
-->
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
 <b>Fonte de dados:</b> TOA  | <b>Última atualização: </b> 
 <?php 
    date_default_timezone_set('America/Sao_Paulo');
    if (isset($dados['atualizacao'][0])) {
        
          echo date('d/m/Y H:i:s', strtotime($dados['atualizacao'][0]->data));  
        
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
</form>               -->   <div class="form-group col-md-2">
                    <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                    <a href="https://gestaoderecursos.com/exportacao/abertas.php" ><input  type="button" class="form-control form-control-md btn btn-secondary" value="Baixar excel"></a>
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
    
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $dados['atribuido'][0]->QTD }}</h3>

                <p>Atribuidas</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="./atribuicao_sp?status='ATRIBUIDO'" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3>{{ $dados['n_atribuido'][0]->QTD }}</h3>

                <p>Não atribuidas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="./atribuicao_sp?status='N_ATRIBUIDO'" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                  <h3>{{ ($dados['atribuido'][0]->QTD+$dados['n_atribuido'][0]->QTD) }}</h3>

                <p>Total</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="./atribuicao_sp" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                </div>
                
<h4>[ NÃO ATRIBUIDAS ]</h4>
<div class="row">
    
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                 <h3 style="color:"><?php if(empty($dados['n_atribuido_ag'])) {
                     echo 0;
                 } else  {
                     echo $dados['n_atribuido_ag'][0]->QTD;
                 } ?></h3>
                <p>Agendamento</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                 <h3 style="color:"><?php if(empty($dados['n_atribuido_ar'])) {
                     echo 0;
                 } else  {
                     echo $dados['n_atribuido_ar'][0]->QTD;
                 } ?></h3>

                <p>Area de Risco</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
               <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
              <h3 style="color:"><?php if(empty($dados['n_atribuido_cidade'])) {
                     echo 0;
                 } else  {
                     echo $dados['n_atribuido_cidade'][0]->QTD;
                 } ?></h3>
               
                <p>Cidade</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
               <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3 style="color:"><?php if(empty($dados['n_atribuido_cop'])) {
                     echo 0;
                 } else  {
                     echo $dados['n_atribuido_cop'][0]->QTD;
                 } ?></h3>
              
                <p>Cop</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
               <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                 <h3 style="color:"><?php if(empty($dados['n_atribuido_massiva'])) {
                     echo 0;
                 } else  {
                     echo $dados['n_atribuido_massiva'][0]->QTD;
                 } ?></h3>
                <p>Massiva</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
</div>
</div>
</div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
  <div class="box-body table-responsive no-padding">
 <table id="tbl_atribuicao" class="table table-striped table-sm table-bordered dataTable">
   <thead>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#191970;color:white;width:200px" colspan="19"><center>[ATRIBUIÇÃO SP] </th> 
        </tr>
      <tr class="bg-light text-center py-0 align-middle">
        <th style="background-color:#191970;color:white;width:5px" title=""><center>#</th>
      
        <th style="background-color:#191970;color:white;width:100px" title=""><center>Responsavel</th>
        <th style="background-color:#191970;color:white;width:100px" title=""><center>Estado</th>
        <th style="background-color:#191970;color:white;width:100px" title=""><center>Ordem</th>
        
        <th style="background-color:#191970;color:white;width:100px" title=""><center>Prazo</th>
        
        <th style="background-color:#191970;color:white;width:100px" title=""><center>Faixa</th>
        <th style=" background-color:#191970;color:white;width:180px"><center>Provedor</th>
        <th style=" background-color:#191970;color:white;width:200px"><center>Status</th>
                                <th style=" background-color:#191970;color:white;width:80px"><center>Data</th>
             </tr>
    </thead>
    <tbody>
            <?php 
                $qtdColuna = 1;
                foreach ($dados['bds'] as $gr) {
                    if ($gr->STATUS_ATRIBUICAO == 'ATRIBUIDO') {
                        $corLetra = 'color:;';
                        $corLinha = 'background:;';
                    } else {
                         $corLetra = 'color:red;';
                        $corLinha = 'background:;';
                    }
                    
                     if ($gr->STATUS_ATRIBUICAO == 'ATRIBUIDO') {
                        $status = 'ATRIBUIDO';
                    } else {
                        $status = 'NÃO ATRIBUIDO';
                    }
                    
                    echo '<tr style="'.$corLetra.$corLinha.'">
                      <td><center>'.$qtdColuna++.'</td>
                    <td>'.$gr->RESPONSAVEL.'</td>
                    <td>'.$gr->ESTADO.'</td>
                    <td>'.$gr->ORDEM.'</td>
                    <td>'.$gr->WFM_CRIACAO_MAIS_24H.'</td>
                    <td>'.$gr->CLASSIFICACAO_24H_CRIACAO_WFM.'</td>
                    <td>'.$gr->PROVEDOR.'</td>
                    <td>'.$status.'</td>
                    <td>'.$gr->DATA.'</td>
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
         "order": [[ 3, "desc" ]]
        });
  });

  </script>

@stop
@stop
