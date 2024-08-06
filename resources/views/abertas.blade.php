

@extends('adminlte::page')

@section('title', 'Reparo')

@section('content_header')
<h1 class="m-0 text-dark">[REPARO SP]</h1>
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
setTimeout(function() {
    window.location.href = "https://indicadores.gestaoderecursos.com/public/home";
}, 5000);

</script>
-->
<style>
    #content {
    transform: scale(0.8);
    transform-origin: 2 1;
}
</style>
-->
<?php 
  /*  if ($dados['total'][0]->qtd == '' || empty($dados['total'][0]->qtd)) {
    die();
        
    }
*/
?>
    <div class="callout callout-secondary">
         <a class="btn btn-light" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="true" aria-controls="collapseExample4">
    <i class="fa fa-minus-square" aria-hidden="true"></i> Abrir filtro
  </a><p>
 <b>Fonte de dados:</b> BÚSSOLA | <b>Última atualização: </b> 
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
<div class="collapse" id="collapseExample4">
<form action="./abertas" method="get">
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
                <!-- <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Filial:</label>
                  <select class="form-control form-control-md" name="filial">
                  
                    <option value="TODOS">TODOS</option>
                    <option value="RJ">RJ</option>
                    <option value="SP">SP</option>
                  </select>
                </div> -->
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-secondary" value="Filtrar">
              </div>
</form>
                <div class="form-group col-md-1">
                    <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                    <a href="https://gestaoderecursos.com/exportacao/abertas.php" ><input  type="button" class="form-control form-control-md btn btn-secondary" value="Baixar excel"></a>
                </div>
</div>
</div>
</div>
<?php //dd($dados['visaoFFA']);?>




    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
<div class="row">
          <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-database"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Backlog</span>
                <span class="info-box-number">{{ $dados['total'][0]->qtd }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
           <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-"><i class="fas fa-database"></i></span>

              <div class="info-box-content"><a href="./atribuicao_sp?STATUS_ATRIUICAO=ATRIBUIDO">
                <span class="info-box-text">Atribuídos</span>
                <span class="info-box-number">{{ $dados['atribuido'][0]->QTD }}</span></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
           <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-"><i class="fas fa-database"></i></span>

              <div class="info-box-content"><a href="./atribuicao_sp?STATUS_ATRIUICAO=N_ATRIBUIDO">
                <span class="info-box-text">Não Atribuídos</span>
                <span class="info-box-number">{{ $dados['n_atribuido'][0]->QTD }}</span></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-cogs"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Entrante TOA</span>
                <span class="info-box-number">{{ $dados['abertas_toa'][0]->qtd }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
           <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-light"><i class="fas fa-shield-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Preventiva</span>
                <span class="info-box-number">{{ $dados['preventiva'] }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-calendar-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Dentro do Prazo</span>
                <span class="info-box-number">{{ $dados['dentro'][0]->qtd }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-calendar-times"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Fora do Pazo</span>
                <span class="info-box-number">{{ $dados['fora'][0]->qtd }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
           <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-light"><i class="fas fa-percent"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">% Time Life 24hs</span> <?php //dd($dados['dentro']);?>
                <span class="info-box-number">{{ round((($dados['dentro'][0]->qtd/$dados['total'][0]->qtd)*100),2) }} %</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
               <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-light"><i class="fas fa-database"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Enc. COP</span>
                <span class="info-box-number">{{ $dados['enc_cop'][0]->qtd }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-light"><i class="fas fa-tools"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Enc. Massiva</span>
                <span class="info-box-number">{{ $dados['enc_massiva'][0]->qtd }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
           <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-light"><i class="fas fa-users-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Enc. Técnico</span>
                <span class="info-box-number">{{ $dados['enc_tec'][0]->qtd }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-light"><i class="fas fa-shield-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Enc. Proativo</span>
                <span class="info-box-number">{{ $dados['enc_proativo'][0]->qtd }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-2 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-light"><i class="fas fa-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Enc. Total</span>
                <span class="info-box-number">{{ $dados['enc_total'] }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
         
          
          <!-- /.col -->
        </div>
          <!-- /.col -->
     
     
        
        
        
        
        
 <table id="minhaTabçççela" class="table table-responsive table-sm table-bordered table-hover dataTable">
    <thead>
      <tr class="bg-secondary text-center py-0 align-middle">
        <th style=" background-color:#;color:white;width:200px" colspan="17"><center>[REPARO <?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | '.$_GET['tecnologia'];
          } 
        ?>
        ] </th>
        </tr>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#;color:black;width:220px"><center>Regional</th>
        <th style=" background-color:#;color:black;width:140px"><center>20h</th>
        <th style=" background-color:#;color:black;width:140px"><center>24h</th>
        <th style=" background-color:#;color:black;width:140px"><center>48h</th>
        <th style=" background-color:#;color:black;width:140px"><center>72h</th>
        <th style=" background-color:#;color:black;width:140px"><center>96h</th>
        <th style=" background-color:#;color:black;width:140px"><center>Maior 96h</th>
        <th style=" background-color:#;color:black;width:140px"><center>Total</th>
        <th style=" background-color:#;color:black;width:140px"><center>% Resp. Ger.</th>

        
        
        
        </tr>
    </thead>
    <tbody>
          
            <?php 
            //dd($dados['faixas']);
            //    $ffa = $dados['visaoFFA'][0];
            
            
               echo '<tr class="bg- text-center py-0 align-middle">
                            <td>São Paulo Leste</td>
                            <td style="background-color:;color:">'.$dados['faixasRTotal'][0]->A.'</td>
                            <td style="background-color:;color:">'.$dados['faixasRTotal'][0]->B.'</td>
                            <td style="background-color:;color:">'.$dados['faixasRTotal'][0]->C.'</td>
                            <td style="background-color:;color:">'.$dados['faixasRTotal'][0]->D.'</td>
                            <td style="background-color:;color:">'.$dados['faixasRTotal'][0]->E.'</td>
                            <td style="background-color:;color:">'.$dados['faixasRTotal'][0]->F.'</td>
                            <td style="background-color:;color:">'.($dados['faixasRTotal'][0]->A+$dados['faixasRTotal'][0]->B+$dados['faixasRTotal'][0]->C
                            +$dados['faixasRTotal'][0]->D+$dados['faixasRTotal'][0]->E+$dados['faixasRTotal'][0]->F).'</td>
                            
                             <td style="background-color:;color:">'.round((($dados['faixasRTotal'][0]->A+$dados['faixasRTotal'][0]->B+$dados['faixasRTotal'][0]->C
                            +$dados['faixasRTotal'][0]->D+$dados['faixasRTotal'][0]->E+$dados['faixasRTotal'][0]->F)/($dados['faixasTotal'][0]->A+$dados['faixasTotal'][0]->B+$dados['faixasTotal'][0]->C
                            +$dados['faixasTotal'][0]->D+$dados['faixasTotal'][0]->E+$dados['faixasTotal'][0]->F)*100),2).'%</td>                            

                    ';
            
            
            
            
                foreach ($dados['faixas'] as $gr) {
                    if ($gr->A > 0) {
                            $colorA = "";
                            $colorfA = "";
                        } else {
                            $colorA = "";
                            $colorfA = "";
                        }
                        if ($gr->B > 0) {
                            $colorB = "";
                            $colorfB = "";
                        } else {
                            $colorB = "";
                            $colorfB = "";
                        }
                        if ($gr->C > 0) {
                            $colorC = "";
                            $colorfC = "";
                        } else {
                            $colorfC = "";
                            $colorC = "";
                        }
                        if ($gr->D > 0) {
                            $colorD = "";
                            $colorfD = "";
                        } else {
                            $colorfD = "";
                            $colorD = "";
                        }
                        if ($gr->E > 0) {
                            $colorfE = "";
                            $colorE = "";
                        } else {
                            $colorfE = "";
                            $colorE = "";
                        }
                        if ($gr->F > 0) {
                            $colorfF = "";
                            $colorF = "";
                        } else {
                            $colorfF = "";
                            $colorF = "";
                        }
                        
                }
                   echo '<tr class="bg-light text-center py-0 align-middle">
                  
                            <td style="background-color:#;color:#;"><b>Total</td>
                            <td style="background-color:#;color:'.$colorfA.'"><b>'.$dados['faixasTotal'][0]->A.'</td>
                            <td style="background-color:#;color:'.$colorfB.'"><b>'.$dados['faixasTotal'][0]->B.'</td>
                            <td style="background-color:#;color:'.$colorfC.'"><b>'.$dados['faixasTotal'][0]->C.'</td>
                            <td style="background-color:#;color:'.$colorfD.'"><b>'.$dados['faixasTotal'][0]->D.'</td>
                            <td style="background-color:#;color:'.$colorfE.'"><b>'.$dados['faixasTotal'][0]->E.'</td>
                            <td style="background-color:#;color:'.$colorfF.'"><b>'.$dados['faixasTotal'][0]->F.'</td>
                            <td style="background-color:#;color:"><b>'.($dados['faixasTotal'][0]->A+$dados['faixasTotal'][0]->B+$dados['faixasTotal'][0]->C
                            +$dados['faixasTotal'][0]->D+$dados['faixasTotal'][0]->E+$dados['faixasTotal'][0]->F).'</td>
                            
                            <td style="background-color:#;color:"><b>100.00%</td>

                    ';
                
            ?>

    </tbody>
  </table>
  </form>
  <br>
  
   <table id="minhaTabçççela" class="table table-responsive table-sm table-bordered table-hover dataTable">
    <thead>
      <tr class="bg-secondary text-center py-0 align-middle">
        <th style=" background-color:#;color:white;width:200px" colspan="17"><center>[REPARO FFA <?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | '.$_GET['tecnologia'];
          } 
        ?>
        ] </th>
        </tr>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#;color:black;width:220px"><center>Supervisor</th>
        <th style=" background-color:#;color:black;width:220px"><center>Área</th>
        <th style=" background-color:#;color:black;width:140px"><center>20h</th>
        <th style=" background-color:#;color:black;width:140px"><center>24h</th>
        <th style=" background-color:#;color:black;width:140px"><center>48h</th>
        <th style=" background-color:#;color:black;width:140px"><center>72h</th>
        <th style=" background-color:#;color:black;width:140px"><center>96h</th>
        <th style=" background-color:#;color:black;width:140px"><center>Maior 96h</th>
        <th style=" background-color:#;color:black;width:140px"><center>Total</th>
        <th style=" background-color:#;color:black;width:140px"><center>% Resp. Coord.</th>
      </tr>
    </thead>
    <tbody>
          
            <?php 
            //dd($dados['faixas']);
            //    $ffa = $dados['visaoFFA'][0];
                foreach ($dados['faixasA'] as $gr) {
                    if ($gr->A > 0) {
                            $colorA = "";
                            $colorfA = "";
                        } else {
                            $colorA = "";
                            $colorfA = "#dbdbdb";
                        }
                        if ($gr->B > 0) {
                            $colorB = "";
                            $colorfB = "";
                        } else {
                            $colorB = "";
                            $colorfB = "#dbdbdb";
                        }
                        if ($gr->C > 0) {
                            $colorC = "";
                            $colorfC = "";
                        } else {
                            $colorfC = "#dbdbdb";
                            $colorC = "";
                        }
                        if ($gr->D > 0) {
                            $colorD = "";
                            $colorfD = "";
                        } else {
                            $colorfD = "#dbdbdb";
                            $colorD = "";
                        }
                        if ($gr->E > 0) {
                            $colorfE = "";
                            $colorE = "";
                        } else {
                            $colorfE = "";
                            $colorE = "";
                        }
                        if ($gr->F > 0) {
                            $colorfF = "";
                            $colorF = "";
                        } else {
                            $colorfF = "#dbdbdb";
                            $colorF = "";
                        }
                        
                    
                    echo '<tr class="bg- text-center py-0 align-middle">
                            <td>'.$gr->SUPERVISOR.'</td>
                            <td>'.$gr->SUPERVISAO.'</td>
                            <td style="background-color:'.$colorA.';color:'.$colorfA.'">'.$gr->A.'</td>
                            <td style="background-color:'.$colorB.';color:'.$colorfB.'">'.$gr->B.'</td>
                            <td style="background-color:'.$colorC.';color:'.$colorfC.'">'.$gr->C.'</td>
                            <td style="background-color:'.$colorD.';color:'.$colorfD.'">'.$gr->D.'</td>
                            <td style="background-color:'.$colorE.';color:'.$colorfE.'">'.$gr->E.'</td>
                            <td style="background-color:'.$colorF.';color:'.$colorfF.'">'.$gr->F.'</td>
                            <td style="background-color:;color:">'.($gr->A+$gr->B+$gr->C+$gr->D+$gr->E+$gr->F).'</td>
                             <td style="background-color:;color:">'.round((($gr->A+$gr->B+$gr->C+$gr->D+$gr->E+$gr->F)/($dados['faixasCTotal'][0]->A+$dados['faixasCTotal'][0]->B+$dados['faixasCTotal'][0]->C
                            +$dados['faixasCTotal'][0]->D+$dados['faixasCTotal'][0]->E+$dados['faixasCTotal'][0]->F)*100),2).'%</td>

                    ';
                }
                
                echo '<tr class="bg-light text-center py-0 align-middle">
                  <td style="background-color:#;color:#;"><b>-</td>
                            <td style="background-color:#;color:"><b>Total</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasCTotal'][0]->A.'</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasCTotal'][0]->B.'</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasCTotal'][0]->C.'</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasCTotal'][0]->D.'</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasCTotal'][0]->E.'</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasCTotal'][0]->F.'</td>
                            <td style="background-color:#;color:"><b>'.($dados['faixasCTotal'][0]->A+$dados['faixasCTotal'][0]->B+$dados['faixasCTotal'][0]->C
                            +$dados['faixasCTotal'][0]->D+$dados['faixasCTotal'][0]->E+$dados['faixasCTotal'][0]->F).'</td>
                            <td style="background-color:#;color:"><b>100.00%</td>

                    ';
                
                
            ?>

    </tbody>
  </table>
  </form>
  <!--
  
  <BR>
  
     <table id="minhaTabçççela" class="table table-responsive table-sm table-bordered table-hover dataTable">
    <thead>
      <tr class="bg-secondary text-center py-0 align-middle">
        <th style=" background-color:#;color:white;width:200px" colspan="17"><center>[REPARO FFA <?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | '.$_GET['tecnologia'];
          } 
        ?>
        ] </th>
        </tr>
      <tr class="bg-light text-center py-0 align-middle">
          <th style=" background-color:#;color:black;width:220px"><center>Coordenador</th>
        <th style=" background-color:#;color:black;width:220px"><center>Área</th>
        <th style=" background-color:#;color:black;width:140px"><center>20H</th>
        <th style=" background-color:#;color:black;width:140px"><center>24H</th>
        <th style=" background-color:#;color:black;width:140px"><center>48H</th>
        <th style=" background-color:#;color:black;width:140px"><center>72H</th>
        <th style=" background-color:#;color:black;width:140px"><center>96H</th>
        <th style=" background-color:#;color:black;width:140px"><center>MAIOR 96H</th>
        <th style=" background-color:#;color:black;width:140px"><center>TOTAL</th>
        
        <th style=" background-color:#;color:black;width:140px"><center>% Resp. Coord.</th>
      </tr>
    </thead>
    <tbody>
          
            <?php 
            //dd($dados['faixas']);
            //    $ffa = $dados['visaoFFA'][0];
                foreach ($dados['faixasR'] as $gr) {
                    if ($gr->A > 0) {
                            $colorA = "";
                            $colorfA = "";
                        } else {
                            $colorA = "";
                            $colorfA = "#dbdbdb";
                        }
                        if ($gr->B > 0) {
                            $colorB = "";
                            $colorfB = "";
                        } else {
                            $colorB = "";
                            $colorfB = "#dbdbdb";
                        }
                        if ($gr->C > 0) {
                            $colorC = "";
                            $colorfC = "";
                        } else {
                            $colorfC = "#dbdbdb";
                            $colorC = "";
                        }
                        if ($gr->D > 0) {
                            $colorD = "";
                            $colorfD = "";
                        } else {
                            $colorfD = "#dbdbdb";
                            $colorD = "";
                        }
                        if ($gr->E > 0) {
                            $colorfE = "";
                            $colorE = "";
                        } else {
                            $colorfE = "";
                            $colorE = "";
                        }
                        if ($gr->F > 0) {
                            $colorfF = "";
                            $colorF = "";
                        } else {
                            $colorfF = "#dbdbdb";
                            $colorF = "";
                        }
                        
                    
                    echo '<tr class="bg- text-center py-0 align-middle">
                            <td>'.ucwords(strtolower($gr->COORDENADOR)).'</td>
                            <td style="background-color:#;color:">'.$gr->SUPERVISAO.'</td>
                            <td style="background-color:'.$colorA.';color:'.$colorfA.'">'.$gr->A.'</td>
                            <td style="background-color:'.$colorB.';color:'.$colorfB.'">'.$gr->B.'</td>
                            <td style="background-color:'.$colorC.';color:'.$colorfC.'">'.$gr->C.'</td>
                            <td style="background-color:'.$colorD.';color:'.$colorfD.'">'.$gr->D.'</td>
                            <td style="background-color:'.$colorE.';color:'.$colorfE.'">'.$gr->E.'</td>
                            <td style="background-color:'.$colorF.';color:'.$colorfF.'">'.$gr->F.'</td>
                            <td style="background-color:;color:">'.($gr->A+$gr->B+$gr->C+$gr->D+$gr->E+$gr->F).'</td>
                            
                              <td style="background-color:;color:">'.round((($gr->A+$gr->B+$gr->C+$gr->D+$gr->E+$gr->F)/($dados['faixasRTotal'][0]->A+$dados['faixasRTotal'][0]->B+$dados['faixasRTotal'][0]->C
                            +$dados['faixasRTotal'][0]->D+$dados['faixasRTotal'][0]->E+$dados['faixasRTotal'][0]->F)*100),2).'%</td>
                            

                    ';
                }
                
                echo '<tr class="bg-light text-center py-0 align-middle">
                            <td colspan="2" style="background-color:#;color:"><b>TOTAL</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasRTotal'][0]->A.'</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasRTotal'][0]->B.'</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasRTotal'][0]->C.'</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasRTotal'][0]->D.'</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasRTotal'][0]->E.'</td>
                            <td style="background-color:#;color:"><b>'.$dados['faixasRTotal'][0]->F.'</td>
                            <td style="background-color:#;color:"><b>'.($dados['faixasRTotal'][0]->A+$dados['faixasRTotal'][0]->B+$dados['faixasRTotal'][0]->C
                            +$dados['faixasRTotal'][0]->D+$dados['faixasRTotal'][0]->E+$dados['faixasRTotal'][0]->F).'</td>
                            <td style="background-color:#;color:"><b>100.00%</td>
                            
                            
                            

                    ';
                
                
            ?>

    </tbody>
  </table>
  </form>
  
  -->
  <BR><BR>
  
  
 
              <!-- /.box-body -->
              </div>
          <!-- /.box -->
        </div>
        

          <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
      <h3>[Estratificação<?php 
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

                <p><u><b><h5><center>Concentração por MSAN [TOP 10]</center></h5></u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                    
                      <th>MSAN</th>
                      <th>TTs</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingMsan'] as $tts) {
                        echo 
                          '<tr>
                          
					
                            <td><center>'.$tts->MSAN.'</td>
                            <td align="center"><span class="badge bg-danger">'.$tts->QTD.'</span></td>
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

                <p><u><b><h5><center>Entrada por Horário</center></h5></u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                   
                      <th>Faixa/Hora</th>
                      <th>TTs</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingHora'] as $tts) {
                        echo 
                          '<tr>
                 
                            <td><CENTER>'.$tts->HORA_CRIACAO.'H</td>
                            <td align="center"><span class="badge bg-warning">'.$tts->QTD.'</span></td>
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

                <p><u><b><h5><center>Abertas [Top 10]</center></h5></u></b></p>
               <table class="table">
                  <thead align="center">
                    <tr>
                 
                      <th>Área</th>
          
                      <th>TTs</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $num = 1;
                      foreach ($dados['rankingArea'] as $tts) {
                        echo 
                          '<tr>
                           
                            <td><CENTER>'.$tts->AREA.'</td>
                  
                            <td align="center"><span class="badge bg-danger">'.$tts->QTD.'</span></td>
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
