@extends('adminlte::page')

@section('title', 'Ponto')

@section('content_header')
<!--<meta http-equiv="refresh" content="30">
   <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop

@section('content')
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />



<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Em atualização.</h5>
      <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
<!--
      </div>
          <div class="modal-body">
        <p>FAVOR AGUARDAR A MANUTENÇÃO!</p>
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
</script>  -->

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

    <div class="callout callout-secondary"><center><h5 style="color:red">Favor selecionar o período para consulta.</h5></center>
  <p>
 <b>Fonte de dados:</b> Aniel Point|TOA | <b>Última atualização: </b> 
 <?php 
   //dd($dados);
    date_default_timezone_set('America/Sao_Paulo');
    if ($dados['atualizacao'] != '' ) {
        echo date('d/m/Y H:i:s', strtotime($dados['atualizacao'][0]->atualizacao));    
    } else {
        echo 'Em atualização.';
    }
    
 ?>
  <IMG SRC="https://preloaders.evidweb.com/images/preloaders/ajax-loading-c7.gif" width="18px" heigh="18px">
</p>

<div class="in" id="collapseExample4">
<form action="./ponto" method="get">
      <div class="row">
              <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Início:</label>
                  <input type="date" class="form-control form-control-md" name="inicio" value="<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    };?>" id="exampleInputE0mail1" >
                </div>
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Fim:</label>
                  <input type="date" class="form-control form-control-md" name="fim" value="<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    };?>" id="exampleInputEmail1" >
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
            
</div>
</div>
</div>



<div class="callout callout-secondary">
 <h5><b>Ocorrências (Ponto x TOA) | <?php 
                            if(isset($_GET['gerente'])) {
                                echo 'Gerente: '.$_GET['gerente'];
                            } else { 
                                echo 'Gerente: TODOS'; 
                            }
                            if(isset($_GET['coordenador'])) {
                                echo ' | Coordenador: '.$_GET['coordenador'];
                            } else { 
                                echo ' | Coordenador: TODOS'; 
                            }
                            if(isset($_GET['supervisor'])) {
                                echo ' | Supervisor: '.$_GET['supervisor'];
                            } else { 
                                echo ' | Supervisor: TODOS'; 
                            }
                            if(isset($_GET['inicio'])) {
                                echo ' | Incio: '.$_GET['inicio'];
                            } else { 
                                echo ' | Inicio: Não selecionado';
                            }
                            
                             if(isset($_GET['fim'])) {
                                echo ' | Fim: '.$_GET['inicio'];
                            } else { 
                                echo ' | Fim: Não selecionado';
                            }
                            
                            ?>
                            
                            </b></h5>
   <a class="btn btn-light" data-toggle="collapse" href="#collapseExample0" role="button" aria-expanded="true" aria-controls="collapseExample0">
    <i class="fa fa-minus-square" aria-hidden="true"></i> Fechar grupo
  </a>
 
</p>
<div class="in" id="collapseExample0">
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php 
                
                
                      if (empty($dados['qtd_sem_producao'][0]->qtd)) {
                        echo 0;
                    } else {
                        echo $dados['qtd_sem_producao'][0]->qtd;
                    }
                   ?> -   <?php 
                        if ($dados['s_qtd_sem_producao'][0]->qtd == '') {
                            echo 0.00;
                        } else {
                            
                            echo $dados['s_qtd_sem_producao'][0]->qtd;
                            
                        }    
                        ?></h3>

                <p>Ponto Sem Produção - HC</p>
              </div>
              <div class="icon">
                <i class="fas fa-spinner"></i>
              </div>
              <a href="./ponto?status=sem_prod&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; } ?>" class="small-box-footer">
                 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-primary">
              <div class="inner">
                 <h3><?php 
                        if ($dados['qtd_fechamento'][0]->qtd == '') {
                            echo 0;
                        } else {
                            
                            echo $dados['qtd_fechamento'][0]->qtd;
                            
                        }    
                        ?> -  <?php 
                        if ($dados['s_qtd_fechamento'][0]->qtd == '') {
                            echo 0.00;
                        } else {
                            
                            echo $dados['s_qtd_fechamento'][0]->qtd;
                            
                        }    
                        ?></h3>
                        

                <p>HE Divergente de Produção - HC</p>
              </div>
              <div class="icon">
                <i class="fas fa-project-diagram"></i>
              </div>
              <a href="./ponto?status=fechamento&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; } ?>" class="small-box-footer">
                 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                   <h3> <?php echo $dados['qtd_demora'][0]->qtd;?> -  <?php echo $dados['s_qtd_demora'][0]->qtd;?></h3>

                <p>Demora no inicio da atividade - HC</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-clock"></i>
              </div>
              <a href="./ponto?status=demora&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; } ?>" class="small-box-footer">
                 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                   <h3><?php echo $dados['qtd_n_ponto'][0]->qtd;?> - <?php echo $dados['s_qtd_n_ponto'][0]->qtd;?></h3>

                <p>Marcação não realizada - HC</p>
              </div>    
              <div class="icon">
                <i class="fas fa-user-clock"></i>
              </div>
              <a href="./ponto?status=nponto&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; } ?>" class="small-box-footer">
                 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
                  <!-- NOVOS -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-olive">
              <div class="inner">
                 <h3><?php 
                        if ($dados['qtd_gps'][0]->qtd == '') {
                            echo 0;
                        } else {
                            
                            echo $dados['qtd_gps'][0]->qtd;
                            
                        }           
                        
                        ?> -  <?php 
                                if ($dados['s_qtd_gps'][0]->qtd == '') {
                            echo 0.00;
                        } else {
                            
                            echo $dados['s_qtd_gps'][0]->qtd;
                            
                        }    
                        ?></h3>
                        

                <p>GPS Desligado - HC</p>
              </div>
              <div class="icon">
                <i class="fas fa-project-diagram"></i>
              </div>
              <a href="./ponto?status=gps&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; } ?>" class="small-box-footer">
                 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-teal">
              <div class="inner">
                   <h3> <?php echo $dados['qtd_2h'][0]->qtd;?> -  <?php echo $dados['s_qtd_2h'][0]->qtd;?></h3>

                <p>Maior de 2hs HE - HC</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-clock"></i>
              </div>
              <a href="./ponto?status=2h&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; } ?>" class="small-box-footer">
                 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                   <h3><?php echo $dados['qtd_aderencia'][0]->qtd;?> - <?php echo $dados['s_qtd_aderencia'][0]->qtd;?></h3>

                <p>Aderencia ao Ponto - HC</p>
              </div>    
              <div class="icon">
                <i class="fas fa-user-clock"></i>       
              </div>
              <a href="./ponto?status=aderencia&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; } ?>" class="small-box-footer">
                 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          
           <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-link">
              <div class="inner">
                   <h3><?php echo $dados['qtd_domingo'][0]->qtd;?> - <?php echo $dados['s_qtd_domingo'][0]->qtd;?></h3>

                <p>Ponto após 18hs 100% - HC</p>
              </div>    
              <div class="icon">
                <i class="fas fa-user-clock"></i>       
              </div>
              <a href="./ponto?status=domingo&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; } ?>" class="small-box-footer">
                 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-link">
              <div class="inner">
                   <h3><?php 
                        if (empty($dados['qtd_domingos'])) {
                            echo 0;
                        } else {
                            
                            echo $dados['qtd_domingos'][0]->qtd;
                            
                        }           
                        
                        ?> -  <?php 
                         if (empty($dados['qtd_domingos'])) {
                            echo 0.00;
                        } else {
                            
                            echo $dados['s_qtd_domingos'][0]->qtd;
                            
                        }    
                        ?></h3>
                
               
               
                <p>Maior que 2 domingos trabalhados - HC</p>
              </div>    
              <div class="icon">
                <i class="fas fa-user-clock"></i>       
              </div>
              <a href="./ponto?status=domingos&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; } ?>" class="small-box-footer">
                 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-link">
              <div class="inner">
               
                   <h3><?php 
                        if (empty($dados['qtd_7_dias'])) {
                            echo 0;
                        } else {
                            echo $dados['qtd_7_dias'][0]->qtd;
                            
                        }           
                        
                        ?> -  <?php 
                                if (empty($dados['qtd_7_dias'])) {
                            echo 0.00;
                        } else {
                            
                            echo $dados['s_qtd_7_dias'][0]->qtd;
                            
                        }    
                        ?></h3>
                
               
             
                <p>Mais de 7 dias trabalhados - HC</p>
              </div>    
              <div class="icon">
                <i class="fas fa-user-clock"></i>       
              </div>
              <a href="./ponto?status=7_dias&gerente=<?php if(isset($_GET['gerente'])) {
                    echo $_GET['gerente'];
                    } else { echo 'TODOS'; } ?>&coordenador=<?php if(isset($_GET['coordenador'])) {
                    echo $_GET['coordenador'];
                    } else { echo 'TODOS'; } ?>&supervisor=<?php if(isset($_GET['supervisor'])) {
                    echo $_GET['supervisor'];
                    } else { echo 'TODOS'; } ?>&inicio=<?php if(isset($_GET['inicio'])) {
                    echo $_GET['inicio'];
                    } else { echo ''; } ?>&fim=<?php if(isset($_GET['fim'])) {
                    echo $_GET['fim'];
                    } else { echo ''; } ?>" class="small-box-footer">
                 <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          
      
          <!-- ./col -->
        </div>
        </div>
</div>


<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">RESULTADO DE HORAS - FILTRO</h5>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong><?php 
                            if(isset($_GET['gerente'])) {
                                echo 'Gerente: '.$_GET['gerente'];
                            } else { 
                                echo 'Gerente: TODOS'; 
                            }
                            if(isset($_GET['coordenador'])) {
                                echo ' | Coordenador: '.$_GET['coordenador'];
                            } else { 
                                echo ' | Coordenador: TODOS'; 
                            }
                            if(isset($_GET['supervisor'])) {
                                echo ' | Supervisor: '.$_GET['supervisor'];
                            } else { 
                                echo ' | Supervisor: TODOS'; 
                            }
                            if(isset($_GET['inicio'])) {
                                echo ' | Incio: '.$_GET['inicio'];
                            } else { 
                                echo ' | Inicio: Não selecionado';
                            }
                            
                             if(isset($_GET['fim'])) {
                                echo ' | Fim: '.$_GET['inicio'];
                            } else { 
                                echo ' | Fim: Não selecionado';
                            }
                            
                            ?>
                            </strong>
                    </p>

                                <div id="chart_divH" style="width: 1120px; height: 300px;"></div>

                    <!-- /.chart-responsive -->
                  </div></div>
                  <!-- /.col -->
                  
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                     <!-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span> -->
                      <h5 class="description-header"><?php 
                    if (empty($dados['s_qtd_50'][0]->qtd)) {
                        echo 0;
                    } else {
                        echo  $dados['s_qtd_50'][0]->qtd;
                       // echo date('H:i:s', strtotime(($dados['s_qtd_50'][0]->qtd/24)));
                    }
                    
                    ;?></h5>
                      <span class="description-text">TOTAL 50%</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                     <!-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span> --> <h5 class="description-header"><?php
                      if (empty($dados['s_qtd_100'][0]->qtd)) {
                        echo 0;
                    } else {
                        echo $dados['s_qtd_100'][0]->qtd;
                    }
                    
                    ?></h5>
                      <span class="description-text">TOTAL 100%</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                      <!-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span> -->
                      <h5 class="description-header"><?php 
                   
                      if (empty($dados['s_qtd_total'][0]->qtd)) {
                        echo 0;
                    } else {
                        echo $dados['s_qtd_total'][0]->qtd;
                    }
                   
                   ?></h5>
                      <span class="description-text">TOTAL HE</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>

<!-- <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">COMPARTIVO DE HORAS - FILTRO</h5>

              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong><?php 
                            if(isset($_GET['gerente'])) {
                                echo 'Gerente: '.$_GET['gerente'];
                            } else { 
                                echo 'Gerente: TODOS'; 
                            }
                            ?>
                            </strong>
                    </p>

                                <div id="chart_divC" style="width: 1120px; height: 300px;"></div>

                
                  </div></div>
           
      
              </div>
             
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"> 
                    <?php 
                    
                        if (empty($dados['s_qtd_t_50_u'][0]->soma) || empty($dados['s_qtd_t_50_a'][0]->soma) ) {
                            echo 0;
                        } else {
                            echo  round(((($dados['s_qtd_t_50_a'][0]->soma)-(($dados['s_qtd_t_50_u'][0]->soma)/2)*4)/($dados['s_qtd_t_50_a'][0]->soma)*100),2).'%';
                        }
                    ;?>
                    
                    </i></span>
                      
                     
                     <h5 class="description-header">Anterior: <?php 
                     if (empty($dados['s_qtd_t_50_a'][0]->qtd)) {
                        echo 0;
                    } else {
                        echo  $dados['s_qtd_t_50_a'][0]->qtd;
                    }
                    
                    ;?>
                      

                      <h5 class="description-header">Projeção: <?php 
                    if (empty($dados['s_qtd_t_50_u'][0]->qtd)) {
                        echo 0;
                    } else {
                        echo  $dados['s_qtd_t_50_u'][0]->qtd;
                    }
                    
                    ;?></h5>
                      <span class="description-text">TOTAL 50%</span>
                    </div>
                   
                  </div>
               
                  <div class="col-sm-6 col-6">
                    <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <b>  <?php 
                    
                        if (empty($dados['s_qtd_t_100_u'][0]->soma) || empty($dados['s_qtd_t_100_a'][0]->soma) ) {
                            echo 0;
                        } else {
                            echo  round(((($dados['s_qtd_t_100_a'][0]->soma)-(($dados['s_qtd_t_100_u'][0]->soma)/2)*4)/($dados['s_qtd_t_100_a'][0]->soma)*100),2).'%';
                        }
                    ;?>
                    
                    </i></span></b>
                      
                     
                     <h5 class="description-header">Anterior: <?php 
                     if (empty($dados['s_qtd_t_100_a'][0]->qtd)) {
                        echo 0;
                    } else {
                        echo  $dados['s_qtd_t_100_a'][0]->qtd;
                    }
                    
                    ;?>
                      

                      <h5 class="description-header">Projeção: <?php 
                    if (empty($dados['s_qtd_t_100_u'][0]->qtd)) {
                        echo 0;
                    } else {
                        echo  $dados['s_qtd_t_100_u'][0]->qtd;
                    }
                    
                    ;?></h5>
                  
                      <span class="description-text">TOTAL 100%</span>
                    </div>
                  
                  </div>
                 
                </div>
            
              </div>
</div>
              <!-- /.card-footer -->

  <div class="box-body responsive no-padding">
    <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Dia', 'Horas'],
          <?php 
          foreach ($dados['grafico1'] as $historico) {
            echo '["'.date('d/m', strtotime($historico->DATA)).'",'.$historico->HE_TOTAL.'],';
          }

          ?>
       
        ]);

        var options = {
          vAxis: {title: ''},
          hAxis: {title: ''},
          seriesType: 'bars',
          series: {3: {type: 'line'}},
            colors: ['#008B8B', '#7FFFD4'],
          bar: {groupWidth: "70%"},
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
          foreach ($dados['grafico2'] as $historico) {
            echo '["'.$historico->DIA.'",'.$historico->TOTAL_HE.','.$historico->A_TOTAL_HE.','.$historico->PROJECAO.'],';
          }

          ?>
       
        ]);

        var options = {
          vAxis: {title: ''},
          hAxis: {title: ''},
          seriesType: 'bars',
          series: {3: {type: 'line'}},
            colors: ['#008B8B', '#87ccb4', '#a5fadd'],
          bar: {groupWidth: "60%"},
          legend: {position: 'right', maxLines: 8},
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
  <body>
  </body>
</div>

</div>
</div>








    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
  <div class="box-body table-responsive no-padding">
  <div class="form-group col-md-1">
                    <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                    <a href="https://gestaoderecursos.com/exportacao/IMPORT_PONTO_IMPORT.csv" ><input  type="button" class="form-control form-control-md btn btn-secondary" value="Exportar"></a>
                </div>
  
 <table id="minhaTabela2" class="table table-striped table-sm table-bordered dataTable">
    <thead>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[GESTÃO DE PONTO - OCORRÊNCIA NOMINAL/FILTRO] <i style="color:red">(Prod OK e Prod INF: Considerado apenas Instalação, reparo, mudança e desconexão.)</i></th> 
        </tr>
        <tr class="bg-light text-center py-0 align-middle">
   
            <th style=" background-color:#808080;color:white;width:120px"><center>Coordenador</th>      
            <th style=" background-color:#808080;color:white;width:170px"><center>Supervisor</th>
            <th style=" background-color:#808080;color:white;width:170px"><center>Técnico</th>
            <th style=" background-color:#808080;color:white;width:170px"><center>Data</th>
            <th style=" background-color:#808080;color:white;width:40px"><center>Entrada</th>
            <th style=" background-color:#808080;color:white;width:40px"><center>Saída</th>
            <th style="background-color:#808080;color:white;width:40px" title=""><center>Prim. Ativ</th>
            <th style="background-color:#808080;color:white;width:40px" title=""><center>Últ. Ativ</th>
            <th style="background-color:#808080;color:white;width:40px" title=""><center>Dif Inicio</th>
            <th style="background-color:#808080;color:white;width:40px" title=""><center>Dif Fim</th>
            <th style="background-color:#808080;color:white;width:40px" title=""><center>HE</th>
            <th style="background-color:#808080;color:white;width:40px" title="Considerado apenas Instalação, reparo, mudança e desconexão"><center>Prod. OK</th>
            <th style="background-color:#808080;color:white;width:40px" title="Considerado apenas Instalação, reparo, mudança e desconexão"><center>Prod. INF</th>
            <th style="background-color:#808080;color:white;width:40px" title="Marcações"><center>Marc.</th>
            <th style="background-color:#808080;color:white;width:40px" title=""><center>GPS INI</th>
            <th style="background-color:#808080;color:white;width:40px" title=""><center>GPS FIM</th>
         
        </tr>
    </thead>
    <tbody>
            <?php 
                foreach ($dados['ponto'] as $gr) {
                  /*  if ($gr->COORDENADOR != '') {
                        $coordenador = $gr->COORDENADOR;
                    } else {
                        $coordenador = 'N_IDENTIFICADO';
                    }
                    if ($gr->SUPERVISOR != '') {
                        $supervisor = $gr->SUPERVISOR;
                    } else {
                        $supervisor = 'N_IDENTIFICADO';
                    }
                    if ($gr->TECNICO != '') {
                        $tecnico = $gr->TECNICO;
                    } else {
                        $tecnico = 'N_IDENTIFICADO';
                    } */
                    
                    
                    echo '<tr>
                   
                    <td>'.$gr->COORDENADOR.'</td>
                    <td>'.$gr->SUPERVISOR.'</td>
                    <td><a href="./detalhe?id='.$gr->ID.'">'.$gr->NOME_TOA.'</td>
                    <td>'.$gr->DATA.'|'.$gr->DIA.'</td>
                    <td>'.$gr->PRIMEIRA_MARCACAO.'</td>
                    <td>'.$gr->ULTIMA_MARCACAO.'</td>
                    <td>'.$gr->INICIO_ATIVIDADE.'</td>
                    <td>'.$gr->FIM_ATIVIDADE.'</td>
                    <td>'.$gr->DIF_INI_PONT_ATIV.'</td>
                    <td>'.$gr->DIF_FIM_PONT_ATIV.'</td>
                    <td>'.$gr->TOTAL_HE.'</td>
                    <td>'.$gr->OK.'</td>
                    <td>'.$gr->INF.'</td>
                    <td>'.$gr->MARCACOES.'</td>
                    <td>'.$gr->GPS_INICIO.'</td>
                    <td>'.$gr->GPS_FIM.'</td>
                    </tr>
                    ';
                }
            ?>

    </tbody>
  </table>
  </form>
</div>
</div>
</div>
</div></div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
  <div class="box-body table-responsive no-padding">
 <table id="minhaTabela3" class="table table-striped table-sm table-bordered dataTable">
    <thead>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[GESTÃO DE PONTO - MARCAÇÕES INCORRETAS] </th> 
        </tr>
        <tr class="bg-light text-center py-0 align-middle">
            <th style=" background-color:#808080;color:white;width:150px"><center>Coordenador</th>
            <th style=" background-color:#808080;color:white;width:150px"><center>Supervisor</th>
            <th style=" background-color:#808080;color:white;width:150px"><center>Técnico</th>
            <th style=" background-color:#808080;color:white;width:50px"><center>Data</th>
            <th style=" background-color:#808080;color:white;width:50px"><center>Entrada</th>
            <th style=" background-color:#808080;color:white;width:50px"><center>Saída</th>
            <th style="background-color:#808080;color:white;width:50px" title=""><center>Primeira Ativ</th>
            <th style="background-color:#808080;color:white;width:50px" title=""><center>Última Aividade</th>
        </tr>
    </thead>
    <tbody>
            <?php 
                foreach ($dados['ajustar'] as $gr) {
                  /*  if ($gr->COORDENADOR != '') {
                        $coordenador = $gr->COORDENADOR;
                    } else {
                        $coordenador = 'N_IDENTIFICADO';
                    }
                    if ($gr->SUPERVISOR != '') {
                        $supervisor = $gr->SUPERVISOR;
                    } else {
                        $supervisor = 'N_IDENTIFICADO';
                    }
                    if ($gr->TECNICO != '') {
                        $tecnico = $gr->TECNICO;
                    } else {
                        $tecnico = 'N_IDENTIFICADO';
                    } */
                    
                    
                    echo '<tr>
                   
                    <td>'.$gr->COORDENADOR.'</td>
                    <td>'.$gr->SUPERVISOR.'</td>
                    <td><a href="./detalhe?id='.$gr->ID.'">'.$gr->NOME_TOA.'</td>
                    <td>'.$gr->DATA.'|'.$gr->DIA.'</td>
                    <td>'.$gr->PRIMEIRA_MARCACAO.'</td>
                    <td>'.$gr->ULTIMA_MARCACAO.'</td>
                    <td>'.$gr->INICIO_ATIVIDADE.'</td>
                    <td>'.$gr->FIM_ATIVIDADE.'</td>
                    </tr>
                    ';
                }
            ?>

    </tbody>
  </table>
  </form>
</div>
</div>
</div>
</div></div>



  <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
      <h3>[Ranking] 
          </h3><p>

                    <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b><h5><center>[TOP 10] HE 50%</center></h5></u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                    
                      <th>Nome</th>
                      <th>Horas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php //dd($dados);
                      $num = 1;
                      foreach ($dados['s_qtd_t_50'] as $tts) {
                        echo 
                          '<tr>
                          
					
                            <td><center>'.$tts->nome.'</td>
                            <td align="center"><span class="badge bg-danger">'.$tts->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b><h5><center>[TOP 10] HE 100%</center></h5></u></b></p>
               <table class="table">
                  <thead align="center">
                      <tr>
                    
                      <th>Nome</th>
                      <th>Horas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['s_qtd_t_100'] as $tts) {
                        echo 
                          '<tr>
                          
					
                            <td><center>'.$tts->nome.'</td>
                            <td align="center"><span class="badge bg-danger">'.$tts->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-"></i></a>
            </div>
   
            
   
          <!-- ./col -->
        </div>
            
              <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b><h5><center>[Top 10] Horas Negativas</center></h5></u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                 
                      <th>Nome</th>
                      <th>Horas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                       foreach ($dados['s_qtd_t_negativa'] as $tts) {
                        echo 
                          '<tr>
                          
					
                            <td><center>'.$tts->nome.'</td>
                            <td align="center"><span class="badge bg-danger">'.$tts->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-"></i></a>
            </div>
   
            
                </div>
            </div>
        </div>
    </div>





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
             "order": [[ 7, "desc" ]]
        });
  });


  $(document).ready(function(){
      $('#minhaTabela3').DataTable({
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
             "order": [[ 7, "desc" ]]
        });
  });


  </script>

@stop
@stop
