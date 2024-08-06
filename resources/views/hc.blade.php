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
   <form action="./index" method="get">
<div class="row">
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1">Status:</label>
                  <select class="form-control form-control-md" name="status">
                    <?php if(isset($_GET['status'])) {
                        echo '<option value="'.$_GET['status'].'">'.$_GET['status'].'</option>';
                    };?>
                  <option value="TODOS">TODOS</option>
                  <option value="ATIVO">ATIVO</option>
                  <option value="INATIVO">INATIVO</option>
                    
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Coordenador:</label>
                  <select class="form-control form-control-md" name="coordenador">
                    <?php if(isset($_GET['coordenador'])) {
                        echo $_GET['coordenador'];
                    };?>
                  <option value="TODOS">TODOS</option>
            
                   <?php 
                            foreach ($dados['coordenador'] as $coord) {
                                echo '<option value="'.$coord->coordenador.'">'.$coord->coordenador.'</option>';
                                
                            }
                            
                            
                            ;?>
                            
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Supervisor:</label>
                  <select class="form-control form-control-md" name="supervisor">
                    <?php if(isset($_GET['supervisor'])) {
                        echo $_GET['supervisor'];
                    };?>
                      <option value="TODOS">TODOS</option>
            
                  <?php 
                            foreach ($dados['supervisor'] as $coord) {
                                echo '<option value="'.$coord->supervisor.'">'.$coord->supervisor.'</option>';
                                
                            }
                            
                            
                            ;?>
                            
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Skill:</label>
                  <select class="form-control form-control-md" name="skill">
                    <?php if(isset($_GET['skill'])) {
                        echo $_GET['skill'];
                    };?>
                  <option value="TODOS">TODOS</option>
                  <option value="FTTC">FTTC</option>
                  <option value="FTTH">FTTH</option>
                  <option value="MULTI">MULTI</option>  
                  </select>
                </div>
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-success" value="Buscar">
              </div>
</form>               
                </div>
                
</div>
<?php //dd($dados['visaoFFA']);?>




    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
                   <div class="form-group col-md-2">
                    <label for="exampleInputEmail1"><b style="color: white">.</b></label>
        
                <a href="./cadastrar_tecnico" >
                        <input  type="button" class="form-control form-control-md btn btn-success" value="Cadastrar Técnico">
                    </a>
                    
                </div>
           
    <div class="box-body table-responsive no-padding">


        <table id="minhaTabela2" class="table table-striped table-sm table-bordered dataTable">
            <thead>
                <tr class="bg-light text-center py-0 align-middle">
                    <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[CONTROLE DE EQUIPES] </th> 
                </tr>
                <tr class="bg-light text- py-0 align-middle">
                    <th style=" background-color:#;color:black;width:60px"><center>Nº</th>
                    <th style=" background-color:#;color:black;width:180px"><center>Nome</th>
                    <th style=" background-color:#;color:black;width:160px"><center>Coordenador</th>
                    <th style=" background-color:#;color:black;width:160px"><center>Supervisor</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Status</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $numero = 1;
                foreach ($dados['dados'] as $gr) {
                    echo '<tr class="bg- text- py-0 align-middle">
                            <td>'.$numero++.'</td>
                            <td>'.$gr->tecnicos.'</td>
                            <td>'.$gr->coordenador.'</td>
                              <td>'.$gr->supervisor.'</td>
                            <td><center>'.$gr->status.'</td>
                            <td><center>
                                <a class="btn btn-info btn-xs" href="./editar_tecnico?id='.$gr->id.'"><i class="fas fa-edit"></i>Editar</a>
                                 <a class="btn btn-danger btn-xs" href="./deletar_tecnico?id='.$gr->id.'"><i class="fas fa-trash"></i>Excluir</a>
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
            }
        });
  });

  </script>

@stop
@stop
