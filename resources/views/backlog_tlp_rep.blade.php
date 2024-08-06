@extends('adminlte::page')

@section('title', 'Reparo')

@section('content_header')
 <!--  <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop
<style>
  .google-data-studio {
        position: relative;
        padding-bottom: 56.25%;
        padding-top: 30px; height: 0; overflow: hidden;
        }
        
        .google-data-studio iframe,
        .google-data-studio object,
        .google-data-studio embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        }
</style>
@section('content')
<?php 

    if (!isset($dados['AtualizacaoMontada'])) {
        dd('Em atualização!');
    
    };?>
<div class="callout callout-secondary">
    <a class="btn btn-light" data-toggle="in" href="#collapseExample4" role="button" aria-expanded="true" aria-controls="collapseExample4">
    <i class="fa fa-minus-square" aria-hidden="true"></i> Abrir filtro
  </a><p>
 <b>Fonte de dados:</b> TOA | <b>Última atualização: </b> <?php date_default_timezone_set('America/Sao_Paulo');
  echo date('d/m/Y H:i:s', strtotime($dados['AtualizacaoMontada'][0]->data_atualizacao));?>
  <IMG SRC="https://preloaders.evidweb.com/images/preloaders/ajax-loading-c7.gif" width="18px" heigh="18px">
</p> <!--
<div class="in" id="collapseExample4">
<form action="./backlog_tlp_rep" method="get">
     <div class="row">
               <!-- <div class="form-group col-md-2">
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
                </div>  -->
                
               <!--  <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Gerência:</label>
                  <select class="form-control form-control-md" name="gerencia">
                      <option value="">TODOS</option>
                <?php 
                    foreach ($dados['gerencia'] as $ger) {
                        echo '<option value="'.$ger->gerencia.'">'.$ger->gerencia.'</option>';    
                    }
                    ?>
                  </select>
                </div>
                
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Tipo Atividade:</label>
                  <select class="form-control form-control-md" name="atividade">
                       <option value="">TODOS</option>
                <?php 
                    foreach ($dados['atividade'] as $ger) {
                        echo '<option value="'.$ger->atividade.'">'.$ger->atividade.'</option>';    
                    }
                    ?>
                  </select>
                </div>
                <!--<div class="form-group col-md-2">
                  <label for="exampleInputEmail1">GROSS:</label>
                  <select class="form-control form-control-md" name="gross">
                   <?php if(isset($_GET['gross'])) {
                         
                    echo '<option value="'.$_GET['gross'].'">'.$_GET['gross'].'| Seleção atual</option>';
                    };?>
                    <option value="3">TODOS</option>
                    <option value="0">NÃO</option>
                    <option value="1">SIM</option>
                  </select>
                </div>
          
                
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Tipo de Backlog:</label>
                  <select class="form-control form-control-md" name="tipo_backlog">
                       <option value="">TODOS</option>
                   <?php 
                    foreach ($dados['tipo_backlog'] as $ger) {
                        echo '<option value="'.$ger->tipo_backlog.'">'.$ger->tipo_backlog.'</option>';    
                    }
                    ?>
                  </select>
                </div>
                -->
           <!--      <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-secondary" value="Filtrar">
              </div>
</form>
              <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
              </div> 
</div>
</div>
</div>



    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
<div class="row">
<div class="col-lg-3 col-6">

<div class="small-box bg-orange">
<div class="inner">
<h3 style="color:white"> Reparos: {{ $dados['backlog_total_tlp'][0]->total }}</h3>
<p style="color:white">Distrito Federal</p>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>

</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-orange">
<div class="inner">
<h3 style="color:white"> Reparos: {{ $dados['backlog_total_tlg'][0]->total }}</h3>
<p style="color:white">Goiás</p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>

</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-orange">
<div class="inner">
<h3 style="color:white">  Reparos: {{ $dados['backlog_total_tls'][0]->total }}</h3>
<p style="color:white">São Paulo</p>
</div>
<div class="icon">
<i class="ion ion-person-add"></i>
</div>

</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-orange">
<div class="inner">
<h3 style="color:white"> 
Reparos: {{ ($dados['backlog_total_tls'][0]->total+$dados['backlog_total_tlg'][0]->total+$dados['backlog_total_tlp'][0]->total) }}</h3>
<p style="color:white">Total</p>
</div>
<div class="icon">
<i class="ion ion-pie-graph"></i>
</div>

</div>
</div>

</div>

 

    <div class="row">
      <div class="col-12">
        <div class="card">
       


 <table id="minhaTabçççela" class="table table-responsive table-sm table-bordered table-hover dataTable">
    <thead>
      <tr class="bg-light text- py-0 align-middle">
        <th style=" background-color:#D25600;color:white;width:200px" colspan="8"><center>[REPARO => GERÊNCIA<?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | TECNOLOGIA: '.$_GET['tecnologia'].' | GERENCIA: '.$_GET['gerencia'];
          } 
        ?>
        ] </th>
        </tr>
         
      <tr class="bg-light text-center py-0 align-middle">
          <th style=" background-color:#D25600;color:white;width:260px"><center>Gerência</th>
        <th style=" background-color:#D25600;color:white;width:260px"><center>Prefixo</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>00-24Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>24-48Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>48-72Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>72-96Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>> 96Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px"><center>Total</th>
        </tr>
    </thead>
    <tbody>
          
            <?php 
       
                $total = $dados['backlog_total'][0];
                foreach ($dados['backlog_gerencia'] as $gr) {
                   
                    $linhas = count(array($gr->gerencia));
                    
                    echo '<tr class="bg- text-center py-0 align-middle">
                            <td>'.$gr->gerencia1.'</td>
                            <td>'.$gr->gerencia.'</td>
                            <td>'.$gr->b0_a_3_dias.'</td>
                            <td>'.$gr->b4_a_5_dias.'</td>
                            <td>'.$gr->b6_a_10_dias.'</td>
                            <td>'.$gr->b11_a_20_dias.'</td>
                            <td>'.$gr->acima_de_20_dias.'</td>
                            <td>'.$gr->total.'</td>
                    ';
                }
                
                    echo '<tr class="bg-light text-center py-0 align-middle">
                            <td style=" background-color:#D25600;color:white;width:260px" colspan="2"><b>TOTAL</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b0_a_3_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b4_a_5_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b6_a_10_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b11_a_20_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->acima_de_20_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->total.'</td>

                            </tr>
                    ';
            ?>

    </tbody>
  </table>



              <!-- /.box-body -->
            <!--   </div>
          <!-- /.box -->
      <!--   </div>
        </div>



<br>
    <div class="row">
      <div class="col-12">
        <div class="card">
       


 <table id="minhaTabçççela" class="table table-responsive table-sm table-bordered table-hover dataTable">
    <thead>
      <tr class="bg-light text- py-0 align-middle">
        <th style=" background-color:#D25600;color:white;width:200px" colspan="8"><center>[REPARO => RESPONSABILIDADE<?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | TECNOLOGIA: '.$_GET['tecnologia'].' | GERENCIA: '.$_GET['gerencia'];
          } 
        ?>
        ] </th>
        </tr>
         
      <tr class="bg-light text-center py-0 align-middle">
          <th style=" background-color:#D25600;color:white;width:260px"><center>Responsabilidade 1</th>
        <th style=" background-color:#D25600;color:white;width:260px"><center>Responsabilidade 2</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>00-24Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>24-48Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>48-72Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>72-96Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>> 96Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px"><center>Total</th>
        </tr>
    </thead>
    <tbody>
          
            <?php 
       
                $total = $dados['backlog_total'][0];
                foreach ($dados['backlog_gerencia2'] as $gr) {
                   
                    $linhas = count(array($gr->gerencia));
                    
                    echo '<tr class="bg- text-center py-0 align-middle">
                            <td>'.$gr->gerencia1.'</td>
                            <td>'.$gr->gerencia.'</td>
                            <td>'.$gr->b0_a_3_dias.'</td>
                            <td>'.$gr->b4_a_5_dias.'</td>
                            <td>'.$gr->b6_a_10_dias.'</td>
                            <td>'.$gr->b11_a_20_dias.'</td>
                            <td>'.$gr->acima_de_20_dias.'</td>
                            <td>'.$gr->total.'</td>
                    ';
                }
                
                    echo '<tr class="bg-light text-center py-0 align-middle">
                            <td style=" background-color:#D25600;color:white;width:260px" colspan="2"><b>TOTAL</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b0_a_3_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b4_a_5_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b6_a_10_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b11_a_20_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->acima_de_20_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->total.'</td>

                            </tr>
                    ';
            ?>

    </tbody>
  </table>



              <!-- /.box-body -->
           <!--    </div>
          <!-- /.box -->
      <!--   </div>
        </div>
<!--
   <br>
    <div class="row">
      <div class="col-12">
        <div class="card">
 


 <table id="minhaTabçççela" class="table table-responsive table-sm table-bordered table-hover dataTable">
    <thead>
      <tr class="bg-light text- py-0 align-middle">
        <th style=" background-color:#D25600;color:white;width:200px" colspan="7"><center>[REPARO => ESTEIRA<?php 
          if (!empty($_GET['tecnologia'])) {
            echo ' | TECNOLOGIA: '.$_GET['tecnologia'].' | FILIAL: '.$_GET['gerencia'];
          } 
        ?>
        ] </th>
        </tr>
         
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#D25600;color:white;width:260px"><center>Esteira</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>00-24Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>24-48Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>48-72Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>72-96Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px" title=""><center>> 96Hrs</th>
        <th style=" background-color:#D25600;color:white;width:260px"><center>Total</th>
        </tr>
    </thead>
    <tbody>
          
            <?php 
       
                $total = $dados['backlog_total'][0];
                foreach ($dados['backlog_esteira'] as $gr) {
                   
                    $linhas = count(array($gr->gerencia));
                    
                    echo '<tr class="bg- text-center py-0 align-middle">
                            <td>'.ucfirst($gr->gerencia).'</td>
                            <td>'.$gr->b0_a_3_dias.'</td>
                            <td>'.$gr->b4_a_5_dias.'</td>
                            <td>'.$gr->b6_a_10_dias.'</td>
                            <td>'.$gr->b11_a_20_dias.'</td>
                            <td>'.$gr->acima_de_20_dias.'</td>
                            <td>'.$gr->total.'</td>
                    ';
                }
                
                    echo '<tr class="bg-light text-center py-0 align-middle">
                            <td style=" background-color:#D25600;color:white;width:260px" colspan="1"><b>TOTAL</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b0_a_3_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b4_a_5_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b6_a_10_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->b11_a_20_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->acima_de_20_dias.'</td>
                            <td style=" background-color:#D25600;color:white;width:260px"><b>'.$total->total.'</td>

                            </tr>
                    ';
            ?>

    </tbody>
  </table>
  </form>
 




  </form>



              <!-- /.box-body -->
              </div>
          <!-- /.box 
        </div>
        </div>
        </div>

      
      
    <div class="container mt-5">
   <div class="d-flex justify-content-center row">
      <div class="col-md-10">
         <div class="rounded">
            <div class="table-responsive table-borderless">
               <table class="table">
                  <thead>
                     <tr>
                        <th class="text-center">Região</th>
                        <th class="text-center">Prefixo</th>
                        <th class="text-center"><center>00-24Hrs</th>
                        <th class="text-center"><center>24-48Hrs</th>
                        <th class="text-center"><center>48-72Hrs</th>
                        <th class="text-center"><center>72-96Hrs</th>
                        <th class="text-center"><center>> 96Hrs</th>
                        <th class="text-center">Total</th>
                     </tr>
                  </thead>
                  <tbody class="table-body">
                      
                       <?php 
                        $numero = 1;
                            $total = $dados['backlog_total'][0];
                            foreach ($dados['backlog_gerencia'] as $gr) {
                               
                                $linhas = count(array($gr->gerencia));
                                
                                echo '<tr class="cell-1" data-toggle="collapse" data-target="#demo-'.$gr->gerencia.'">
                                        <td>'.$gr->gerencia1.'</td>
                                        <td>'.$gr->gerencia.'</td>
                                        <td>'.$gr->b0_a_3_dias.'</td>
                                        <td>'.$gr->b4_a_5_dias.'</td>
                                        <td>'.$gr->b6_a_10_dias.'</td>
                                        <td>'.$gr->b11_a_20_dias.'</td>
                                        <td>'.$gr->acima_de_20_dias.'</td>
                                        <td>'.$gr->total.'</td>
                                ';
                            }
                            echo '
                                    <tr id="demo" class="collapse cell-1 row-child">
                                        <td class="text-center" colspan="1"><i class="fa fa-angle-up"></i></td>
                                        <td>'.$gr->gerencia1.'</td>
                                        <td>'.$gr->gerencia.'</td>
                                        <td>'.$gr->b0_a_3_dias.'</td>
                                        <td>'.$gr->b4_a_5_dias.'</td>
                                        <td>'.$gr->b6_a_10_dias.'</td>
                                        <td>'.$gr->b11_a_20_dias.'</td>
                                        <td>'.$gr->acima_de_20_dias.'</td>
                                        <td>'.$gr->total.'</td>
                                    </tr>
                                    
                                    <tr class="cell-1" data-toggle="collapse" data-target="#demo-'.$gr->gerencia.'">
                                        <td class="text-center">2</td>
                                        <td>#SO-13488</td>
                                        <td>Tinder Steel</td>
                                        <td><span class="badge badge-success">Fullfilled</span></td>
                                        <td>$3664.00</td>
                                        <td>Yesterday</td>
                                        <td class="table-elipse" data-toggle="collapse" data-target="#demo"><i class="fa fa-ellipsis-h text-black-50"></i></td>
                                     </tr>
                                     <tr id="demo-'.$gr->gerencia.'" class="collapse cell-1 row-child">
                                        <td class="text-center" colspan="1"><i class="fa fa-angle-up"></i></td>
                                        <td colspan="1">Product&nbsp;</td>
                                        <td colspan="3">iphone SX with ratina display</td>
                                        <td colspan="1">QTY</td>
                                        <td colspan="2">2</td>
                                     </tr>
                                                    
                                    
                                    ';
                                    
                        ?>

                      
                      
                   
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div> 
     
     
     
     
     -->
     
     
     
      <div class="google-data-studio">
            <iframe width="1600" height="1500" src="https://datastudio.google.com/embed/reporting/7a0b984b-d24f-4882-8401-eb683d87179b/page/3HG9C" frameborder="0" style="border:0" allowfullscreen></iframe>
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
