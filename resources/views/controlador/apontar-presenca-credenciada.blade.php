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

            <form role="form" method="post" action="./novo_lancamento_presenca_controlador" enctype="multipart/form-data">
           {{ csrf_field()  }}
           
           

 <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data:</label>
                        <input type="date" class="form-control form-control-sm" name="data[]" style="background:#" value="<?php echo date('Y-m-d');?>">
                        </div>

    <div class="row">
      <div class="col-12">
    <div class="box-body table-responsive ">
        <table id="" class="table table-striped table-sm table-bordered ">
            <thead>
                <tr class="bg-light text- py-0 align-middle">
                    <th colspan="6" style="background-color:#;color:black;width:250px"><center>[Lançamento]</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
            <?php 
                $numero = 1;
                foreach ($dados['dados'] as $gr) {
                    echo '<tr class="bg- text- py-0 align-middle">
                            <td style="width:290px">  <center><b>'.$numero++.'º Técnico: <input type="text" class="form-control form-control-sm" name="tecnicos[]" style="background:#" value="'.$gr->tecnicos.'" readonly=""></td>
                            
                            <td> <center><b>1. Técnico está com rota ativa?
                             <select class="form-control form-control-sm" name="rota_ativa[]" required>
                                 <option selected disabled value=""></option>
                           <option value="S">SIM</option>
                            <option value="N">NÃO</option></select>
                            </td>
                            
                              <td><center><b>2. Técnico está com atividades atribuidas?
                             <select class="form-control form-control-sm" name="atividades_atribuidas[]" required>
                                 <option selected disabled value=""></option>
                           <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            </td>
                            
                             <td><center><b>3. Técnico está com atividade iniciada as 8h?
                             <select class="form-control form-control-sm" name="atividade_iniciada[]" required>
                                 <option selected disabled value=""></option>
                           <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            </td>
                           
                           <td><center> <center><b>4. As atividades iniciadas possuem CA?
                                <select name="atividade_iniciada_ca[]" class="form-control form-control-sm" value="" required>
                                <option selected disabled value=""></option>
                           <option value="S">SIM</option>
                            <option value="N">NÃO</option>

                                </select>
                            </td>
                            
                            <td><center><b>5. O técnico já está conectado no SuperApp?
                             <select class="form-control form-control-sm" name="superapp[]" required>
                                 <option selected disabled value=""></option>
                           <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            </td>
                            
                            </tr>
                            <tr>
                           
                    ';
                }
               
            ?>
        </tr>
    </tbody>
  </table>
  <button type="submit" class="btn btn-success">Salvar</button> </a>
                <a href="./index"><button type="button" class="btn btn-secondary">Retornar</button> </a>
              </div><br>
            </form>
        </div>
      </div>
      </div>

@section('js')
@stop
@stop
