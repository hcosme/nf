@extends('adminlte::page')

@section('title', 'Equipes')

@section('content_header')
<!--<meta http-equiv="refresh" content="30">
   <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop

@section('content')
@if(session('mensagem'))
    <div class="alert alert-secondary">
        <p>{{session('mensagem')}}</p>
    </div>
@endif
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

   <form action="./alterar_presenca_controlador" method="get">
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
                @if (auth()->user()->perfil != 0)
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1">Supervisor:</label>
                  <select class="form-control form-control-md" name="supervisor">
                    <?php if(isset($_GET['supervisor'])) {
                        echo "<option value=".$_GET['supervisor'].">".$_GET['supervisor']." | Atual</option>";
                    };?>
                   
                      <option value="TODOS">TODOS</option>
            
                  <?php 
                            foreach ($dados['supervisor'] as $coord) {
                                echo '<option value="'.$coord->supervisor.'">'.$coord->supervisor.'</option>';
                                
                            }
                            
                            
                            ;?>
                            
                  </select>
                </div>
                    @endif
                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-success" value="Buscar">
              </div>
              
</form>               
                </div>
            
</div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
    <div class="box-body table-responsive no-padding">
        <table id="minhaTabela2" class="table table-striped table-sm table-bordered dataTable">
            <thead>
                <tr class="bg-info text- py-0 align-middle">
                    <th style=" background-color:#;color:;width:10px"><center>Nº</th>
                    <th style=" background-color:#;color:;width:160px"><center>Nome</th>
                    <th style=" background-color:#;color:;width:20px"><center>Data</th>
                    <th style=" background-color:#;color:;width:60px"><center>1. Técnico está com rota ativa?</th>
                    <th style=" background-color:#;color:;width:60px"><center>2. Técnico está com atividades atribuidas?</th>
                    <th style=" background-color:#;color:;width:60px"><center>3. Técnico está com atividade iniciada as 8h?</th>
                    <th style=" background-color:#;color:;width:60px"><center>4. As atividades iniciadas possuem CA?</th>
                    <th style=" background-color:#;color:;width:60px"><center>5. O técnico já está conectado no SuperApp?</th>
                    <th style=" background-color:#;color:;width:90px"><center>Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $numero = 1;
                
                foreach ($dados['dados'] as $gr) {
                if (auth()->user()->perfil == 0) {
                    echo '<tr class="bg- text- py-0 align-middle">
                            <td>'.$numero++.'</td>
                            <td>'.$gr->tecnico.'</td>
                            <td>'.$gr->data.'</td>
                              <td>'.$gr->rota_ativa.'</td>
                              <td>'.$gr->atividades_atribuidas.'</td>
                              <td>'.$gr->atividade_iniciada.'</td>
                              <td>'.$gr->atividade_iniciada_ca.'</td>
                            <td>'.$gr->superapp.'</td>
                            <td><center>
                                <a class="btn btn-secondary btn-xs" href="./ver_apontamento_tecnico_controlador?id='.$gr->id.'"><i class="fas fa-eye"></i> Ver</a>
                                            ';
                    if ($gr->data == date('d/m/Y')) {
                          echo    '<a class="btn btn-warning btn-xs" href="./editar_apontamento_tecnico_controlador?id='.$gr->id.'"><i class="fas fa-edit"></i> Editar</a>';
                          
                    }
                    echo '</td>';
                } else {
                     echo '<tr class="bg- text- py-0 align-middle">
                            <td>'.$numero++.'</td>
                            <td>'.$gr->tecnico.'</td>
                            <td>'.$gr->data.'</td>
                              <td>'.$gr->rota_ativa.'</td>
                              <td>'.$gr->atividades_atribuidas.'</td>
                              <td>'.$gr->atividade_iniciada.'</td>
                              <td>'.$gr->atividade_iniciada_ca.'</td>
                            <td>'.$gr->superapp.'</td>
                            <td><center>
                                <a class="btn btn-secondary btn-xs" href="./ver_apontamento_tecnico_controlador?id='.$gr->id.'"><i class="fas fa-eye"></i> Ver</a>
                                <a class="btn btn-warning btn-xs" href="./editar_apontamento_tecnico_controlador?id='.$gr->id.'"><i class="fas fa-edit"></i> Editar</a>
                                <a class="btn btn-danger btn-xs" href="./deletar_apontamento_controlador?id='.$gr->id.'"><i class="fas fa-trash"></i> Excluir</a>
                            </td>
                    ';
                }
        
                    
                    
                    
                   
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
