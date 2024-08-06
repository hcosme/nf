@extends('adminlte::page')

@section('title', 'Contato')

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

@if(session('mensagem'))
    <div class="alert alert-success">
        <p>{{ session('mensagem') }}</p>
    </div>
@endif



    <div class="callout callout-secondary">
  <p>


<div class="in" id="collapseExample4">
<form action="./contato" method="get">
      <div class="row">
            
             
                 <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Nome:</label>
                  <select class="form-control form-control-md" name="nome">
                    <?php if(isset($_GET['nome'])) {
                        echo $_GET['nome'];
                    };?>
                  
                  <option value="TODOS">TODOS</option>
                  <?php 
                    foreach ($dados['nome'] as $ger) {
                        echo '
                            <option value="'.$ger->nome.'">'.$ger->nome.'</option>
                            ';    
                    }
                  ?>
                  </select>
                </div>
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-info" value="Buscar">
              </div>
            
</form>               
                </div>
                </div>
                
                </div>
         

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
    <a class="btn btn-outline-primary" href="./cadastrar_contato" role="button">Realizar cadastro</a>
    
    <!-- Button trigger modal -->
    <button class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">
      Enviar Torpedo
    </button>
    
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
    <div class="box-body table-responsive no-padding">
        <table id="minhaTabela2" class="table table-striped table-sm table-bordered dataTable">
            <thead>
                <tr class="bg-light text-center py-0 align-middle">
                    <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[CONTROLE DE CONTATOS] </th> 
                </tr>
                <tr class="bg-light text- py-0 align-middle">
                    <th style=" background-color:#;color:black;width:10px"><center>Nº</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Nome</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Contato</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Status</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Data Cadastro</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $numero = 1;
                foreach ($dados['dados'] as $gr) {
                    echo '<tr class="bg- text- py-0 align-middle">
                            <td><center>'.$numero++.'</td>
                            <td><center>'.$gr->nome.'</td>
                            <td><center>'.$gr->contato.'</td>
                            <td><center>'.$gr->status.'</td>
                            <td><center>'.date('d/m/Y H:i:s',strtotime($gr->data_cadastro)).'</td>
                            <td><center> 
                                <a class="btn btn-warning btn-xs" href="editar_contato?id='.$gr->id.'"><i class="fas fa-eye" ></i> Editar</a>
                                
                            </td>
                    ';
                }
            ?>

    </tbody>
  </table>
  </form>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Importante!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Importante:</b> O envio de sms é cobrado o valor de R$ 0,08 por contato.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fechar</button>
        <a class="btn btn-outline-success" href="./enviar_torpedo" role="button">Enviar Torpedo</a>
      </div>
    </div>
  </div>
</div>

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

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <center><i style="color:red">* Para visualizar, passe o cursor do mouse sobre a linha desejada.</i><hr></center>
    <div class="box-body table-responsive no-padding">
        <table id="minhaTabela1" class="table table-striped table-sm table-bordered dataTable">
            <thead>
                <tr class="bg-light text-center py-0 align-middle">
                    <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[TORPEDOS ENVIADOS]</th> 
                </tr>
                <tr class="bg-light text- py-0 align-middle">
                    <th style=" background-color:#;color:black;width:10px"><center>Nº</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Nome</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Contato</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Status</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Data Cadastro</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php 
                $numero = 1;
                foreach ($dados['log_torpedo'] as $gr) {
                    echo '<tr class="bg- text- py-0 align-middle">
                            <td title="'.$gr->conteudo.'"><center>'.$numero++.'</td>
                            <td title="'.$gr->conteudo.'"><center>'.$gr->nome.'</td>
                            <td title="'.$gr->conteudo.'"><center>'.$gr->destinatario.'</td>
                            <td title="'.$gr->conteudo.'"><center>'.$gr->status.'</td>
                            <td title="'.$gr->conteudo.'"><center>'.date('d/m/Y H:i:s',strtotime($gr->data_cadastro)).'</td>
                            
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
            }
        });
  });
  
  
  $(document).ready(function(){
      $('#minhaTabela1').DataTable({
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
            }
        });
  });

  </script>

@stop
@stop
