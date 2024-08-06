@extends('adminlte::page')
@section('title', 'Consultar')
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
   background-color:# !important;
   color:black !important;
   }
</style>
<?php
    if ( auth()->user()->status == 'pendente') {
        echo '<center><h3>Aguarde até que seja feita sua aprovação.</h3></center>';
    }
?>

@if (auth()->user()->status != 'pendente') 
<div class="callout callout-secondary">
   <p>
   <div class="in" id="collapseExample4">
      <form action="./consultar-nf" method="get">
         <div class="row">
             
                
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">CPF/CNPJ:</label>
                  <select class="form-control form-control-md" name="cnpj">
                    <?php
                        if(isset($_GET['cnpj'])) {
                            echo '<option value="'.$_GET['cnpj'].'">'.$_GET['cnpj'].'</option>';
                        }
                        ?>
                    
                    @foreach ($notasFiscais['ff'] as $nf) 
                    
                  <option value="{{ $nf->cpf }}">{{ $nf->cpf.' | '.$nf->nome }}</option>
                  @endforeach
                  </select>
                </div>
             <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Nr.Nota:</label>
                  <input class="form-control form-control-md" name="nf" value="" type="text">
                </div>
             <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Status:</label>
                  <select class="form-control form-control-md" name="situacao">
                    <?php if(isset($_GET['situacao'])) {
                        echo $_GET['situacao'];
                    };?>
                    
                  <option value="select">Selecione</option>
                  <option value="Em processamento">Em processamento</option>
                  <option value="Aguardando Pagamento">Aguardando pagamento</option>
                  <option value="Nota Recusada">Nota Recusada</option>
                  <option value="Cancelada">Cancelada</option>
                  <option value="Pagamento realizado">Pagamento realizado</option>
                  <option value="Aguardando recebimento">Aguardando recebimento</option>
                  </select>
                </div>
             
             <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Material/Serviço:</label>
                  <select class="form-control form-control-md" name="status">
                    <?php if(isset($_GET['status'])) {
                        echo $_GET['status'];
                    };?>
                  <option value="TODOS">Todos</option>
                  <option value="MATERIAL">Material</option>
                  <option value="SERVICO">Serviço</option>
                  </select>
                </div>
              <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Consultar por:</label>
                  <select class="form-control form-control-md" name="consultar_por">
                    <?php if(isset($_GET['consultar_por'])) {
                        echo $_GET['consultar_por'];
                    };?>
                  <option value="Cadastro">Cadastro</option>
                  <option value="Pagamento">Pagamento</option>
                  <option value="Vencimento">Vencimento</option>
                  </select>
                </div>
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

   <p>
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
                <div class="form-group col-md-2">
                    <label for=""><b style="color: white">.</b></label>
                    <!-- <a href="./cadastro-advertencia"><button class="form-control form-control-md btn btn-success">Gerar Advertência</button></a> -->
                </div>
               <div class="box-body table-responsive no-padding">
                  <table id="tbl_atribuicao" class="table table-striped table-sm table-bordered dataTable">
                     <thead>
                        <tr class="bg-light text-center py-0 align-middle cabecalho">
                           <th style="width:200px" colspan="19">
                              <center>
                                 [CONSULTAR NF]
                              </center>
                           </th>
                        </tr>
                        <tr class="bg-light text-center py-0 align-middle">
                           <th class="cabecalho" style="width:15px">
                              <center>#</center>
                           </th>
                           <th class="cabecalho" style="width:160px">
                              <center>Situação</center>
                           </th>
                           <th class="cabecalho" style="width:60px">
                              <center>Material/Serviço</center>
                           </th>
                           <th class="cabecalho" style="width:120px">
                              <center>Pedidos</center>
                           </th>
                           <th class="cabecalho" style="width:60px">
                              <center>Nr.Nota</center>
                           </th>
                           <th class="cabecalho" style="width:60px">
                              <center>Dt.Emissão</center>
                           </th>
                           <th class="cabecalho" style="width:60px">
                              <center>Dt.Venc.</center>
                           </th>
                           <th class="cabecalho" style="width:60px">
                              <center>Dt.Pgto.</center>
                           </th>
                           <th class="cabecalho" style="width:60px">
                              <center>Tipo</center>
                           </th>
                           <th class="cabecalho" style="width:60px">
                              <center>Dt.Cadastro</center>
                           </th>
                           <!-- <th class="cabecalho" style="width:160px">
                              <center>Motivo NF Recusada</center>
                           </th> -->
                           <th class="cabecalho" style="width:100px">
                              <center>Ações</center>
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                        $qtdColuna = 1;
                        @endphp
                       
                        <tr>
                            @foreach ($notasFiscais['dados'] as $nf) 
                            
                            
                            @php
                                $dataPgto = empty($nf->data_pagamento) ? 'A definir' : date('d/m/Y', strtotime($nf->data_pagamento));
                            @endphp
                            @php
                                $motivo = empty($nf->motivo_recusa) ? '---' : $nf->motivo_recusa;
                            @endphp
                            @php
                                $dataVenc = empty($nf->vencimento) ? 'A definir' : date('d/m/Y', strtotime($nf->vencimento));
                            @endphp
                             <td title="Observação: ">
                              <center>
                               {{ $qtdColuna++ }}
                              </center>
                           </td>
                            <td title="Observação: ">
                              <center>
                               {{ $nf->situacao }}
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                               {{ $nf->escopo }}
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                                 <center>
                                {{ $nf->pedido }}
                                 </center>
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                             {{ $nf->numero_nf }}
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                            {{ date('d/m/Y', strtotime($nf->data_emissao)) }}     
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                            {{ $dataVenc }}
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                            {{ $dataPgto }}    
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                            {{ $nf->status }}       
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                            {{ date('d/m/Y', strtotime($nf->data_cadastro)) }}        
                              </center>
                           </td>
                          <!-- <td title="Observação: ">
                              <center>
                            {{ $motivo }}      
                              </center>
                           </td> -->
                           <td align="center">
                              <a class="btn btn-light btn-sm" target="_blank" href="https://nf.hone.net.br/storage/app/public/<?php echo $nf->anexo_nf;?>" title="Imprimir">
                              <i class="fas fa-solid fa-print"></i>
                              </a>
                              
                              <a class="btn btn-light btn-sm" href="./editar?id=<?php echo $nf->numero_nf;?>" title="Editar Status">
                              <i class="fas fa-solid fa-exclamation-circle"></i>
                              </a>
                              <!--
                              <a  class="btn btn-light btn-sm" target="_blank" href="./ver-solicitacao?id=<?php echo $nf->numero_nf;?>"  title="Ver anexo">
                              <i class="fas fa-solid fa-eye"></i>
                              </a> -->
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
 @endif
<p>
   <!-- /.box -->
   @section('js')
   <script>
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
            });
      });
      
   </script>
  
   @stop
   @stop