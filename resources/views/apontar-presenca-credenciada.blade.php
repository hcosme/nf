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

            <form role="form" method="post" action="./novo_lancamento_presenca" enctype="multipart/form-data">
           {{ csrf_field()  }}
           
           

 <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data:</label>
                        <input type="date" class="form-control form-control-sm" name="data[]" style="background:#" value="<?php echo date('Y-m-d');?>">
                        </div>

    <div class="row">
      <div class="col-12">
    <div class="box-body table-responsive no-padding">
        <table id="" class="table table-striped table-sm table-bordered ">
            <thead>
                <tr class="bg-light text- py-0 align-middle">
                    <th style=" background-color:#;color:black;width:160px"><center>Nome</th>
                    <th style=" background-color:#;color:black;width:80px"><center>Status</th>
                    <th style=" background-color:#;color:black;width:80px"><center>Obs.</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $numero = 1;
                foreach ($dados['dados'] as $gr) {
                    echo '<tr class="bg- text- py-0 align-middle">
                            <td> <input type="text" class="form-control form-control-sm" name="tecnicos[]" style="background:#" value="'.$gr->tecnicos.'" readonly=""></td>
                            <input type="hidden" class="form-control form-control-sm" name="gerente[]" style="background:#" value="'.$gr->gerente.'" readonly="">
                             <input type="hidden" class="form-control form-control-sm" name="coordenador[]" style="background:#" value="'.$gr->coordenador.'" readonly="">
                             <input type="hidden" class="form-control form-control-sm" name="atividade[]" style="background:#" value="'.$gr->atividade.'" readonly="">
                             <input type="hidden" class="form-control form-control-sm" name="skill[]" style="background:#" value="'.$gr->skill.'" readonly="">
                             <input type="hidden" class="form-control form-control-sm" name="supervisor[]" style="background:#" value="'.$gr->supervisor.'" readonly="">
                              <input type="hidden" class="form-control form-control-sm" name="credenciada[]" style="background:#" value="'.$gr->credenciadas.'" readonly="">
                           <td><center> 
                                <select name="status[]" class="form-control form-control-sm" value="" required>
                                <option selected disabled value=""></option>
                                <option value="PRESENTE - CORRETIVA">PRESENTE - CORRETIVA</option>
                            
                        <option value="PRESENTE - PREVENTIVA">PRESENTE - PREVENTIVA</option>
                        <option value="PRESENTE - RESIDENTE">PRESENTE - RESIDENTE</option>
                        <option value="PRESENTE - IMPLANTAÇÃO">PRESENTE - IMPLANTAÇÃO</option>
                                <option value="ADEQUACAO">ADEQUAÇÃO</option>
                                <option value="ALIVIO">ALÍVIO</option>
                                <option value="MASSIVA">MASSIVA</option>
                         <option value="DP">DP</option>
                                
                                
                                <option value="SOBREAVISO">SOBREAVISO</option>
                                <option value="SOBREAVISO - ACIONADO">SOBREAVISO - ACIONADO</option>
                                <option value="NOTURNO">NOTURNO</option>
                                <option value="FOLGA - ESCALA">FOLGA - ESCALA</option>
                                <option value="INTERJORNADA">INTERJORNADA</option>
                           <option value="INSTALACAO_FTTC">INSTALACAO_FTTC</option>
                            <option value="INSTALACAO_FTTH">INSTALACAO_FTTH</option>
                            <option value="REPARO_FTTC">REPARO_FTTC</option>
                            <option value="REPARO_FTTH">REPARO_FTTH</option>
                            <option value="FALTA_S_JUSTIFICATIVA">FALTA_S_JUSTIFICATIVA</option>
                            <option value="FOLGA">FOLGA</option>
                            <option value="FERIAS">FERIAS</option>
                            <option value="DUPLADO">DUPLADO</option>
                            <option value="DSR">DSR</option>
                            <option value="ATESTADO">ATESTADO</option>
                            <option value="AFASTADO">AFASTADO</option>
                            <option value="DEMITIDO">DEMITIDO</option>
                            <option value="ALMOX">ALMOX</option>
                            <option value="RH">RH</option>
                            <option value="TREINAMENTO">TREINAMENTO</option>
                            <option value="SUSPENSAO">SUSPENSAO</option>
                            <option value="FROTA">FROTA</option>
                            <option value="EXAME_PERIODICO">EXAME_PERIODICO</option>
                            <option value="BLOQUEADO">BLOQUEADO</option>
                            <option value="REDE_BLINDADA">REDE_BLINDADA</option>
                            <option value="CAMPINAS - SPO">CAMPINAS - SPO</option>
                            <option value="CAMPINAS - Inloco">CAMPINAS - Inloco</option>
               

                                </select>
                            </td>
                            <td> <input type="text" class="form-control form-control-sm" name="obs[]" style="background:#" value=""></td>
                    ';
                }
            ?>

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
