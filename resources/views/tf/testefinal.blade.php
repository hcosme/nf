@extends('adminlte::page')

@section('title', 'Teste Final')

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
<form action="./testefinal" method="get">
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
                  <label for="exampleInputEmail1">Filial:</label>
                  <select class="form-control form-control-md" name="filial">

                    <?php
                            if(isset($_GET['filial'])) {
                                echo '<option value="'.$_GET['filial'].'">'.$_GET['filial'].'</option>"';
                            }
                    ?>


                    <option value="TODOS">TODOS</option>
                    <option value="TLI">TLI</option>
                    <option value="TLG">TLG</option>
                    <option value="TLP">TLP</option>
                    <option value="TLS">TLS</option>
                  </select>
                </div>


                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Tipo Atividade:</label>
                  <select class="form-control form-control-md" name="tipo">
                   <?php
                            if(isset($_GET['tipo'])) {
                                echo '<option value="'.$_GET['tipo'].'">'.$_GET['tipo'].'</option>"';
                            }
                    ?>

                    <option value="TODOS">TODOS</option>
                    <option value="Instalação">Instalação</option>
                    <option value="Reparo">Reparo</option>
                    <option value="Pró Ativo">Pró Ativo</option>
                    <option value="VOIP">VOIP</option>
                    <option value="Desconexão">Desconexão</option>
                  </select>
                </div>

                  <div class="form-group col-md-2">
                  <label for="exampleInputEmail1">Operador:</label>
                  <select class="form-control form-control-md" name="operador">
                      <option value="TODOS">TODOS</option>
                  <?php

                    foreach ($dados['operador'] as $ger) {
                        echo '
                            <option value="'.$ger->nome.'">'.$ger->nome.'</option>
                            ';
                    }


                  ?>
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

        <div class="col-lg-3 col-2">
            <!-- small box -->
            <div class="small-box bg-">
              <div class="inner">
                <h3 style="color:">{{ $dados['total_instalacao'][0]->qtd }} </h3>

                <p>Instalação</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-2">
            <!-- small box -->
            <div class="small-box bg-">
              <div class="inner">
                 <h3 style="color:">{{ $dados['total_reparo'][0]->qtd }}</h3>

                <p>Reparo</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-2">
            <!-- small box -->
            <div class="small-box bg-">
              <div class="inner">
                 <h3 style="color:">{{ $dados['total_pro_ativo'][0]->qtd }}</h3>

                <p>Pró Ativo</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        <div class="col-lg-3 col-2">
            <!-- small box -->
            <div class="small-box bg-">
              <div class="inner">
                 <h3 style="color:">{{ $dados['total_total'][0]->qtd }} </h3>

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

  <div class="box-body table-responsive no-padding">
 <table id="tbl_atribuicao" class="table table-striped table-sm table-bordered dataTable">
   <thead>
      <tr class="bg-light text-center py-0 align-middle cabecalho">
        <th style="width:200px" colspan="19">
          <center>
            [Cadastros Teste Final]
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
          <center>Técnico</center>
        </th>
        <th class="cabecalho" style="width:60px">
          <center>Ordem</center>
        </th>
        <th class="cabecalho" style="width:60px">
          <center>Serviço</center>
        </th>
        <th class="cabecalho" style="width:60px">
          <center>Tecnologia</center>
        </th>
        <th class="cabecalho" style="width:100px">
          <center>Situação</center>
        </th>
        <th class="cabecalho" style="width:100px">
          <center>Regional</center>
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
      @foreach ($dados['tf'] as $gr)
      <tr>
        <td title="Observação: ">
          <center>

              {{ $qtdColuna++ }}

          </center>
        </td>
        <td title="Observação: ">
          <center>
         
              <center>
                {{ $gr->data_toa }}
              </center>
     
          </center>
        </td>
        <td title="Observação: ">
          <center>
        
              {{ $gr->provedor }}
         
          </center>
        </td>
        <td title="Observação: ">
          <center>
 
              {{ $gr->n_ordem }}

          </center>
        </td>
        <td title="Observação: ">
          <center>
   
              {{ $gr->tipo_ordem }}
          
          </center>
        </td>
        <td title="Observação: ">
          <center>
   
              {{ $gr->tipo_acesso }}

          </center>
        </td>
        <td title="Observação: ">
          <center>
           
              {{ $gr->estado }}

          </center>
        </td>
        <td title="Observação: ">
          <center>
            
              <center>
                {{ $gr->gerencia }}
              </center>
      
          </center>
        </td>
        <td>
          @if (Auth()->user()->perfil == 4 && $gr->estado != 'Concluída')
            <a class="btn btn-light btn-sm" href="{{ route('file.create', [$gr->tipo_acesso, $gr->n_ordem]) }}" title="Enviar Fotos">
              <i class="fas fa-solid fa-camera"></i>
            </a>
          @endif
          @if (Auth()->user()->perfil == 5)
            <a class="btn btn-light btn-sm" href="{{ route('file.edit', [$gr->tipo_acesso, $gr->n_ordem]) }}" title="Verificar checklist">
              <i class="fas fa-solid fa-exclamation-circle"></i>
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
        });
  });

  </script>
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
