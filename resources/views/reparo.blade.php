@extends('adminlte::page')

@section('title', 'Reparo')

@section('content_header')
 <!--  <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop

@section('content')



    <div class="callout callout-secondary">
    <h5><B>FILTRO</B></h5><p>
         <a class="btn btn-light" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="true" aria-controls="collapseExample4">
    <i class="fa fa-minus-square" aria-hidden="true"></i> Fechar grupo
  </a><p>
 <b>Fonte de dados:</b> TOA | <b>Última atividade: </b> <?php date_default_timezone_set('America/Sao_Paulo');
 echo $dados['AtualizacaoMontada'];?>
</p>
<div class="collapse" id="collapseExample4">
<form action="./instalacao" method="get">
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
                  <label for="exampleInputEmail1">Tecnologia:</label>
                  <select class="form-control form-control-md" name="tecnologia">
                  
                    <option value="TODOS">TODOS</option>
                    <option value="GPON">GPON</option>
                    <option value="METALICO">METÁLICO</option>
                  </select>
                </div>
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-secondary" value="Filtrar">
              </div>
</form>
              <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                   <a href="./download-grade" ><input  type="button" class="form-control form-control-md btn btn-secondary" value="Baixar excel"></a>
              </div>
</div>
</div>
</div>



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
      <h3>[REPARO 
        <?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | '.$_GET['tecnologia'];
          } 
          if (!empty($_GET['inicio'])) {
            echo ' | Entre '.date('d/m/Y', strtotime($_GET['inicio'])). ' e '.date('d/m/Y', strtotime($_GET['fim'])) ;
          }
        ?>
        ] </h3><p>

                    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $dados['backlogProducao'][0]->qtd }}</h3>

                <p>Backlog Produção</p>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3>{{ $dados['naoIniciado'][0]->qtd }}</h3>

                <p>Não Iniciada</p>
              </div>
              <div class="icon">
                <i class="fas fa-history"></i>
              </div>
                <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                  <h3>{{ $dados['iniciado'][0]->qtd }}</h3>

                <p>Iniciado</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
                <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
               <h3>{{ $dados['producao'][0]->qtd }}</h3>

                <p>Concluída</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-clock"></i>
              </div>
                <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
               <h3>{{ $dados['pendente'][0]->qtd }}</h3>

                <p>Pendente</p>
              </div>
              <div class="icon">
                <i class="fa fa-cogs"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3>{{ $dados['cancelada'][0]->qtd }}</h3>

                <p>Cancelada</p>
              </div>
              <div class="icon">
                <i class="fas fa-history"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                  <h3>{{ $dados['suspenso'][0]->qtd }}</h3>

                <p>Suspenso</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3>{{ round(100-(($dados['pendente'][0]->qtd)/($dados['producao'][0]->qtd+$dados['pendente'][0]->qtd)*100),2).'%' }}</h3>

                <p>Eficácia</p>
              </div>
              <div class="icon">
                <i class="fa fa-window-close"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>














          <!-- PRAZOS
          <div class="col-lg-2 col-6">
            <!-- small box -->
        
          <!--     <div class="small-box bg-gray">
              <div class="inner">
                 <h3>0</h3>

                <p>Abertas no Prazo</p>
              </div>
              <div class="icon">
                <i class="fas fa-history"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
      
          <!--     <div class="col-lg-2 col-6">
            <!-- small box -->
       
          <!--      <div class="small-box bg-gray">
              <div class="inner">
                     <h3>0</h3>

                  <p>Abertas no Vencidas</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

           <div class="col-lg-2 col-6">
            <!-- small box -->
      
          <!--       <div class="small-box bg-gray">
              <div class="inner">
                     <h3>0</h3>

                <p>Encerradas no Prazo</p>
              </div>
              <div class="icon">
                <i class="fas fa-history"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
       
          <!--    <div class="col-lg-2 col-6">
            <!-- small box -->
     
          <!--        <div class="small-box bg-gray">
              <div class="inner">
                     <h3>0</h3>

                  <p>Encerradas no Vencidas</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

             <div class="col-lg-2 col-6">
            <!-- small box -->
    
          <!--         <div class="small-box bg-gray">
              <div class="inner">
                     <h3>0</h3>

                <p>Pendente no Prazo</p>
              </div>
              <div class="icon">
                <i class="fas fa-history"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
       
          <!--    <div class="col-lg-2 col-6">
            <!-- small box -->
      
          <!--       <div class="small-box bg-gray">
              <div class="inner">
                     <h3>0</h3>

                  <p>Pendente no Vencidas</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
    
          <!--       <!-- ./col -->
   
          <!--      </div>-->
        </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
      <h3>[REPARO RECENTE 
        <?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | '.$_GET['tecnologia'];
          } 
          if (!empty($_GET['inicio'])) {
            echo ' | Entre '.date('d/m/Y', strtotime($_GET['inicio'])). ' e '.date('d/m/Y', strtotime($_GET['fim'])) ;
          }
        ?>
        ] </h3><p>

                    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $dados['recbacklogProducao'][0]->qtd }}</h3>

                <p>Backlog Produção</p>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3>{{ $dados['recnaoIniciado'][0]->qtd }}</h3>

                <p>Não Iniciada</p>
              </div>
              <div class="icon">
                <i class="fas fa-history"></i>
              </div>
                <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                  <h3>{{ $dados['reciniciado'][0]->qtd }}</h3>

                <p>Iniciado</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
                <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
               <h3>{{ $dados['recproducao'][0]->qtd }}</h3>

                <p>Concluída</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-clock"></i>
              </div>
                <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
               <h3>{{ $dados['recpendente'][0]->qtd }}</h3>

                <p>Pendente</p>
              </div>
              <div class="icon">
                <i class="fa fa-cogs"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3>{{ $dados['reccancelada'][0]->qtd }}</h3>

                <p>Cancelada</p>
              </div>
              <div class="icon">
                <i class="fas fa-history"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                  <h3>{{ $dados['recsuspenso'][0]->qtd }}</h3>

                <p>Suspenso</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3>{{ round(100-(($dados['recpendente'][0]->qtd)/($dados['recproducao'][0]->qtd+$dados['recpendente'][0]->qtd)*100),2).'%' }}</h3>

                <p>Eficácia</p>
              </div>
              <div class="icon">
                <i class="fa fa-window-close"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
        </div>
      </div>   
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
      <h3>[REPARO REPETIDO 
        <?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | '.$_GET['tecnologia'];
          } 
          if (!empty($_GET['inicio'])) {
            echo ' | Entre '.date('d/m/Y', strtotime($_GET['inicio'])). ' e '.date('d/m/Y', strtotime($_GET['fim'])) ;
          }
        ?>
        ] </h3><p>

                    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $dados['repbacklogProducao'][0]->qtd }}</h3>

                <p>Backlog Produção</p>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3>{{ $dados['repnaoIniciado'][0]->qtd }}</h3>

                <p>Não Iniciada</p>
              </div>
              <div class="icon">
                <i class="fas fa-history"></i>
              </div>
                <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                  <h3>{{ $dados['repiniciado'][0]->qtd }}</h3>

                <p>Iniciado</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
                <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
               <h3>{{ $dados['repproducao'][0]->qtd }}</h3>

                <p>Concluída</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-clock"></i>
              </div>
                <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
               <h3>{{ $dados['reppendente'][0]->qtd }}</h3>

                <p>Pendente</p>
              </div>
              <div class="icon">
                <i class="fa fa-cogs"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3>{{ $dados['repcancelada'][0]->qtd }}</h3>

                <p>Cancelada</p>
              </div>
              <div class="icon">
                <i class="fas fa-history"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                  <h3>{{ $dados['repsuspenso'][0]->qtd }}</h3>

                <p>Suspenso</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
                 <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3>{{ round(100-(($dados['reppendente'][0]->qtd)/($dados['repproducao'][0]->qtd+$dados['reppendente'][0]->qtd)*100),2).'%' }}</h3>

                <p>Eficácia</p>
              </div>
              <div class="icon">
                <i class="fa fa-window-close"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
        </div>
      </div>   
    </div>







    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
      <h3>[TOP 10 OK   <?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | '.$_GET['tecnologia'];
          } 
          if (!empty($_GET['inicio'])) {
            echo ' | Entre '.date('d/m/Y', strtotime($_GET['inicio'])). ' e '.date('d/m/Y', strtotime($_GET['fim'])) ;
          }
        ?>] </h3><p>

                    <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b>Produção Técnico</u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Técnico</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingTecnicosOk'] as $tecnicos) {
                        echo 
                          '<tr>
                            <td>'.$num++.'</td>
                            <td>'.$tecnicos->provedor.'</td>
                            <td align="center"><span class="badge bg-success">'.$tecnicos->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b>Produção Micro Área</u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Micro Área</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingMicroAreaOk'] as $tecnicos) {
                        echo 
                          '<tr>
                            <td>'.$num++.'</td>
                            <td>'.$tecnicos->microarea.'</td>
                            <td align="center"><span class="badge bg-success">'.$tecnicos->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
    
          </div>  <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b>Produção MSAN</u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>MSAN</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingMsanOk'] as $tecnicos) {
                        echo 
                          '<tr>
                            <td>'.$num++.'</td>
                            <td>'.$tecnicos->msan.'</td>
                            <td align="center"><span class="badge bg-success">'.$tecnicos->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

             
          <!-- ./col -->
        </div>
                </div>
            </div>
        </div>
    </div>






    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
      <h3>[TOP 10 Pendenciamento   <?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | '.$_GET['tecnologia'];
          } 
          if (!empty($_GET['inicio'])) {
            echo ' | Entre '.date('d/m/Y', strtotime($_GET['inicio'])). ' e '.date('d/m/Y', strtotime($_GET['fim'])) ;
          }
        ?>] </h3><p>

                    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b>Produção Técnico</u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Técnico</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingTecnicosPendente'] as $tecnicos) {
                        echo 
                          '<tr>
                            <td>'.$num++.'</td>
                            <td>'.substr($tecnicos->provedor,0,20).'...</td>
                            <td align="center"><span class="badge bg-success">'.$tecnicos->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b>Produção Micro Área</u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Micro Área</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingMicroAreaPendente'] as $tecnicos) {
                        echo 
                          '<tr>
                            <td>'.$num++.'</td>
                            <td>'.$tecnicos->microarea.'</td>
                            <td align="center"><span class="badge bg-success">'.$tecnicos->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
    
          </div>  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b>Produção MSAN</u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>MSAN</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingMsanPendente'] as $tecnicos) {
                        echo 
                          '<tr align ="">
                            <td>'.$num++.'</td>
                            <td>'.$tecnicos->msan.'</td>
                            <td align="center"><span class="badge bg-success">'.$tecnicos->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

             <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b>Motivos Pendenciamentos</u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Motivos</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingPendenciamentoPendente'] as $tecnicos) {
                        echo 
                          '<tr align ="">
                            <td>'.$num++.'</td>
                            <td>'.substr($tecnicos->razao_nao_executado_3,0,20).'...</td>
                            <td align="center"><span class="badge bg-success">'.$tecnicos->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

          <!-- ./col -->
        </div>
                </div>
            </div>
        </div>
    </div>






    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
      <h3>[TOP 10 Qualidade   <?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | '.$_GET['tecnologia'];
          } 
          if (!empty($_GET['inicio'])) {
            echo ' | Entre '.date('d/m/Y', strtotime($_GET['inicio'])). ' e '.date('d/m/Y', strtotime($_GET['fim'])) ;
          }
        ?>] </h3><p>

                    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b>Motivo de Fechamento - [RECENTE]</u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Técnico</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingRecenteOk'] as $tecnicos) {
                        echo 
                          '<tr>
                            <td>'.$num++.'</td>
                            <td>'.substr($tecnicos->codigo_causa,0,20).'...</td>
                            <td align="center"><span class="badge bg-success">'.$tecnicos->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                  <p><u><b>Motivo de Fechamento - [REPETIDA]</u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Micro Área</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingRepetidaOk'] as $tecnicos) {
                        echo 
                          '<tr>
                            <td>'.$num++.'</td>
                            <td>'.$tecnicos->codigo_causa.'</td>
                            <td align="center"><span class="badge bg-success">'.$tecnicos->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
    
          </div>  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                 <p><u><b>Motivo do Pendenciamento - [RECENTE]</u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>MSAN</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingRecentePendente'] as $tecnicos) {
                        echo 
                          '<tr align ="">
                            <td>'.$num++.'</td>
                            <td>'.$tecnicos->razao_nao_executado_3.'</td>
                            <td align="center"><span class="badge bg-success">'.$tecnicos->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

             <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">

                <p><u><b>Motivo do Pendenciamento - [REPETIDA]</u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Motivos</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingRepetidaPendente'] as $tecnicos) {
                        echo 
                          '<tr align ="">
                            <td>'.$num++.'</td>
                            <td>'.substr($tecnicos->razao_nao_executado_3,0,20).'...</td>
                            <td align="center"><span class="badge bg-success">'.$tecnicos->qtd.'</span></td>
                          </tr>';
                      }

                    ?>
                   
                  </tbody>
                </table>
              </div>
              <div class="icon">
                <i class="fa fa-database"></i>
              </div>
              <a href="#" class="small-box-footer">Baixar <i class="fas fa-arrow-circle-down"></i></a>
            </div>
          </div>

          <!-- ./col -->
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
