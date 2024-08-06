@extends('adminlte::page')
@section('title', 'Instalação')
@section('content_header')
<!--  <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop
@section('content')

<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />



<div id="myModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Em ajuste.</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 

      </div>
          <div class="modal-body">
        <p>Em ajustes para inclusão do acompanhamento intra hora!</p>
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


</script>

-->
<?php
   //dd($dados['visaoGerente']);
   if (empty($dados['visaoGerente'])) {
       echo '<h2><center>EM ATUALIZAÇÃO.</center></h2>';
       die();
   }
   ?>
<div class="callout callout-secondary">
   <a class="btn btn-light" data-toggle="in" href="#collapseExample4" role="button" aria-expanded="true" aria-controls="collapseExample4">
   <i class="fa fa-minus-square" aria-hidden="true"></i> Abrir filtro
   </a>
   <p>
      <b>Fonte de dados:</b> TOA | <b>Última atualização: </b> <?php date_default_timezone_set('America/Sao_Paulo');
         echo date('d/m/Y H:i:s', strtotime($dados['AtualizacaoMontada'][0]->data_atualizacao));?>
      <IMG SRC="https://preloaders.evidweb.com/images/preloaders/ajax-loading-c7.gif" width="18px" heigh="18px">
   </p>
   <div class="in" id="collapseExample4">
      <form action="./instalacao_online" method="get">
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
               <label for="exampleInputEmail1">Tipo Atividade:</label>
               <select class="form-control form-control-md" name="tipo">
                  <?php if(isset($_GET['tipo'])) {
                     if ($_GET['tipo'] == 'TODOS') {
                       $nome = 'INST+MUD';
                     }
                     if ($_GET['tipo'] == 'INSTALACAO') {
                       $nome = 'INSTALAÇÃO';
                     }
                     if ($_GET['tipo'] == 'MUD') {
                       $nome = 'MUD. ENDEREÇO';
                     }
                     if ($_GET['tipo'] == 'MUD_TEC') {
                       $nome = 'MUD. TECNOLOGIA';
                     }
                     if ($_GET['tipo'] == 'DESCONEXAO') {
                       $nome = 'DESCONEXÃO';
                     }
                     /*  if ($_GET['tipo'] == 'ALMOCO') {
                       $nome = 'ALMOÇO';
                     } */
                     if ($_GET['tipo'] == 'ATIV. ESCRITORIO') {
                       $nome = 'ATIV. ESCRITÓRIO';
                     }
                     
                     echo '<option value="'.$_GET['tipo'].'">'.$nome.'| Seleção atual</option>';
                     };?>
                  <option value="TODOS">INST+MUD</option>
                  <!--    <option value="ALMOCO">ALMOÇO</option> -->
                  <option value="ATIV. ESCRITORIO">ATIV. ESCRITÓRIO</option>
                  <option value="INSTALACAO">INSTALAÇÃO</option>
                  <option value="MUD">MUD. ENDEREÇO</option>
                  <option value="MUD_TEC">MUD. TECNOLOGIA</option>
                  <option value="DESCONEXAO">DESCONEXÃO</option>
               </select>
            </div>
            <div class="form-group col-md-2">
               <label for="exampleInputEmail1">Tecnologia:</label>
               <select class="form-control form-control-md" name="tecnologia">
                  <?php if(isset($_GET['tecnologia'])) {
                     echo '<option value="'.$_GET['tecnologia'].'">'.$_GET['tecnologia'].'| Seleção atual</option>';
                     };?>
                  <option value="TODOS">TODOS</option>
                  <option value="FTTH">FTTH</option>
                  <option value="FTTC">FTTC</option>
               </select>
            </div>
            <div class="form-group col-md-2">
               <label for="exampleInputEmail1">Filial:</label>
               <select class="form-control form-control-md" name="filial">
                  <?php if(isset($_GET['filial'])) {
                     echo '<option value="'.$_GET['filial'].'">'.$_GET['filial'].'| Seleção atual</option>';
                     };?>
                  <option value="TODOS">TODOS</option>
                  <option value="SP">SP</option>
                  <option value="DF">DF</option>
                  <option value="GO">GO</option>
               </select>
            </div>
            <div class="form-group col-md-1">
               <label for="exampleInputEmail1"><b style="color: white">.</b></label>
               <input  type="submit" class="form-control form-control-md btn btn-secondary" value="Filtrar">
            </div>
      </form>
      <div class="form-group col-md-1">
      <label for="exampleInputEmail1"><b style="color: white">.</b></label>
      <a href="https://gestaoderecursos.com/exportacao/producao.php" ><input  type="button" class="form-control form-control-md btn btn-secondary" value="Baixar excel"></a>
      </div> 
      </div>
   </div>
</div>
<?php //dd($dados['visaoFFA']);?>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <table id="minhaTabçççela" class="table table-responsive table-sm table-bordered table-hover dataTable">
               <thead>
                  <tr class="bg-light text- py-0 align-middle">
                     <th style=" background-color:#;color:black;width:200px" colspan="23">[INSTALAÇÃO <?php 
                        if (!empty($_GET['tecnologia'])) {
                          echo ' | TECNOLOGIA: '.$_GET['tecnologia'].' | FILIAL: '.$_GET['filial'];
                        } 
                        ?>
                        ] 
                     </th>
                  </tr>
                  <tr class="bg-light text-center py-0 align-middle">
                     <th style=" background-color:#;color:black;width:10">
                        <center>
                        Filial
                     </th>
                     <th style=" background-color:#;color:black;width:260px">
                        <center>
                        Gerência
                     </th>
                     <!--  <th style=" background-color:#;color:black;width:20px" title="Total de efetivo bruto."><center>HC</th> -->
                     <th style=" background-color:#;color:black;width:20px" title="Total de técnicos com atividade no TOA.">
                        <center>
                        Presença
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Volume de produção acordado.">
                        <center>
                        Meta
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Total de atividades executados no TOA.">
                        <center>
                        Concluído
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="concluído + ((iniciados + não iniciados) * (pendência/(pendência + concluídas)).">
                        <center>
                        Proj.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Presença skill x Meta skill (FTTH = 2,0 | FTTC = 2,5).">
                        <center>
                        Capac.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="(Concluído - Meta)">
                        <center>
                        Gap
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades canceladas no TOA.">
                        <center>
                        Canc.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades pendenciadas no TOA.">
                        <center>
                        Pend.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades suspensas no TOA.">
                        <center>
                        Susp.
                     </th>
                     <th style=" background-color:#;color:black;width:30px" title="(Atividades pendenciadas / Visitas)">
                        <center>
                        Efic.
                     </th>
                     <th style=" background-color:#;color:black;width:30px" title="(Total de atividades executadas / Presença)">
                        <center>
                        Produt.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades iniciadas no TOA.">
                        <center>
                        Iniciado
                     </th>
                     <th style=" background-color:#;color:black;width:120px" title="Atividades não iniciadas no TOA.">
                        <center>
                        Não Inic.
                     </th>
                     <th style=" background-color:#;color:black;width:120px" title="Atividades não iniciadas + iniciadas no TOA.">
                        <center>
                        Em campo
                     </th>
                     <th style=" background-color:#;color:black;width:70px" title="Total de Atividades despachadas no TOA.">
                        <center>
                        Desp.
                     </th>
                     <th style=" background-color:#;color:black;width:100px" title="Média de Atividades despachadas no TOA.">
                        <center>
                        Med. Desp.
                     </th>
                     <!--
                        <th style=" background-color:#;color:black;width:70px" title="Total de técnicos sem atividades na caixa."><center>S/ Ativ.</th>
                        <th style=" background-color:#;color:black;width:20px" title="Total de técnicos com atividades a iniciar, porém não foram iniciadas."><center>Ociosos</th>
                        <th style=" background-color:#;color:black;width:20px" title="Total de técnicos que não produziram nada até o momento."><center>Zerados</th>
                        <th style=" background-color:#;color:black;width:70px" title="Total de técnicos que executaram apenas 01 atividade."><center>01 Prod.</th>
                        <th style=" background-color:#;color:black;width:70px" title="Total de técnicos com tempo de execução superior ao orçado."><center>BA Longo</th> -->
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $ffa = $dados['visaoFFA'][0];
                     if (! empty($dados['visaoGerente'])) {
                     
                     foreach ($dados['visaoGerente'] as $gr) {
                         if ($gr->gap > 0) {
                             $cor = ' style="background-color:green;color:white"';
                         } else {
                             $cor = ' style="background-color:red;color:white"';
                         }
                     
                          if ($gr->eficiencia > 90) {
                             $corEficiencia = ' style="background-color:green;color:white"';
                         } else {
                             $corEficiencia = ' style="background-color:red;color:white"';
                         }
                         
                         if ($gr->realizado == 0 || $gr->presenca == 0 ) {
                             $produt = 0.00;
                             
                         } else {
                             $produt = round(($gr->realizado/$gr->presenca),2);
                             
                         }
                         
                         if ($produt > 2) {
                             $corProd = ' style="color:green"';
                         } else {
                             $corProd = ' style="color:red"';
                         }
                         
                         if ($gr->pendente == 0 || $gr->realizado == 0) {
                             $projecao2 = $gr->realizado + (($gr->iniciado + $gr->nao_iniciado));
                         } else {
                             $projecao2 = (($gr->iniciado + $gr->nao_iniciado) * (1-$gr->pendente / $gr->realizado)+$gr->realizado);
                         }
                         
                         if (($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente) == 0 || $gr->presenca == 0) {
                             $med_despachada = 0;
                         } else {
                             $med_despachada = round((($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente)/$gr->presenca),2);
                         }
                         
                         if (($projecao2-($gr->presenca*3.1)) >= 0 ) {
                             $corProjecao = ' style="background-color:green;color:white"';
                         } else {
                             $corProjecao = ' style="background-color:red;color:white"';
                         }
                         
                         $linhas = count(array($gr->filial));
                         
                         echo '<tr class="bg- text-center py-0 align-middle">
                                 <td rowspan = "'.$linhas.'">'.$gr->filial.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio=&fim=&presenca=1&gerente='.$gr->gerente.'&coordenador=TODOS&supervisor=TODOS&tecnologia=TODOS&tipo=TODOS&situacao=1">'.$gr->gerente.'</td>
                                 <td>'.$gr->presenca.'</td>
                                 <td>'.round($gr->presenca*3.1,0).'</td>
                                 <td>'.$gr->realizado.'</td>
                                 <td>'.round($projecao2,0).'</td>
                                 <td>'.round($gr->capacidade,0).'</td>
                                 <td '.$corProjecao.'>'.round(($projecao2-($gr->presenca*3.1)),0).'</td>
                                 <td>'.$gr->cancelada.'</td>
                                 <td>'.$gr->pendente.'</td>
                                 <td>'.$gr->suspenso.'</td>
                                 <td'.$corEficiencia.'>'.$gr->eficiencia.'%</td>
                                 <td'.$corProd.'>'.$produt.'</td>
                                 <td>'.$gr->iniciado.'</td>
                                 <td>'.$gr->nao_iniciado.'</td>
                                 <td>'.($gr->iniciado+$gr->nao_iniciado).'</td>
                                 <td>'.($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente).'</td>
                                 <td>'.$med_despachada.'</td>'; 
                                 /*<td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente='.$gr->gerente.'&coordenador=TODOS&supervisor=TODOS&tecnologia=TODOS&sem_atividade=1">'.$gr->sem_atividade.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente='.$gr->gerente.'&coordenador=TODOS&supervisor=TODOS&tecnologia=TODOS&ocioso=1">'.$gr->ocioso.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente='.$gr->gerente.'&coordenador=TODOS&supervisor=TODOS&tecnologia=TODOS&zerado_ok=1">'.$gr->zerado_ok.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente='.$gr->gerente.'&coordenador=TODOS&supervisor=TODOS&tecnologia=TODOS&producao_01=1">'.$gr->producao_01.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente='.$gr->gerente.'&coordenador=TODOS&supervisor=TODOS&tecnologia=TODOS&producao_01=1">'.$gr->flag_ba_longo.'</td>
                              */
                     }
                     }
                       if ($ffa->gap > 0) {
                             $corFFA = ' style="background-color:green;color:white;"';
                         } else {
                             $corFFA = ' style="background-color:red;color:white;"';
                         }
                           if ($ffa->eficiencia > 90) {
                             $corEficienciaFFA = ' style="background-color:green;color:white"';
                         } else {
                             $corEficienciaFFA = ' style="background-color:red;color:white"';
                         }
                        
                          if ($ffa->realizado == 0|| $ffa->presenca == 0) {
                             $produt = 0.00;
                             
                         } else {
                             $produt = round(($ffa->realizado/$ffa->presenca),2);
                             
                         }
                     
                        
                        
                         if ($produt > 2) {
                             $corProd = ' style="color:green"';
                         } else {
                             $corProd = ' style="color:red"';
                         }
                         
                           if ($gr->pendente == 0 || $gr->realizado == 0) {
                             $projecao1 = $ffa->realizado + (($ffa->iniciado + $ffa->nao_iniciado));
                         } else {
                             $projecao1 = (($ffa->iniciado + $ffa->nao_iniciado) * (1-$ffa->pendente / $ffa->realizado)+$ffa->realizado);
                         }
                         
                         if (($ffa->iniciado+$ffa->nao_iniciado+$ffa->realizado+$ffa->pendente) == 0 || $ffa->presenca == 0) {
                             $med_despachada = 0;
                         } else {
                             $med_despachada = round((($ffa->iniciado+$ffa->nao_iniciado+$ffa->realizado+$ffa->pendente)/$ffa->presenca),2);
                         }
                         
                          if (($projecao1-($gr->presenca*3.1)) <= 0 ) {
                             $corProjecao = ' style="background-color:green;color:white"';
                         } else {
                             $corProjecao = ' style="background-color:red;color:white"';
                         }
                        
                        // dd($corFFA);
                         echo '<tr class="bg-light text-center py-0 align-middle">
                                 <td colspan="2"><b>TOTAL</td>
                                 <td><b>'.$ffa->presenca.'</td>
                                 <td><b>'.round($ffa->presenca*3.1,0).'</td>
                                 <td><b>'.$ffa->realizado.'</td>
                                 <td><b>'.round($projecao1,0).'</td>
                                 <td><b>'.round($ffa->capacidade,0).'</td>
                                 <td'.$corProjecao.'><b>'.round(($projecao1-($ffa->presenca*3.1)),0).'</td>
                                 <td><b>'.$ffa->cancelada.'</td>
                                 <td><b>'.$ffa->pendente.'</td>
                                 <td><b>'.$ffa->suspenso.'</td>
                                 <td'.$corEficienciaFFA.'><b>'.$ffa->eficiencia.'%</td>
                                 <td'.$corProd.'><b>'.$produt.'</td>
                                 <td><b>'.$ffa->iniciado.'</td>
                                 <td><b>'.$ffa->nao_iniciado.'</td>
                                 <td><b>'.($ffa->nao_iniciado+$ffa->iniciado).'</td>
                                 <td><b>'.($ffa->iniciado+$ffa->nao_iniciado+$ffa->realizado+$ffa->pendente).'</td>
                                 <td><b>'.$med_despachada.'</td>
                                            </tr>
                         '; /*
                                 <td><b>'.$ffa->sem_atividade.'</td>
                                 <td><b>'.$ffa->ocioso.'</td>
                                 <td><b>'.$ffa->zerado_ok.'</td>
                                 <td><b>'.$ffa->producao_01.'</td>
                                 
                                 <td><b>'.$ffa->flag_ba_longo.'</td> */
                     
                      
                     ?>
               </tbody>
            </table>
            </form>
            <br>
            <table id="minhaTkkabela" class="table table-responsive table-striped table-sm table-bordered table-hover dataTable">
               <thead>
                  <tr class="bg-light text- py-0 align-middle">
                     <th style=" background-color:#;color:black;width:200px" colspan="23">[INSTALAÇÃO COORDENAÇÃO <?php 
                        if (!empty($_GET['tecnologia'])) {
                          echo ' | TECNOLOGIA: '.$_GET['tecnologia'].' | FILIAL: '.$_GET['filial'];
                        } 
                        ?>
                        ] 
                     </th>
                  </tr>
                  <tr class="bg-light text-center py-0 align-middle">
                     <th style=" background-color:#;color:black;width:20">
                        <center>
                        Filial
                     </th>
                     <th style=" background-color:#;color:black;width:260px">
                        <center>
                        Coordenador
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Total de técnicos com atividade no TOA.">
                        <center>
                        Presença
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Volume de produção acordado.">
                        <center>
                        Meta
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Total de atividades executados no TOA.">
                        <center>
                        Concluído
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="concluído + ((iniciados + não iniciados) * (pendência/(pendência + concluídas)).">
                        <center>
                        Proj.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Presença skill x Meta skill (FTTH = 2,0 | FTTC = 2,5).">
                        <center>
                        Capac.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="(Concluído - Meta)">
                        <center>
                        Gap
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades canceladas no TOA.">
                        <center>
                        Canc.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades pendenciadas no TOA.">
                        <center>
                        Pend.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades suspenso no TOA.">
                        <center>
                        Susp.
                     </th>
                     <th style=" background-color:#;color:black;width:30px" title="(Atividades pendenciadas / Visitas)">
                        <center>
                        Efic.
                     </th>
                     <th style=" background-color:#;color:black;width:30px" title="(Total de atividades executadas / Presença)">
                        <center>
                        Produt.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades iniciadas no TOA.">
                        <center>
                        Iniciado
                     </th>
                     <th style=" background-color:#;color:black;width:120px" title="Atividades não iniciadas no TOA.">
                        <center>
                        Não Inic.
                     </th>
                     <th style=" background-color:#;color:black;width:120px" title="Atividades não iniciadas + iniciadas no TOA.">
                        <center>
                        Em campo
                     </th>
                     <th style=" background-color:#;color:black;width:70px" title="Total de Atividades despachadas no TOA.">
                        <center>
                        Desp.
                     </th>
                     <th style=" background-color:#;color:black;width:100px" title="Média de Atividades despachadas no TOA.">
                        <center>
                        Med. Desp.
                     </th>
                     <!--
                        <th style=" background-color:#;color:black;width:70px" title="Total de técnicos sem atividades na caixa."><center>S/ Ativ.</th>
                        <th style=" background-color:#;color:black;width:20px" title="Total de técnicos com atividades a iniciar, porém não foram iniciadas."><center>Ociosos</th>
                        <th style=" background-color:#;color:black;width:20px" title="Total de técnicos que não produziram nada até o momento."><center>Zerados</th>
                        <th style=" background-color:#;color:black;width:70px" title="Total de técnicos que executaram apenas 01 atividade."><center>01 Prod.</th>
                        <th style=" background-color:#;color:black;width:70px" title="Total de técnicos que executaram apenas 01 atividade."><center>BA Longo</th> -->
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     foreach ($dados['visaoCoordenador'] as $gr) {
                          if ($gr->gap > 0) {
                             $cor = ' style="background-color:green;color:white"';
                         } else {
                             $cor = ' style="background-color:red;color:white"';
                         }
                     
                          if ($gr->eficiencia > 90) {
                             $corEficiencia = ' style="background-color:green;color:white"';
                         } else {
                             $corEficiencia = ' style="background-color:red;color:white"';
                         }
                         
                         
                         if ($gr->realizado == 0 || $gr->presenca == 0 ) {
                             $produt = 0.00;
                             
                         } else {
                             $produt = round(($gr->realizado/$gr->presenca),2);
                             
                         }
                         
                         
                          if ($produt > 2) {
                             $corProd = ' style="color:green"';
                         } else {
                             $corProd = ' style="color:red"';
                         }
                     
                           if ($gr->pendente == 0 || $gr->realizado == 0) {
                             $projecao = $gr->realizado + $gr->iniciado + $gr->nao_iniciado;
                         } else {
                             $projecao = (($gr->iniciado + $gr->nao_iniciado) * (1-$gr->pendente / $gr->realizado)+$gr->realizado);
                         }
                         
                         if (($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente) == 0 || $gr->presenca == 0) {
                             $med_despachada = 0;
                         } else {
                             $med_despachada = round((($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente)/$gr->presenca),2);
                         }
                          
                         if (($projecao-($gr->presenca*3.1)) >= 0 ) {
                             $corProjecao = ' style="background-color:green;color:white"';
                         } else {
                             $corProjecao = ' style="background-color:red;color:white"';
                         }
                        
                         
                         echo '<tr class="bg- text-center py-0 align-middle">
                                 <td rowspan="'.$linhas.'">'.$gr->filial.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio=&fim=&presenca=1&coordenador='.$gr->coordenador.'&gerente=TODOS&supervisor=TODOS&tecnologia=TODOS&tipo=TODOS&situacao=1">'.$gr->coordenador.'</td>
                                 <td>'.$gr->presenca.'</td>
                                 <td>'.round($gr->presenca*3.1,0).'</td>
                                 <td>'.$gr->realizado.'</td>
                                 <td>'.round($projecao,0).'</td>
                                 <td>'.round($gr->capacidade,0).'</td>
                                 <td '.$corProjecao.'>'.round(($projecao-($gr->presenca*3.1)),0).'</td>
                                 <td>'.$gr->cancelada.'</td>
                                 <td>'.$gr->pendente.'</td>
                                 <td>'.$gr->suspenso.'</td>
                                 <td'.$corEficiencia.'>'.$gr->eficiencia.'%</td>
                                 <td'.$corProd.'>'.$produt.'</td>
                                 <td>'.$gr->iniciado.'</td>
                                 <td>'.$gr->nao_iniciado.'</td>
                                 <td>'.($gr->nao_iniciado+$gr->iniciado).'</td>
                                 <td>'.($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente).'</td>
                                 <td>'.$med_despachada.'</td>
                                       </tr>
                     
                         '; /*
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador='.$gr->coordenador.'&supervisor=TODOS&tecnologia=TODOS&sem_atividade=1">'.$gr->sem_atividade.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador='.$gr->coordenador.'&supervisor=TODOS&tecnologia=TODOS&ocioso=1">'.$gr->ocioso.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador='.$gr->coordenador.'&supervisor=TODOS&tecnologia=TODOS&zerado_ok=1">'.$gr->zerado_ok.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador='.$gr->coordenador.'&supervisor=TODOS&tecnologia=TODOS&producao_01=1">'.$gr->producao_01.'</td>
                                   <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador='.$gr->coordenador.'&supervisor=TODOS&tecnologia=TODOS&producao_01=1">'.$gr->flag_ba_longo.'</td>
                             
                             */
                           
                     }
                     ?>
               </tbody>
            </table>
            <br>
            <table id="minhaTabelaçç" class="table table-responsive table-striped table-sm table-bordered table-hover dataTable">
               <thead>
                  <tr class="bg-light text- py-0 align-middle">
                     <th style=" background-color:#;color:black;width:200px" colspan="23">[INSTALAÇÃO SUPERVISÃO <?php 
                        if (!empty($_GET['tecnologia'])) {
                          echo ' | TECNOLOGIA: '.$_GET['tecnologia'].' | FILIAL: '.$_GET['filial'];
                        } 
                        ?>
                        ] 
                     </th>
                  </tr>
                  <tr class="bg-light text-center py-0 align-middle">
                     <th style=" background-color:#;color:black;width:20px">
                        <center>
                        Filial
                     </th>
                     <th style=" background-color:#;color:black;width:260px">
                        <center>
                        Supervisão
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Total de técnicos com atividade no TOA.">
                        <center>
                        Presença
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Volume de produção acordado.">
                        <center>
                        Meta
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Total de atividades executados no TOA.">
                        <center>
                        Concluído
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="concluído + ((iniciados + não iniciados) * (pendência/(pendência + concluídas)).">
                        <center>
                        Proj.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Presença skill x Meta skill (FTTH = 2,0 | FTTC = 2,5).">
                        <center>
                        Capac.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="(Concluído - Meta)">
                        <center>
                        Gap
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades canceladas no TOA.">
                        <center>
                        Canc.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades pendenciadas no TOA.">
                        <center>
                        Pend.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades suspenso no TOA.">
                        <center>
                        Susp.
                     </th>
                     <th style=" background-color:#;color:black;width:30px" title="(Atividades pendenciadas / Visitas)">
                        <center>
                        Efic.
                     </th>
                     <th style=" background-color:#;color:black;width:30px" title="(Total de atividades executadas / Presença)">
                        <center>
                        Produt.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades iniciadas no TOA.">
                        <center>
                        Iniciado
                     </th>
                     <th style=" background-color:#;color:black;width:120px" title="Atividades não iniciadas no TOA.">
                        <center>
                        Não Inic.
                     </th>
                     <th style=" background-color:#;color:black;width:120px" title="Atividades não iniciadas + iniciadas no TOA.">
                        <center>
                        Em campo
                     </th>
                     <th style=" background-color:#;color:black;width:70px" title="Total de Atividades despachadas no TOA.">
                        <center>
                        Desp.
                     </th>
                     <th style=" background-color:#;color:black;width:100px" title="Média de Atividades despachadas no TOA.">
                        <center>
                        Med. Desp.
                     </th>
                     <!--
                        <th style=" background-color:#;color:black;width:70px" title="Total de técnicos sem atividades na caixa."><center>S/ Ativ.</th>
                        <th style=" background-color:#;color:black;width:20px" title="Total de técnicos com atividades a iniciar, porém não foram iniciadas."><center>Ociosos</th>
                        <th style=" background-color:#;color:black;width:20px" title="Total de técnicos que não produziram nada até o momento."><center>Zerados</th>
                        <th style=" background-color:#;color:black;width:70px" title="Total de técnicos que executaram apenas 01 atividade."><center>01 Prod.</th>
                        <th style=" background-color:#;color:black;width:70px" title="Total de técnicos que executaram apenas 01 atividade."><center>BA Longo.</th> -->
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     foreach ($dados['visaoSupervisor'] as $gr) {
                                             if ($gr->gap > 0) {
                             $cor = ' style="background-color:green;color:white"';
                         } else {
                             $cor = ' style="background-color:red;color:white"';
                         }
                         
                         
                          
                         if ($gr->realizado == 0 || $gr->presenca == 0 ) {
                             $produt = 0.00;
                             
                         } else {
                             $produt = round(($gr->realizado/$gr->presenca),2);
                             
                         }
                     
                          if ($gr->eficiencia > 90) {
                             $corEficiencia = ' style="background-color:green;color:white"';
                         } else {
                             $corEficiencia = ' style="background-color:red;color:white"';
                         }
                          if ($produt > 2) {
                             $corProd = ' style="color:green"';
                         } else {
                             $corProd = ' style="color:red"';
                         }
                         
                                 
                         if ($gr->pendente == 0 || $gr->realizado == 0) {
                             $projecao = $gr->realizado + $gr->iniciado + $gr->nao_iniciado;
                         } else {
                             $projecao = (($gr->iniciado + $gr->nao_iniciado) * (1-$gr->pendente / $gr->realizado)+$gr->realizado);
                         } 
                           if (($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente) == 0 || $gr->presenca == 0) {
                             $med_despachada = 0;
                         } else {
                             $med_despachada = round((($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente)/$gr->presenca),2);
                         }
                         
                         if (($projecao-($gr->presenca*3.1)) >= 0 ) {
                             $corProjecao = ' style="background-color:green;color:white"';
                         } else {
                             $corProjecao = ' style="background-color:red;color:white"';
                         }
                         
                         echo '<tr class="bg- text-center py-0 align-middle">
                                 <td>'.$gr->filial.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio=&fim=&presenca=1&supervisor='.$gr->supervisor.'&gerente=TODOS&coordenador=TODOS&tecnologia=TODOS&tipo=TODOS&situacao=1">'.substr($gr->supervisor, 0, 33).'</td>                            
                                 <td>'.$gr->presenca.'</td>
                                 <td>'.round($gr->presenca*3.1,0).'</td>
                                 <td>'.$gr->realizado.'</td>
                                 <td>'.round($projecao,0).'</td>
                                 <td>'.round($gr->capacidade,0).'</td>
                                 <td '.$corProjecao.'>'.round(($projecao-($gr->presenca*3.1)),0).'</td>
                                 <td>'.$gr->cancelada.'</td>
                                 <td>'.$gr->pendente.'</td>
                                 <td>'.$gr->suspenso.'</td>
                                 <td'.$corEficiencia.'>'.$gr->eficiencia.'%</td>
                                 <td'.$corProd.'>'.$produt.'</td>
                                 <td>'.$gr->iniciado.'</td>
                                 <td>'.$gr->nao_iniciado.'</td>
                                 <td>'.($gr->nao_iniciado+$gr->iniciado).'</td>
                                 <td>'.($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente).'</td>
                                 <td>'.$med_despachada.'</td>'; /*
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador=TODOS&supervisor='.$gr->supervisor.'&tecnologia=TODOS&sem_atividade=1">'.$gr->sem_atividade.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador=TODOS&supervisor='.$gr->supervisor.'&tecnologia=TODOS&ocioso=1">'.$gr->ocioso.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador=TODOS&supervisor='.$gr->supervisor.'&tecnologia=TODOS&zerado_ok=1">'.$gr->zerado_ok.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador=TODOS&supervisor='.$gr->supervisor.'&tecnologia=TODOS&producao_01=1">'.$gr->producao_01.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador=TODOS&supervisor='.$gr->supervisor.'&tecnologia=TODOS&producao_01=1">'.$gr->flag_ba_longo.'</td>                            </tr>
                                 */
                         
                     }
                     ?>
               </tbody>
            </table>
            <br>
            <table id="minhaTabelaçç" class="table table-responsive table-striped table-sm table-bordered table-hover dataTable">
               <thead>
                  <tr class="bg-light text- py-0 align-middle">
                     <th style=" background-color:#;color:black;width:200px" colspan="23">[INSTALAÇÃO FISCAL <?php 
                        if (!empty($_GET['tecnologia'])) {
                          echo ' | TECNOLOGIA: '.$_GET['tecnologia'].' | FILIAL: '.$_GET['filial'];
                        } 
                        ?>
                        ] 
                     </th>
                  </tr>
                  <tr class="bg-light text-center py-0 align-middle">
                     <th style=" background-color:#;color:black;width:20px">
                        <center>
                        Filial
                     </th>
                     <th style=" background-color:#;color:black;width:260px">
                        <center>
                        Fiscal
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Total de técnicos com atividade no TOA.">
                        <center>
                        Presença
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Volume de produção acordado.">
                        <center>
                        Meta
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Total de atividades executados no TOA.">
                        <center>
                        Concluído
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="concluído + ((iniciados + não iniciados) * (pendência/(pendência + concluídas)).">
                        <center>
                        Proj.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Presença skill x Meta skill (FTTH = 2,0 | FTTC = 2,5).">
                        <center>
                        Capac.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="(Concluído - Meta)">
                        <center>
                        Gap
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades canceladas no TOA.">
                        <center>
                        Canc.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades pendenciadas no TOA.">
                        <center>
                        Pend.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades suspenso no TOA.">
                        <center>
                        Susp.
                     </th>
                     <th style=" background-color:#;color:black;width:30px" title="(Atividades pendenciadas / Visitas)">
                        <center>
                        Efic.
                     </th>
                     <th style=" background-color:#;color:black;width:30px" title="(Total de atividades executadas / Presença)">
                        <center>
                        Produt.
                     </th>
                     <th style=" background-color:#;color:black;width:20px" title="Atividades iniciadas no TOA.">
                        <center>
                        Iniciado
                     </th>
                     <th style=" background-color:#;color:black;width:120px" title="Atividades não iniciadas no TOA.">
                        <center>
                        Não Inic.
                     </th>
                     <th style=" background-color:#;color:black;width:120px" title="Atividades não iniciadas + iniciadas no TOA.">
                        <center>
                        Em campo
                     </th>
                     <th style=" background-color:#;color:black;width:70px" title="Total de Atividades despachadas no TOA.">
                        <center>
                        Desp.
                     </th>
                     <th style=" background-color:#;color:black;width:100px" title="Média de Atividades despachadas no TOA.">
                        <center>
                        Med. Desp.
                     </th>
                     <!--
                        <th style=" background-color:#;color:black;width:70px" title="Total de técnicos sem atividades na caixa."><center>S/ Ativ.</th>
                        <th style=" background-color:#;color:black;width:20px" title="Total de técnicos com atividades a iniciar, porém não foram iniciadas."><center>Ociosos</th>
                        <th style=" background-color:#;color:black;width:20px" title="Total de técnicos que não produziram nada até o momento."><center>Zerados</th>
                        <th style=" background-color:#;color:black;width:70px" title="Total de técnicos que executaram apenas 01 atividade."><center>01 Prod.</th> -->
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     foreach ($dados['visaoFiscal'] as $gr) {
                                             if ($gr->gap > 0) {
                             $cor = ' style="background-color:green;color:white"';
                         } else {
                             $cor = ' style="background-color:red;color:white"';
                         }
                         
                         
                          
                         if ($gr->realizado == 0 || $gr->presenca == 0 ) {
                             $produt = 0.00;
                             
                         } else {
                             $produt = round(($gr->realizado/$gr->presenca),2);
                             
                         }
                     
                          if ($gr->eficiencia > 90) {
                             $corEficiencia = ' style="background-color:green;color:white"';
                         } else {
                             $corEficiencia = ' style="background-color:red;color:white"';
                         }
                          if ($produt > 2) {
                             $corProd = ' style="color:green"';
                         } else {
                             $corProd = ' style="color:red"';
                         }
                         
                                 
                         if ($gr->pendente == 0 || $gr->realizado == 0) {
                             $projecao = $gr->realizado + $gr->iniciado + $gr->nao_iniciado;
                         } else {
                             $projecao = (($gr->iniciado + $gr->nao_iniciado) * (1-$gr->pendente / $gr->realizado)+$gr->realizado);
                         } 
                           if (($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente) == 0 || $gr->presenca == 0) {
                             $med_despachada = 0;
                         } else {
                             $med_despachada = round((($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente)/$gr->presenca),2);
                         }
                         
                         if (($projecao-($gr->presenca*3.1)) >= 0 ) {
                             $corProjecao = ' style="background-color:green;color:white"';
                         } else {
                             $corProjecao = ' style="background-color:red;color:white"';
                         }
                         
                         
                         echo '<tr class="bg- text-center py-0 align-middle">
                                 <td>'.$gr->filial.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio=&fim=&presenca=1&supervisor=TODOS&fiscal='.$gr->fiscal.'&gerente=TODOS&coordenador=TODOS&tecnologia=TODOS">'.substr($gr->fiscal, 0, 33).'</td>                            
                                 <td>'.$gr->presenca.'</td>
                                 <td>'.round($gr->presenca*3.1,0).'</td>
                                 <td>'.$gr->realizado.'</td>
                                 <td>'.round($projecao,0).'</td>
                                 <td>'.round($gr->capacidade,0).'</td>
                                 <td '.$corProjecao.'>'.round(($projecao-($gr->presenca*3.1)),0).'</td>
                                 <td>'.$gr->cancelada.'</td>
                                 <td>'.$gr->pendente.'</td>
                                 <td>'.$gr->suspenso.'</td>
                                 <td'.$corEficiencia.'>'.$gr->eficiencia.'%</td>
                                 <td'.$corProd.'>'.$produt.'</td>
                                 <td>'.$gr->iniciado.'</td>
                                 <td>'.$gr->nao_iniciado.'</td>
                                 <td>'.($gr->nao_iniciado+$gr->iniciado).'</td>
                                 <td>'.($gr->iniciado+$gr->nao_iniciado+$gr->realizado+$gr->pendente).'</td>
                                 <td>'.$med_despachada.'</td>      </tr>
                     
                         ';
                         /*
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador=TODOS&fiscal='.$gr->fiscal.'&supervisor=TODOS&tecnologia=TODOS&sem_atividade=1">'.$gr->sem_atividade.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador=TODOS&fiscal='.$gr->fiscal.'&supervisor=TODOS&tecnologia=TODOS&ocioso=1">'.$gr->ocioso.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador=TODOS&fiscal='.$gr->fiscal.'&supervisor=TODOS&tecnologia=TODOS&zerado_ok=1">'.$gr->zerado_ok.'</td>
                                 <td><a href="./instalacao_online_tecnico?inicio='.date('Y-m-d').'&fim='.date('Y-m-d').'&presenca=1&gerente=TODOS&coordenador=TODOS&fiscal='.$gr->fiscal.'&supervisor=TODOS&tecnologia=TODOS&producao_01=1">'.$gr->producao_01.'</td>
                              */
                           
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
     $('#minhaTabela').DataTable({
         "language": {
               "lengthMenu": "Mostrando _MENU_ registros por página",
               "zeroRecords": "Nada encontrado",
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
     $('#minhaTabela2').DataTable({
         "language": {
               "lengthMenu": "Mostrando _MENU_ registros por página",
               "zeroRecords": "Nada encontrado",
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