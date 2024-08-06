@extends('adminlte::page')
@section('title', 'Advertência')
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
   .cabecalho {
   background-color:#020E37 !important;
   color:white !important;
   }
</style>
<div class="callout callout-secondary">
   <p>
      <!-- <b>Fonte de dados:</b> TOA
         <?php
            date_default_timezone_set('America/Sao_Paulo');
            if (isset($dados['atualizacao'][0])) {
            
                  echo date('d/m/Y H:i:s', strtotime($dados['atualizacao'][0]->data));
            } else {
                echo '';
            }
            
            ?>
          <IMG SRC="https://preloaders.evidweb.com/images/preloaders/ajax-loading-c7.gif" width="18px" heigh="18px">
         </p> -->
   <div class="in" id="collapseExample4">
      <form action="./advertencia" method="get">
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
            <label for="exampleInputEmail1">Aplicador:</label>
            <select name="colaborador" class="form-control form-control-sm" value="" required>
               @foreach ($dados['aplicadores'] as $d)
               <option value="{{ $d->lider_aplicacao }}">{{ $d->lider_aplicacao }}</option>
               @endforeach
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
</div>
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
   a:link
   {
   text-decoration:none;
   }
</style>
<div class="callout callout-secondary">
   <p>
   <div class="row">
      <div class="col-lg-4 col-4">
         <!-- small box -->
         <div class="small-box bg-">
            <div class="inner">
               <h3 style="color:">{{ count($dados['aplicadas']) }} </h3>
               <p>Aplicadas</p>
            </div>
            <div class="icon">
               <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-4">
         <!-- small box -->
         <div class="small-box bg-">
            <div class="inner">
               <h3 style="color:">{{ count($dados['pendente']) }}</h3>
               <p>Pendentes</p>
            </div>
            <div class="icon">
               <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
      <div class="col-lg-4 col-4">
         <!-- small box -->
         <div class="small-box bg-">
            <div class="inner">
               <h3 style="color:">{{ count($dados['dados']) }} </h3>
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
<div class="callout callout-secondary">
   <p>
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
                <div class="form-group col-md-2">
                    <label for=""><b style="color: white">.</b></label>
                    <a href="./cadastro-advertencia"><button class="form-control form-control-md btn btn-success">Gerar Advertência</button></a>
                </div>
               <div class="box-body table-responsive no-padding">
                  <table id="tbl_atribuicao" class="table table-striped table-sm table-bordered dataTable">
                     <thead>
                        <tr class="bg-light text-center py-0 align-middle cabecalho">
                           <th style="width:200px" colspan="19">
                              <center>
                                 [ADVERTÊNCIAS]
                              </center>
                           </th>
                        </tr>
                        <tr class="bg-light text-center py-0 align-middle">
                           <th class="cabecalho" style="width:15px">
                              <center>#</center>
                           </th>
                           <th class="cabecalho" style="width:60px">
                              <center>Data</center>
                           </th>
                           <th class="cabecalho" style="width:120px">
                              <center>Usuário</center>
                           </th>
                           <th class="cabecalho" style="width:60px">
                              <center>Colaborador</center>
                           </th>
                           <th class="cabecalho" style="width:60px">
                              <center>Motivo</center>
                           </th>
                           <th class="cabecalho" style="width:100px">
                              <center>Situação</center>
                           </th>
                           <th class="cabecalho" style="width:100px">
                              <center>Ações</center>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                        $qtdColuna = 1;
                        @endphp
                        @foreach ($dados['dados'] as $gr)
                        <tr>
                           <td title="Observação: ">
                              <center>
                                 {{ $qtdColuna++ }}
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                                 <center>
                                    {{ $gr->data_cadastro }}
                                 </center>
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                                 {{ $gr->usuario }}
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                                 {{ $gr->colaborador }}
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                                 {{ $gr->motivo }}
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                                 {{ $gr->status }}
                              </center>
                           </td>
                           <td align="center">
                              <a class="btn btn-light btn-sm" target="_blank" href="./ver-advertencia?id=<?php echo $gr->id;?>" title="Imprimir">
                              <i class="fas fa-solid fa-print"></i>
                              </a>
                              @if ($gr->anexo == NULL)
                              <a class="btn btn-light btn-sm" href="./editar-advertencia?id=<?php echo $gr->id;?>" title="Editar Status">
                              <i class="fas fa-solid fa-exclamation-circle"></i>
                              </a>
                              @endif
                              @if (! $gr->anexo == NULL)
                               
                              <a  class="btn btn-light btn-sm" target="_blank" href="./ver-anexo-advertencia?id=<?php echo $gr->id;?>"  title="Ver anexo">
                              <i class="fas fa-solid fa-eye"></i>
                              </a>
                              @endif
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  <!-- /.box-body -->
               </div>
               <!-- /.box -->
            </div>
         </div>
      </div>
   </div>
</div>
<div class="callout callout-secondary">
<p>
   <!-- /.box -->
   @section('js')
   <script>
      $(document).ready(function(){
          $('#tbl_atribuicao0').DataTable({
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