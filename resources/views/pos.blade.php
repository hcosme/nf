@extends('adminlte::page')

@section('title', 'Pós')

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
 <b>Fonte de dados:</b> TOA  
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

<div class="in" id="collapseExample4">
<form action="./pos" method="get">
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
                  <label for="exampleInputEmail1">Filial:</label>
                  <select class="form-control form-control-md" name="filial">
                  
                    <option value="TODOS">TODOS</option>
                    <option value="RJ">RJ</option>
                    <option value="SP">SP</option>
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
<?php //dd($dados['visaoFFA']);?>


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

</style>

    <div class="callout callout-secondary">
  <p>
<div class="row">
    
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="color:">{{ $dados['instalacao'][0]->QTD }}</h3>

                <p>Instalações dia</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="./pos?status=inst" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                 <h3 style="color:">{{ $dados['instalacaoAuditadas'][0]->QTD }}</h3>

                <p>Auditados dia</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="./pos?status=inst_auditado" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                 <h3 style="color:">{{ $dados['reparo'][0]->QTD }}</h3>

                <p>Reparos dia</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="./pos?status=rep" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
                  <h3>{{ ($dados['reparoAuditadas'][0]->QTD) }}</h3>

                <p>Auditados dia</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="./pos?status=rep_auditado" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                </div>
</div>


    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
  <div class="box-body table-responsive no-padding">
 <table id="tbl_atribuicao" class="table table-striped table-sm table-bordered dataTable">
   <thead>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#020E37;color:white;width:200px" colspan="19"><center>[Pós TT/BA] </th> 
        </tr>
      <tr class="bg-light text-center py-0 align-middle">
        <th style="background-color:#020E37;color:white;width:5px" title=""><center>#</th>
        <th style=" background-color:#020E37;color:white;width:30px"><center>Data</th>
        <th style="background-color:#020E37;color:white;width:5px" title=""><center>UF</th>
        <th style="background-color:#020E37;color:white;width:40px" title=""><center>Ordem</th>
        <th style="background-color:#020E37;color:white;width:180px" title=""><center>Técnico</th>
        <th style=" background-color:#020E37;color:white;width:180px"><center>Tipo</th>
             </tr>
    </thead>
    <tbody>
            <?php 
                $qtdColuna = 1;
                foreach ($dados['pos'] as $gr) {
                
                    
                    echo '<tr>
                      <td><center>'.$qtdColuna++.'</td>
                    <td> <a href="./editar-pos?id='.$gr->id.'"> '.$gr->data.'</td>
                    <td> <a href="./editar-pos?id='.$gr->id.'"> '.$gr->uf.'</td>
                    <td> <a href="./editar-pos?id='.$gr->id.'"> '.$gr->ordem.'</td>
                    <td> <a href="./editar-pos?id='.$gr->id.'"> '.$gr->tecnico.'</td>
                    <td> <a href="./editar-pos?id='.$gr->id.'"> '.$gr->tipo_atividade.'</td>
                    
                    </tr>
                    ';
                }
            ?>

    </tbody>
  </table>




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
         "order": [[ 3, "desc" ]]
        });
  });

  </script>

@stop
@stop
