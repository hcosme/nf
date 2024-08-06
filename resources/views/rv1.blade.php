@extends('adminlte::page')

@section('title', 'RV - Acessos')

@section('content_header')
  <!-- <h1 class="m-0 text-dark">Histórico RV</h1> -->
@stop

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
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
<h2> Acesso de RV</h2>
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?php echo $dados['acessos'][0]->qtd;?></h3>

                <p><a href="rv1?status=acesso" style="color:white">HC - Acesso</a></p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $dados['alteracao_senha'][0]->qtd;?></h3>

                <p><a href="rv1?status=alteracao_senha" style="color:white">HC - Pendente alteração senha</a></p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $dados['nunca_acessaram'][0]->qtd;?></h3>

                <p><a href="rv1?status=nunca_acessaram" style="color:white">HC - Nunca acessaram</a></p>
              </div>
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3><?php echo $dados['acessaram'][0]->qtd;?></h3>

                <p><a href="rv1?status=acessaram" style="color:white">HC - Acessaram</a></p>
              </div>
            </div>
          </div>
         
         </div>
</div>
</div>


</div>

   <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
  <div class="box-body table-responsive no-padding">
 <table id="minhaTabela2" class="table table-striped table-sm table-bordered dataTable">
    <thead>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[ACESSOS] </th> 
        </tr>
      <tr class="bg-light text-center py-0 align-middle">
        <th style=" background-color:#;color:black;width:60px"><center>ID</th>
        <th style=" background-color:#;color:black;width:260px"><center>NOME</th>
        <th style=" background-color:#;color:black;width:260px"><center>EMAIL</th>
            </tr>
    </thead>
    <tbody>
          
            <?php 
                foreach ($dados['usuarios'] as $gr) {
                    
                    echo '<tr class="bg- text-center py-0 align-middle">
                            <td>'.$gr->id.'</a></td>
                            <td>'.$gr->name.'</a></td>
                            <td>'.$gr->email.'</a></td>
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

      </div>
      
      
      
      
    <!--   
      
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
  <div class="box-body table-responsive no-padding">
<iframe width="1300" height="1150" src="https://datastudio.google.com/embed/reporting/9d1a8819-512e-4781-885e-f017c4d10ed5/page/XN2hC" frameborder="0" style="border:0" allowfullscreen></iframe>



              
           </div>
               </div>
      </div>
      </div> 
 -->

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
            },
        });
  });

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
        });
  });

  </script>

@stop
@stop
