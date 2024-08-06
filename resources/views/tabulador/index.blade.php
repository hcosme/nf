@extends('adminlte::page')

@section('title', 'Tabulador')

@section('content_header')
<meta http-equiv="refresh" content="5">
<!--   <h1 class="m-0 text-dark">Report Instalação</h1> -->
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

#botao {
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        margin: 0 auto; 
    
}

@keyframes blinker {  
  50% { opacity: 0; }
}

</style>

    <div class="callout callout-secondary">
  <p>
  <p>
 <b>Fonte de dados:</b> TOA | <b>Última atualização: </b> 
 <?php 
   //dd($dados);
    date_default_timezone_set('America/Sao_Paulo');
    if ($dados['dadosTbl'] != '' ) {
        echo date('d/m/Y H:i:s', strtotime($dados['dadosTbl'][0]->atualizacao));    
    } else {
        echo 'Em atualização.';
    }
    
 ?>

   <form action="./tabulador-index" method="get">
<div class="row">
<? //dd($_GET['tipo']);?>
     <div class="form-group col-md-5">
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1"> Tipo:</label>
                  <select class="form-control form-control-md" name="tipo" required>
                    <?php if(isset($_GET['tipo'])) {
                        echo '<option value="'.$_GET['tipo'].'">'.$_GET['tipo'].'</option>';
                    } else {
                        echo '<option selected disabled value="">Selecione</option>';    
                    };?>
                  <option value="GROSS">GROSS</option>
                  <option value="INSTALACAO">INSTALACAO</option>
                  <option value="MUDANCA">MUDANCA</option>
                  <option value="REPARO">REPARO</option>
                  <option value="TROCA TECNOLOGIA">TROCA TECNOLOGIA</option>
                    
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-success" value="Buscar">
              </div>
</form>               
                </div>
                
</div>          

</div>          


   <div class="callout callout-secondary">
  <p>
<div class="row">
    
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-">
              <div class="inner">
                <h3 style="color:"><?php echo $dados['totalClientes'][0]->qtd;?></h3>

                <p>Total Clientes</p>
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
            <div class="small-box bg-">
              <div class="inner">
                <h3 style="color:"><?php echo $dados['emLigacao'][0]->qtd;?></h3>

                <p>Em ligação</p>
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
            <div class="small-box bg-">
              <div class="inner">
                 <h3 style="color:"><?php echo $dados['pendentes'][0]->qtd;?></h3>

                <p>Pendentes</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-">
              <div class="inner">
                  <h3><?php echo $dados['realizadosHoje'][0]->qtd;?></h3>

                <p>Ag. Realizados (Hoje)</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-">
              <div class="inner">
                 <h3 style="color:"><?php echo $dados['realizadosParaHoje'][0]->qtd;?></h3>
                <p>Ag. para hoje</p>
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
            <div class="small-box bg-">
              <div class="inner">
              <h3 style="color:">0</h3>
               
                <p>Total Agendamentos</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                </div>
        
                </div>
        



    <div class="callout callout-secondary">
  <p>
<center><?php 

   // dd($dados['dados']);

    if(isset($_GET['tipo']) && !empty($dados['dados'])) {

                echo '<a href="./tabulador-edit?id='.$dados['dados'][0]->id.'">
                        <button id="botao"  class="form-control form-control-lg btn btn-success"> <i class="fas fa-telephone"></i> Realizar Agendamento</button> </a>';
                    } else {
                    echo '
                <button id="botao" onclick="requestFullScreen()" class="form-control form-control-lg btn btn-secondary"> <i class="fas fa-telephone"></i> Realize o filtro da atividade para iniciar.</button> </a>
                      ';      }   
                      
                    ?>
                    
    </form>               
                </div></center>
                
</div>

<!--
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
                
    <div class="box-body table-responsive no-padding">


        <table id="" class="table table-striped table-sm table-bordered dataTable">
            <thead>
                <tr class="bg-light text-center py-0 align-middle">
                    <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[CONTROLE DE AGENDAMENTOS] </th> 
                </tr>
                <tr class="bg-light text- py-0 align-middle">
                    <th style=" background-color:#;color:black;width:20px"><center>Nº</th>
                    <th style=" background-color:#;color:black;width:160px"><center>Técnico</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Ordem</th>
                    <th style=" background-color:#;color:black;width:90px"><center>Atividades</th>
                    <th style=" background-color:#;color:black;width:160px"><center>Cliente</th>
                    <th style=" background-color:#;color:black;width:80px"><center>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $numero = 1;
                date_default_timezone_set('America/Sao_Paulo');
                $data = date('Y-m-d H:i:s');
            
                foreach ($dados['dadosTbl'] as $gr) {
                    
                    if ($gr->SUCESSO_CONTATO == '') {
                        $status = 'AGUARDANDO CONTATO';
                    } 
                    if ($gr->SUCESSO_CONTATO == 'S') {
                        $status = 'CONTATO EFETUADO';
                    }
                    if ($gr->SUCESSO_CONTATO == 'N') {
                        $status = 'CONTATO SEM SUCESSO';
                    }
                    
                    
                    echo '<tr class="bg- text- py-0 align-middle">
                            <td><a class="btn btn- btn-xs" href="./tabulador-read?id='.$gr->id.'">'.$numero++.'</td>
                            <td><a class="btn btn- btn-xs" href="./tabulador-read?id='.$gr->id.'">'.$gr->PROVEDOR.'</td>
                            <td><a class="btn btn- btn-xs" href="./tabulador-read?id='.$gr->id.'">'.$gr->N_ORDEM.'</td>
                            <td><a class="btn btn- btn-xs" href="./tabulador-read?id='.$gr->id.'">'.$gr->ATIVIDADE.'</td>
                            <td><a class="btn btn- btn-xs" href="./tabulador-read?id='.$gr->id.'">'.$gr->CLIENTE.'</td>
                              <td><a class="btn btn- btn-xs" href="./tabulador-read?id='.$gr->id.'">'.$status.'</td>
                          
                    ';
                }
            ?>

    </tbody>
  </table>
  </form>


              <!-- /.box-body -->
              </div>
          <!-- /.box 
        </div>
      </div>-->
      </div>
@section('js')
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

    function requestFullScreen() {

  var el = document.body;

  // Supports most browsers and their versions.
  var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen 
  || el.mozRequestFullScreen || el.msRequestFullScreen;

  if (requestMethod) {

    // Native full screen.
    requestMethod.call(el);

  } else if (typeof window.ActiveXObject !== "undefined") {

    // Older IE.
    var wscript = new ActiveXObject("WScript.Shell");

    if (wscript !== null) {
      wscript.SendKeys("{F11}");
    }
  }
}


</script>
@stop

@stop
