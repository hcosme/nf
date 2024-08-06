@extends('adminlte::page')

@section('title', 'Instalação')

@section('content_header')
 <!--  <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop

@section('content')



    <div class="callout callout-secondary">
    <h5><B>FILTRO</B></h5><p>
         <a class="btn btn-light" data-toggle="in" href="#collapseExample4" role="button" aria-expanded="true" aria-controls="collapseExample4">
    <i class="fa fa-minus-square" aria-hidden="true"></i> Fechar grupo
  </a><p>
 <b>Fonte de dados:</b> TOA | <b>Última atualização: </b> <?php date_default_timezone_set('America/Sao_Paulo');
   echo date('d/m/Y H:i:s',strtotime($dados['AtualizacaoMontada'][0]->data_atualizacao));?>
  <IMG SRC="https://preloaders.evidweb.com/images/preloaders/ajax-loading-c7.gif" width="18px" heigh="18px">
</p>
<div class="in" id="collapseExample4">
<form action="./instalacao_online_tecnico?inicio=<?php echo $_GET['inicio'];?>&fim=<?php echo $_GET['fim'];?>&presenca=1&gerente=<?php echo $_GET['gerente'];?>&coordenador=<?php echo $_GET['coordenador'];?>&supervisor=<?php echo $_GET['supervisor'];?>&tecnologia=<?php echo $_GET['tecnologia'];?>&tipo=<?php echo $_GET['tipo'];?>&situacao=<?php echo $_GET['situacao'];?>" method="get">
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
                  
                  <?php 
                    
                    if(isset($_GET['gerente'])) {
                        echo '<option value="'.$_GET['gerente'].'">'.$_GET['gerente'].'</option>';
                    }
                    echo '<option value="TODOS">TODOS</option>';
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
                  
                  <?php 
                  if(isset($_GET['coordenador'])) {
                        echo '<option value="'.$_GET['coordenador'].'">'.$_GET['coordenador'].'</option>';
                    }
                    echo '<option value="TODOS">TODOS</option>';
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
                  <?php 
                    if(isset($_GET['supervisor'])) {
                        echo '<option value="'.$_GET['supervisor'].'">'.$_GET['supervisor'].'</option>';
                    }
                    echo '<option value="TODOS">TODOS</option>';
                    foreach ($dados['supervisor'] as $ger) {
                        echo '
                            <option value="'.$ger->supervisor.'">'.$ger->supervisor.'</option>
                            ';    
                    }
                  
                  
                  ?>
                  </select>
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Tipo Flag:</label>
                  <select class="form-control form-control-md" name="tipo">
                   <?php 
                    if(isset($_GET['tipo'])) {
                        echo '<option value="'.$_GET['tipo'].'">'.$_GET['tipo'].'</option>';
                    }
                  
                  ?>
                  <option value="TODOS">TODOS</option>
                    <option value="sem_atividade">SEM ATIVIDADE</option>
                    <option value="ocioso">OCIOSOS</option>
                    <option value="zerado_ok">ZERADOS</option>
                    <option value="producao_01">PRODUÇÃO 01</option>
                    <option value="ba_longo">BA LONGO</option>
                  </select>
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Status:</label>
                  <select class="form-control form-control-md" name="situacao" readonly="readonly">
                    <option value="1">TODOS</option>
                  </select>
                </div>
                
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Tecnologia:</label>
                  <select class="form-control form-control-md" name="tecnologia">
                  
                    <option value="TODOS">TODOS</option>
                    <option value="FTTH">GPON</option>
                    <option value="FTTC">METÁLICO</option>
                  </select>
                </div>
                               <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Status:</label>
                  <select class="form-control form-control-md" name="presenca" READONLY>
                  
                    <option value="1">PRESENTE</option>
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




    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
  <div class="box-body table-responsive no-padding">
 <table id="minhaTabela2" class="table table-striped table-sm table-bordered dataTable">
    <thead>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#483D8B;color:white;width:200px" colspan="22"><center>[INSTALAÇÃO - TÉCNICOS <?php 
          
          
          if (!empty($_GET['gerente'])) {
            echo ' | GERENTE: '.$_GET['gerente'];
          }
          
          
          if (!empty($_GET['coordenador'])) {
            echo ' | COORDENADOR: '.$_GET['coordenador'];
          }
          
          
          if (!empty($_GET['supervisor'])) {
            echo ' | SUPERVISOR: '.$_GET['supervisor'];
          }
          
          if (!empty($_GET['tecnologia'])) {
            echo ' | TECNOLOGIA: '.$_GET['tecnologia'];
          } 
           if (!empty($_GET['inicio']) || !empty($_GET['fim'])) {
            echo ' | PERIODO: '.date('d/m/Y', strtotime($_GET['inicio'])).' - '.date('d/m/Y', strtotime($_GET['fim']));
          } 
          
           if (!empty($_GET['presenca'])) {
               if ($_GET['presenca'] == 1) {
                    $statusPresenca = 'PRESENTES';
               } else {
                    $statusPresenca = 'AUSÊNTES';
               }
            echo ' | STATUS: '.$statusPresenca;
          } 
        ?>
        ] </th> 
        </tr>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#191970;color:white;width:260px"><center>Gerente</th>
        <th style=" background-color:#191970;color:white;width:260px"><center>Coordenador</th>
        <th style=" background-color:#191970;color:white;width:260px"><center>Supervisor</th>
        <th style=" background-color:#191970;color:white;width:260px"><center>Nome</th>
        <!--  <th style=" background-color:#191970;color:white;width:20px"><center>Meta</th> -->
        <th style=" background-color:#191970;color:white;width:20px"><center>Realizado</th> <!--
        <th style=" background-color:#191970;color:white;width:20px"><center>Gap</th> -->
        <th style=" background-color:#191970;color:white;width:20px"><center>Pendente</th>
        <th style=" background-color:#191970;color:white;width:30px"><center>Eficiência</th>
        <th style=" background-color:#191970;color:white;width:30px"><center>Produt.</th>
        <th style=" background-color:#191970;color:white;width:20px"><center>Iniciado</th>
        <th style=" background-color:#191970;color:white;width:20px"><center>Não Iniciado</th>
        <th style=" background-color:#191970;color:white;width:70px"><center>Tec. s/ Ativ.</th>
        <th style=" background-color:#191970;color:white;width:20px"><center>Téc. Ociosos</th>
        <th style=" background-color:#191970;color:white;width:20px"><center>Zerados Ok</th>
        <th style=" background-color:#191970;color:white;width:20px"><center>01 Produção</th>
        <th style=" background-color:#191970;color:white;width:20px"><center>BA Longo?</th>
        <th style=" background-color:#191970;color:white;width:20px"><center>Inicio Ativ.</th>
        <th style=" background-color:#191970;color:white;width:20px"><center>Tempo na Ativ.</th>
        <th style=" background-color:#191970;color:white;width:20px"><center>Tipo</th>
        <th style=" background-color:#191970;color:white;width:20px"><center>Nº Ordem</th>
        </tr>
    </thead>
    <tbody>
          
            <?php 
                foreach ($dados['visaoTecnico'] as $gr) {
                    if ($gr->gap > 0) {
                        $cor = ' style="background-color:#2EFE2E;color:black"';
                    } else {
                        $cor = ' style="background-color:red;color:white"';
                    }

                     if ($gr->eficiencia > 90) {
                        $corEficiencia = ' style="background-color:#2EFE2E;color:white"';
                    } else {
                        $corEficiencia = ' style="background-color:red;color:white"';
                    }
                     if ($gr->produtividade > 2) {
                        $corProd = ' style="color:#2EFE2E"';
                    } else {
                        $corProd = ' style="color:red"';
                    }
                    
                    if ($gr->sem_atividade == 0) {
                        $corSem_atividade = ' style="color:white;background:#2EFE2E"';
                        $sem_atividade = 'NÃO';
                    } else {
                        $corSem_atividade = ' style="color:white;background:red"';
                        $sem_atividade = 'SIM';
                    }
                    
                    if ($gr->ocioso == 0) {
                        $corOcioso = ' style="color:white;background:#2EFE2E"';
                        $ocioso = 'NÃO';
                    } else {
                        $corOcioso = ' style="color:white;background:red"';
                        $ocioso = 'SIM';
                    }
                    
                    if ($gr->zerado_ok == 0) {
                        $corZerado_ok = ' style="color:white;background:#2EFE2E"';
                        $zerado_ok = 'NÃO';
                    } else {
                        $corZerado_ok = ' style="color:white;background:red"';
                        $zerado_ok = 'SIM';
                    }
                    
                    if ($gr->producao_01 == 0) {
                        $corProducao_01 = ' style="color:white;background:#2EFE2E"';
                        $producao_01 = 'NÃO';
                    } else {
                        $corProducao_01 = ' style="color:white;background:red"';
                        $producao_01 = 'SIM';
                    }
                    
                    if ($gr->flag_ba_longo == 0) {
                        $corFlag_ba_longo = ' style="color:white;background:#2EFE2E"';
                        $flag_ba_longo = 'NÃO';
                    } else {
                        $corFlag_ba_longo = ' style="color:white;background:red"';
                        $flag_ba_longo = 'SIM';
                    }
                    /*
                    <td>'.$gr->meta.'</td>
                     <td '.$cor.'>'.round(($gr->meta-$gr->realizado),2).'</td>   
                    */
                    echo '<tr class="bg- text-center py-0 align-middle">
                            <td>'.$gr->gerente.'</td>
                            <td>'.$gr->coordenador.'</td>
                            <td>'.$gr->supervisor.'</td>
                            <td>'.$gr->nome.'</td>
                            <td>'.$gr->realizado.'</td>
                           
                            <td>'.$gr->pendente.'</td>
                            <td'.$corEficiencia.'>'.$gr->eficiencia.'%</td>
                            <td'.$corProd.'>'.$gr->produtividade.'</td>
                            <td>'.$gr->iniciado.'</td>
                            <td>'.$gr->nao_iniciado.'</td>
                            <td'. $corSem_atividade.' >'.$sem_atividade.'</td>
                            <td'.$corOcioso.'>'.$ocioso.'</td>
                            <td '.$corZerado_ok.'>'.$zerado_ok.'</td>
                            <td'.$corProducao_01.'>'.$producao_01.'</td>
                            <td'.$corFlag_ba_longo.'>'.$flag_ba_longo.'</td>
                            <td>'.$gr->data.' '.$gr->ba_longo.'</td>
                            <td>'.$gr->tempo_atividade.'</td>
                            <td>'.$gr->n_ordem_ba_longo.'</td>
                            <td>'.$gr->tipo_ordem_ba_longo.'</td>


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
            },
        order: [[16, 'desc']],
        });
  });

  </script>

@stop
@stop
