@extends('adminlte::page')

@section('title', 'RV')

@section('content_header')
  <!-- <h1 class="m-0 text-dark">Histórico RV</h1> -->
@stop

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />



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
    <h5><B>FILTRO</B></h5><p>
         <a class="btn btn-light" data-toggle="in" href="#collapseExample4" role="button" aria-expanded="true" aria-controls="collapseExample4">
    <i class="fa fa-minus-square" aria-hidden="true"></i> Fechar grupo
  </a><p><b>Data da atualização: </b> 
  <?php  
    //dd($dados['atualizacao'][0]);
  echo date('30/01/2024 07:50:56');?>
  <IMG SRC="https://preloaders.evidweb.com/images/preloaders/ajax-loading-c7.gif" width="18px" heigh="18px">
</p>
<div class="in" id="collapseExample4">
<form action="./rv" method="get">
     <div class="row">
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Referencia:</label>
                  <select class="form-control form-control-md" name="referencia">
                  <option value="TODOS">TODOS</option>
                  <?php 
                  
                    foreach ($dados['referencia'] as $ger) {
                        echo '
                            <option value="'.$ger->referencia.'">'.$ger->referencia.'</option>
                            ';    
                    }
                  ?>
                    
                  </select>
                </div>
              
              
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Gerente:</label>
                  <select class="form-control form-control-md" name="gerente">
                  <option value="TODOS">TODOS</option>
                  <?php 
                  
                    foreach ($dados['gerente'] as $ger) {
                        echo '
                            <option value="'.$ger->gerente.'">'.$ger->gerente.'</option>
                            ';    
                    }
                  ?>
                    
                  </select>
                </div>
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Coordenador:</label>
                  <select class="form-control form-control-md" name="coordenador">
                  <option value="TODOS">TODOS</option>
                  <?php 
                  
                    foreach ($dados['coordenador'] as $ger) {
                        echo '
                            <option value="'.$ger->coordenador.'">'.$ger->coordenador.'</option>
                            ';    
                    }
                  ?>
                  </select>
                </div>
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Supervisor:</label>
                  <select class="form-control form-control-md" name="supervisor">
                      <option value="TODOS">TODOS</option>
                  <?php 
                  
                    foreach ($dados['supervisor'] as $ger) {
                        echo '
                            <option value="'.$ger->supervisor.'">'.$ger->supervisor.'</option>
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
                     <!--  <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                   <a href="./download-grade" ><input  type="button" class="form-control form-control-md btn btn-secondary" value="Baixar excel"></a>
              </div> -->
</div>
</div>
</div>
<?php //dd($dados['visaoFFA']);?>



        <div class="callout callout-secondary">
  <p>
<h2> Histórico de RV</h2>
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3><?php echo $dados['HCELEGIVEL'][0]->qtd;?></h3>

            <p><a href="rv?status=elegiveis&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>" style="color:white">HC - Elegíveis</a></p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3><?php echo 'R$ '.number_format($dados['VLELEGIVEL'][0]->qtd, 2, ',', '.');?></h3>

                <p><a href="rv?status=elegiveis&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>" style="color:white" >R$ - Elegíveis</a></p>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?php echo $dados['HCINELEGIVEL'][0]->qtd;?></h3>

                <p><a href="rv?status=inelegiveis&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>" style="color:white">HC - Inelegíveis</a></p>
              </div>
            </div>
          </div><div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?php echo 'R$ '.number_format($dados['VLINELEGIVEL'][0]->qtd, 2, ',', '.');?></h3>

                <p><a href="rv?status=inelegiveis&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>" style="color:white">R$ - Inelegíveis</a></p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $dados['assinatura'][0]->qtd;?></h3>

                <p><a href="rv?status=pendente_assinatura&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>" style="color:white">Pend. de Assinatura</a></p>
              </div>
             <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="./rv?status=1" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div> -->
          </div>
          <!-- ./col -->
        </div>
</div>
</div>


</div>

   <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
  <div class="box-body table-responsive no-padding">
 <table id="minhaTabela1" class="table table-striped table-sm table-bordered dataTable">
    <thead>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[PRODUÇÃO - TÉCNICOS <?php 
          
          
          if (!empty($_GET['gerente'])) {
            echo ' | GERENTE: '.$_GET['gerente'];
          }
          
          
          if (!empty($_GET['coordenador'])) {
            echo ' | COORDENADOR: '.$_GET['coordenador'];
          }
          
          
          if (!empty($_GET['supervisor'])) {
            echo ' | SUPERVISOR: '.$_GET['supervisor'];
          }
          
        ?>
        ] </th> 
        </tr>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#;color:black;width:260px"><center>COORDENADOR</th>
        <th style=" background-color:#;color:black;width:260px"><center>SUPERVISOR</th>
        <th style=" background-color:#;color:black;width:320px"><center>NOME</th>
        <th style=" background-color:#;color:black;width:60px"><center>VALOR</th>
        <th style=" background-color:#;color:black;width:160px"><center>SITUAÇÃO</th>
            </tr>
    </thead>
    <tbody>
          
            <?php 
                foreach ($dados['informacao'] as $gr) {
                    
                    echo '<tr class="bg- text-center py-0 align-middle">
                            <td><a target="_blank" href="./visualizar_rv?id='.$gr->ID.'&mt='.$gr->CPF.'">'.$gr->COORDENADOR.'</a></td>
                            <td><a target="_blank" href="./visualizar_rv?id='.$gr->ID.'&mt='.$gr->CPF.'">'.$gr->SUPERVISOR.'</a></td>
                            <td><a target="_blank" href="./visualizar_rv?id='.$gr->ID.'&mt='.$gr->CPF.'">'.$gr->TECNICO.'</a></td>
                            <td><a target="_blank" href="./visualizar_rv?id='.$gr->ID.'&mt='.$gr->CPF.'">R$ '.number_format($gr->VALOR_A_RECEBER,2,',','.').'</a></td>
                            <td><a target="_blank" href="./visualizar_rv?id='.$gr->ID.'&mt='.$gr->CPF.'">'.$gr->ELEGIBILIDADE.'</a></td>
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

 
      
      
      
   <!--   
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
  <div class="box-body table-responsive no-padding">
<iframe width="1300" height="1150" src="https://datastudio.google.com/embed/reporting/9d1a8819-512e-4781-885e-f017c4d10ed5/page/XN2hC" frameborder="0" style="border:0" allowfullscreen></iframe>



           </div>
     </div>
      </div>
      </div> 
--!>
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
      $('#minhaTabela1').DataTable({
            
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
        });
  });

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
            },
        });
  });

  </script>

@stop
@stop
