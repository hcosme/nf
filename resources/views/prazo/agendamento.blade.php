@extends('adminlte::page')
@section('title', 'Fila Atendimento')
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
      <b>Fonte de dados:</b> BÚSSOLA | <b>Última atualização: </b> 
      <?php 
         //dd($dados);
         date_default_timezone_set('America/Sao_Paulo');
         if (isset($dados['AtualizacaoMontada'][0])) {
             echo date('d/m/Y H:i:s', strtotime($dados['AtualizacaoMontada'][0]->data_atualizacao));    
         } else {
             echo '';
         }
         
         ?>
      <IMG SRC="https://preloaders.evidweb.com/images/preloaders/ajax-loading-c7.gif" width="18px" heigh="18px">
   </p>
   <div class="in" id="collapseExample4">
      <form action="./prazo_agendamento" method="get">
         <div class="row">
            <div class="form-group col-md-4">
               <label for="exampleInputEmail1">Filial:</label>
               <select class="form-control form-control-md" name="filial">
                  <?php if(isset($_GET['filial'])) {
                     echo '<option value="'.$_GET['filial'].'">'.$_GET['filial'].'</option>';
                     };?>
                  <option value="TODOS">TODOS</option>
                  <option value="SAO PAULO OESTE">SAO PAULO OESTE</option>
                  <option value="GOIAS">GOIAS</option>
                  <option value="DISTRITO FEDERAL">DISTRITO FEDERAL</option>
               </select>
            </div>
            <div class="form-group col-md-2">
               <label for="exampleInputEmail1">Time Slot:</label>
               <select class="form-control form-control-md" name="time_slot">
                  <?php if(isset($_GET['time_slot'])) {
                     echo '<option value="'.$_GET['time_slot'].'">'.$_GET['time_slot'].'</option>';
                     };?>
                  <option value="TODOS">TODOS</option>
                  <?php
                     foreach ($dados['time_slot'] as $ger) {
                         echo '
                             <option value="'.$ger->nome.'">'.$ger->nome.'</option>
                             ';
                     }
                     
                     
                     ?>
               </select>
            </div>
            <div class="form-group col-md-2">
               <label for="exampleInputEmail1">Localidade:</label>
               <select class="form-control form-control-md" name="localidade">
                  <?php if(isset($_GET['localidade'])) {
                     echo '<option value="'.$_GET['localidade'].'">'.$_GET['localidade'].'</option>';
                     };?>
                  <option value="TODOS">TODOS</option>
                  <?php
                     foreach ($dados['localidade'] as $ger) {
                         echo '
                             <option value="'.$ger->nome.'">'.$ger->nome.'</option>
                             ';
                     }
                     
                     
                     ?>
               </select>
            </div>
            <div class="form-group col-md-2">
               <label for="exampleInputEmail1">Supervisor:</label>
               <select class="form-control form-control-md" name="supervisor">
                  <?php if(isset($_GET['supervisor'])) {
                     echo '<option value="'.$_GET['supervisor'].'">'.$_GET['supervisor'].'</option>';
                     };?>
                  <option value="TODOS">TODOS</option>
                  <?php
                     foreach ($dados['supervisor'] as $ger) {
                         echo '
                             <option value="'.$ger->nome.'">'.$ger->nome.'</option>
                             ';
                     }
                     
                     
                     ?>
               </select>
            </div>
            <div class="form-group col-md-2">
               <label for="exampleInputEmail1">Controlador:</label>
               <select class="form-control form-control-md" name="controlador">
                  <?php if(isset($_GET['controlador'])) {
                     echo '<option value="'.$_GET['controlador'].'">'.$_GET['controlador'].'</option>';
                     };?>
                  <option value="TODOS">TODOS</option>
                  <?php
                     foreach ($dados['controlador'] as $ger) {
                         echo '
                             <option value="'.$ger->nome.'">'.$ger->nome.'</option>
                             ';
                     }
                     
                     
                     ?>
               </select>
            </div>
            <div class="form-group col-md-2">
               <label for="exampleInputEmail1"><b style="color: white">.</b></label>
               <input  type="submit" class="form-control form-control-md btn btn-success" value="Filtrar">
            </div>
      </form>
      </div>
   </div>
</div>
<div class="callout callout-secondary">
   <p>
   <div class="row">
      <div class="col-lg-2 col-2">
         <!-- small box -->
         <div class="small-box bg-">
            <div class="inner">
               <h3 style="color:">{{ $dados['TLP'][0]->qtd }} </h3>
               <p>Distrito Federal</p>
            </div>
            <div class="icon">
               <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-2">
         <!-- small box -->
         <div class="small-box bg-">
            <div class="inner">
               <h3 style="color:">{{ $dados['TLG'][0]->qtd }}</h3>
               <p>Goiás</p>
            </div>
            <div class="icon">
               <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
      <div class="col-lg-3 col-2">
         <!-- small box -->
         <div class="small-box bg-">
            <div class="inner">
               <h3 style="color:">{{ $dados['TLI'][0]->qtd }}</h3>
               <p>São Paulo Interior</p>
            </div>
            <div class="icon">
               <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
      <div class="col-lg-3 col-2">
         <!-- small box -->
         <div class="small-box bg-">
            <div class="inner">
               <h3 style="color:">{{ $dados['TLS'][0]->qtd }}</h3>
               <p>São Paulo Oeste</p>
            </div>
            <div class="icon">
               <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
      <div class="col-lg-2 col-2">
         <!-- small box -->
         <div class="small-box bg-">
            <div class="inner">
               <h3 style="color:">{{ ($dados['TLP'][0]->qtd+$dados['TLI'][0]->qtd+$dados['TLG'][0]->qtd+$dados['TLS'][0]->qtd) }} </h3>
               <p>Total</p>
            </div>
            <div class="icon">
               <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
   </div>
</div>
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
   <div class="box-body table-responsive no-padding">
      <table id="" class="table table-striped table-sm table-bordered dataTable">
         <thead>
            <tr class="bg-light text-center py-0 align-middle">
               <th style=" background-color:#CC5500;color:white;width:200px" colspan="19">
                  <center>
                  [FILA DE ATENDIMENTO - SLA] 
               </th>
            </tr>
            <tr class="bg-light text-center py-0 align-middle">
               <th style=" background-color:#CC5500;color:white;width:160px">
                  <center>
                  Faixa de Vencimento
               </th>
               <th style=" background-color:#CC5500;color:white;width:160px">
                  <center>
                  São Paulo Oeste
               </th>
               <th style=" background-color:#CC5500;color:white;width:160px">
                  <center>
                  Goias
               </th>
               <th style=" background-color:#CC5500;color:white;width:160px">
                  <center>
                  Distrito Federal
               </th>
               <th style=" background-color:#CC5500;color:white;width:160px">
                  <center>
                  Total
               </th>
            </tr>
         </thead>
         <tbody>
            <tr class="bg- text-center py-0 align-middle">
               <td>Menos de 01 hora</td>
               <td>{{ $dados['TLS1'][0]->qtd }}</td>
               <td>{{ $dados['TLG1'][0]->qtd }}</td>
               <td>{{ $dados['TLP1'][0]->qtd }}</td>
               <td>{{ ($dados['TLS1'][0]->qtd +  $dados['TLG1'][0]->qtd + $dados['TLP1'][0]->qtd) }}</td>
            </tr>
            <tr class="bg- text-center py-0 align-middle">
               <td>Menos de 02 horas</td>
               <td>{{ $dados['TLS2'][0]->qtd }}</td>
               <td>{{ $dados['TLG2'][0]->qtd }}</td>
               <td>{{ $dados['TLP2'][0]->qtd }}</td>
               <td>{{ ($dados['TLS2'][0]->qtd +  $dados['TLG2'][0]->qtd + $dados['TLP2'][0]->qtd) }}</td>
            </tr>
            <tr class="bg- text-center py-0 align-middle">
               <td>Menos de 03 horas</td>
               <td>{{ $dados['TLS3'][0]->qtd }}</td>
               <td>{{ $dados['TLG3'][0]->qtd }}</td>
               <td>{{ $dados['TLP3'][0]->qtd }}</td>
               <td>{{ ($dados['TLS3'][0]->qtd +  $dados['TLG3'][0]->qtd + $dados['TLP3'][0]->qtd) }}</td>
            </tr>
            <tr class="bg- text-center py-0 align-middle">
               <td>Menos de 04 horas</td>
               <td>{{ $dados['TLS4'][0]->qtd }}</td>
               <td>{{ $dados['TLG4'][0]->qtd }}</td>
               <td>{{ $dados['TLP4'][0]->qtd }}</td>
               <td>{{ ($dados['TLS4'][0]->qtd +  $dados['TLG4'][0]->qtd + $dados['TLP4'][0]->qtd) }}</td>
            </tr>
            <tr class="bg- text-center py-0 align-middle">
               <td>Menos de 05 horas</td>
               <td>{{ $dados['TLS5'][0]->qtd }}</td>
               <td>{{ $dados['TLG5'][0]->qtd }}</td>
               <td>{{ $dados['TLP5'][0]->qtd }}</td>
               <td>{{ ($dados['TLS5'][0]->qtd +  $dados['TLG5'][0]->qtd + $dados['TLP5'][0]->qtd) }}</td>
            </tr>
         </tbody>
      </table>
      </form>
      <!-- /.box-body -->
   </div>
   <!-- /.box -->
</div>
<div class="row">
<div class="col-12">
   <div class="card">
      <div class="card-body">
         <div class="box-body table-responsive no-padding">
            <table id="minhaTabela2" class="table table-striped table-sm table-bordered dataTable">
               <thead>
                  <tr class="bg-light text-center py-0 align-middle">
                     <th style=" background-color:#CC5500;color:white;width:200px" colspan="19">
                        <center>
                        [FILA DE ATENDIMENTO - SLA] 
                     </th>
                  </tr>
                  <tr class="bg-light text-center py-0 align-middle">
                     <th style=" background-color:#CC5500;color:white;width:160px">
                        <center>
                        Fim SLA
                     </th>
                     <th style=" background-color:#CC5500;color:white;width:360px">
                        <center>
                        Tempo
                     </th>
                     <th style=" background-color:#CC5500;color:white;width:160px">
                        <center>
                        Gerência
                     </th>
                     <th style=" background-color:#CC5500;color:white;width:160px">
                        <center>
                        Localidade
                     </th>
                     <th style=" background-color:#CC5500;color:white;width:360px">
                        <center>
                        Supervisor
                     </th>
                     <th style=" background-color:#CC5500;color:white;width:360px">
                        <center>
                        Técnico
                     </th>
                     <th style=" background-color:#CC5500;color:white;width:360px">
                        <center>
                        Controlador
                     </th>
                     <th style=" background-color:#CC5500;color:white;width:360px">
                        <center>
                        Tipo de Atividade
                     </th>
                    
                     <th style="background-color:#CC5500;color:white;width:120px" title="">
                        <center>
                        Estado
                     </th>
                     <th style="background-color:#CC5500;color:white;width:70px" title="">
                        <center>
                        Número da Ordem
                     </th>
                      <th style=" background-color:#CC5500;color:white;width:360px">
                        <center>
                        Time Slot
                     </th>
                     <th style=" background-color:#CC5500;color:white;width:360px">
                        <center>
                        Aging
                     </th>
                     <th style=" background-color:#CC5500;color:white;width:360px">
                        <center>
                        Atendimento
                     </th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     //dd(date('Y-m-d H:i:s', strtotime($dados['informacao'][5]->prazo_atendimento)));
                         foreach ($dados['informacao'] as $gr) {
                             $data = date('Y-m-d H:i:s', strtotime(substr($gr->tempo_ate_o_vencimento,-5)));
                             
                             $dataAtual = date('Y-m-d H:i:s');
                             $start  = new \DateTime($data);
                             $end    = new \DateTime($dataAtual);
                         
                             $interval = $start->diff( $end );
                         
                             $hora = implode( [
                                 $interval->h
                             ]);
                             
                             if ($hora == 0) {
                                 $tempo = 'Menos de 01 hora';
                             } 
                             if ($hora == 1) {
                                 $tempo = 'Menos de 02 horas';
                             }
                             if ($hora == 2) {
                                 $tempo = 'Menos de 03 horas';
                             }
                             if ($hora == 3) {
                                 $tempo = 'Menos de 04 horas';
                             }
                             if ($hora == 4) {
                                 $tempo = 'Menos de 05 horas';
                             }
                             if ($hora == 5) {
                                 $tempo = 'Menos de 06 horas';
                             }
                             if ($hora == 6) {
                                 $tempo = 'Menos de 07 horas';
                             }
                             if ($hora == 7) {
                                 $tempo = 'Menos de 08 horas';
                             }
                             if ($hora == 8) {
                                 $tempo = 'Menos de 09 horas';
                             }
                             if ($hora == 9) {
                                 $tempo = 'Menos de 10 horas';
                             }
                             if ($hora == 10) {
                                 $tempo = 'Menos de 11 horas';
                             }
                             if ($hora == 11) {
                                 $tempo = 'Menos de 12 horas';
                             }
                             if ($hora == 12) {
                                 $tempo = 'Menos de 13 horas';
                             }
                             if ($hora == 13) {
                                 $tempo = 'Menos de 14 horas';
                             }
                             if ($hora == 15) {
                                 $tempo = 'Menos de 15 horas';
                             }
                             if ($hora == 15) {
                                 $tempo = 'Menos de 16 horas';
                             }
                             if ($hora == 16) {
                                 $tempo = 'Menos de 17 horas';
                             }
                             if ($hora == 17) {
                                 $tempo = 'Menos de 18 horas';
                             }
                             if ($hora == 18) {
                                 $tempo = 'Menos de 19 horas';
                             }
                             if ($hora == 19) {
                                 $tempo = 'Menos de 20 horas';
                             }
                             if ($hora == 20) {
                                 $tempo = 'Menos de 21 horas';
                             }
                             if ($hora == 21) {
                                 $tempo = 'Menos de 22 horas';
                             }
                             if ($hora == 22) {
                                 $tempo = 'Menos de 23 horas';
                             }
                             if ($hora == 23) {
                                 $tempo = 'Menos de 24 horas';
                             }
                             if ($hora == 24) {
                                 $tempo = 'Menos de 25 horas';
                             }
                             if ($hora > 24) {
                                 $tempo = 'Mais que 24 horas';
                             }
                             if ($hora == 14) {
                                 $tempo = 'Menos de 09 hora';
                             }
                             
                         
                             $TESTE1 =  "Diferença em Horas é : " . ($interval->h + ($interval->days * 24));
                             if ($gr->vencimento_em == 'Menos de 01 hora') {
                                  $animacion = 'blink_me';
                                  $cor = 'style="background-color:red;color:white"';
                             } else {
                                 $animacion = '';
                                 $cor = '';
                             }
                     
                            
                             
                             echo '<tr class="bg- text-center py-0 align-middle '.$animacion.' $cor">
                                     <td '.$cor.'>'.date('d/m/Y H:i:s', strtotime($gr->prazo_atendimento)).'</td>
                                     <td '.$cor.'>'.$gr->vencimento_em.'</td>
                                     <td '.$cor.'>'.$gr->gerencia.'</td>
                                     <td '.$cor.'>'.$gr->localidade.'</td>
                                     <td '.$cor.'>'.$gr->supervisor.'</td>
                                     <td '.$cor.'>'.$gr->tecnico.'</td>
                                     <td '.$cor.'>'.$gr->controlador.'</td>  
                                     <td '.$cor.'>'.$gr->tipo_atividade.'</td>
                                     <td '.$cor.'>'.$gr->estado.'</td>
                                     <td '.$cor.'>'.$gr->os.'</td>
                                     <td '.$cor.'>'.$gr->time_slot.'</td>
                                     <td '.$cor.'>'.$gr->aging_reparo.'</td>
                                     <td '.$cor.'>'.$gr->atendimento.'</td>
                                     
                                 
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
            "order": [ 1, 'asc' ]
       });
   });
   
</script>
@stop
@stop