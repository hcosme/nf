@extends('adminlte::page')

@section('title', 'Equipes')

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

</style>

    <div class="callout callout-secondary">
  <p>
<!-- <b>Fonte de dados:</b> BÚSSOLA | <b>Última atualização: </b> 
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

<?php
    if ( auth()->user()->status == 'pendente') {
        echo '<center><h3>Aguarde até que seja feita sua aprovação.</h3></center>';
    }
    if ( auth()->user()->role == 'fornecedor') {
        echo '<center><h3>Você não tem acesso a esta página.</h3></center>';
    }
?>

@if (auth()->user()->status != 'pendente' && auth()->user()->role != 'fornecedor' ) 


    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
    <div class="box-body table-responsive no-padding">
        <table id="minhaTabela2" class="table table-striped table-sm table-bordered dataTable">
            <thead>
                <tr class="bg-light text-center py-0 align-middle">
                    <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[CONTROLE DE USUARIOS] </th> 
                </tr>
                <tr class="bg-light text- py-0 align-middle">
                    <th style=" background-color:#;color:black;width:60px"><center>Nº</th>
                    <th style=" background-color:#;color:black;width:110px"><center>Nome</th>
                    <th style=" background-color:#;color:black;width:110px"><center>E-mail</th>
                    <th style=" background-color:#;color:black;width:80px"><center>CNPJ</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $numero = 1;
                foreach ($dados['dados'] as $gr) {
                    if ($gr->gestao == null) {
                        $gestao = "Definir";
                    } else {
                        $gestao = $gr->gestao;
                    }
                    
                    
                    echo '<tr class="bg- text- py-0 align-middle">
                            <td>'.$gr->id.'</td>
                            <td>'.$gr->name.'</td>
                            <td>'.$gr->email.'</td>
                              <td>'.$gr->cpf.'</td>
                            <td><center>
                                <a class="btn btn-info btn-xs" href="./editar_usuario?id='.$gr->id.'"><i class="fas fa-edit"></i>Editar</a>
                                 <a class="btn btn-danger btn-xs" href="./deletar_usuario?id='.$gr->id.'"><i class="fas fa-trash"></i>Excluir</a>
                            </td>
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
@endif
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
            order: [[0, 'desc']],
        });
  });

  </script>

@stop
@stop
