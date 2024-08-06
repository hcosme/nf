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
<form action="./reparo_fila" method="get">
      <div class="row">
              <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Filial:</label>
                  <select class="form-control form-control-md" name="filial">
                  <?php if(isset($_GET['filial'])) {
                    echo '<option value="'.$_GET['filial'].'">'.$_GET['filial'].'</option>';
                    };?>
                    <option value="TODOS">TODOS</option>
                    <option value="RIO DE JANEIRO">RIO DE JANEIRO</option>
                    <option value="SAO PAULO LESTE">SAO PAULO LESTE</option>
                  </select>
                </div>
                           <div class="form-group col-md-6">
             
               
                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                <input  type="submit" class="form-control form-control-md btn btn-secondary" value="Filtrar">
              </div>
</form>  
</div>
</div>
</div></div>
</div>


    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">

                   <div class="form-group col-md-2">
                    <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                    <a href="https://gestaoderecursos.com/exportacao/abertas.php" ><input  type="button" class="form-control form-control-md btn btn-secondary" value="Baixar excel"></a>
                </div>
           
  <div class="box-body table-responsive no-padding">
 <table id="minhaTabela2" class="table table-striped table-sm table-bordered dataTable">
    <thead>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#483D8B;color:white;width:200px" colspan="19"><center>[FILA DE ATENDIMENTO] </th> 
        </tr>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#191970;color:white;width:160px"><center>Fim SLA</th>
        <th style=" background-color:#191970;color:white;width:160px"><center>Tempo</th>
        <th style=" background-color:#191970;color:white;width:160px"><center>Faixa Aging</th>
        <th style=" background-color:#191970;color:white;width:360px"><center>Provedor</th>
                <th style=" background-color:#191970;color:white;width:360px"><center>Supervisor</th>
        <th style=" background-color:#191970;color:white;width:360px"><center>Tipo de Atividade</th>
           <th style="background-color:#191970;color:white;width:160px" title=""><center>Estado</th>
        <th style="background-color:#191970;color:white;width:70px" title=""><center>Número da Ordem</th>
        </tr>
    </thead>
    <tbody>
            <?php 
                foreach ($dados['backlog'] as $gr) {
                    $data = date('Y-m-d H:i:s', strtotime(substr($gr->DT_FIM_SLA_TOA,-5)));
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
                    if ($tempo == 'Menos de 01 hora') {
                         $animacion = '';
                         $cor = 'style="background-color:red;color:white"';
                    } else {
                        $animacion = '';
                        $cor = '';
                    }
           
                   
                    
                    echo '<tr class="bg- text-center py-0 align-middle '.$animacion.' $cor">
                            <td '.$cor.'>'.$gr->DT_FIM_SLA_TOA.'</td>
                            <td '.$cor.'>'.$tempo.'</td>
                            <td '.$cor.'>'.$gr->FAIXA_ENTRANTE.'</td>
                            <td '.$cor.'>'.$gr->TECNICO.'</td>
                            <td '.$cor.'>'.$gr->SUPERVISOR.'</td>  
                            <td '.$cor.'>'.$gr->TIPO_ATIVIDADE.'</td>
                            <td '.$cor.'>'.$gr->ESTADO.'</td>
                            <td '.$cor.'>'.$gr->OS.'</td>
                            
                        
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
