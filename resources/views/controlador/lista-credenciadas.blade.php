@extends('adminlte::page')

@section('title', 'Presença')

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
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
    <div class="box-body table-responsive no-padding">
        <table id="" class="table table-striped table-sm table-bordered dataTable">
            <thead>
                <tr class="bg-info text- py-0 align-middle">
                    
                    <th style=" background-color:#;color:;width:120px"><center>Controlador</th>
                    <th style=" background-color:#;color:;width:120px"><center>Supervisor</th>
                    <th style=" background-color:#;color:;width:120px"><center>Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $numero = 1;
                foreach ($dados['dados'] as $gr) {
                    echo '<tr class="bg- text- py-0 align-middle">
                            <td>'.$gr->controlador.'</td>
                            <td>'.$gr->credenciadas.'</td>
                            <td><center>
                                <a style="color:white" class="btn btn-success btn-xs" href="./lancar_presenca_controlador?credenciada='.$gr->credenciadas.'"><i class="fas fa-edit"></i>Lançar Presença</a>
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
