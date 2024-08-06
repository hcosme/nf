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
                           <th style="width:200px" colspan="4">
                              <center>
                                 [CONSULTAR FORNECEDORES]
                              </center>
                           </th>
                        </tr>
                        <tr class="bg-light text-center py-0 align-middle">
                           <th class="cabecalho" style="width:15px">
                              <center>#</center>
                           </th>
                           <th class="cabecalho" style="width:20px">
                              <center>Situação</center>
                           </th>
                           <th class="cabecalho" style="width:30px">
                              <center>Fornecedor</center>
                           </th>
                           <th class="cabecalho" style="width:30px">
                              <center>CPF/CNPJ</center>
                           <Anterior
/th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                        $qtdColuna = 1;
                        @endphp
                       
                        <tr>
                            @foreach ($dados as $nf) 
                            
                             <td title="Observação: ">
                              <center>
                               {{ $qtdColuna++ }}
                              </center>
                           </td>
                            <td title="Observação: ">
                              <center>
                               {{ $nf->status }}
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                               {{ $nf->fornecedores }}
                              </center>
                           </td>
                           <td title="Observação: ">
                              <center>
                                 <center>
                                {{ $nf->cpf }}
                                 </center>
                              </center>
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