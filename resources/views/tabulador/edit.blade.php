{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Cadastro')

@section('content_header')
@stop
<?php //dd('aqui');?>
@section('content')

<style>
#circuloVerde {
width: 10px;
height: 10px;
border-radius: 50%;
background-color: #00FF00;
margin: 0px;
}
#circuloVermelho {
width: 10px;
height: 10px;
border-radius: 50%;
background-color: #FF0000;
margin: 0px;
}
#circuloAmarelo {
width: 10px;
height: 10px;
border-radius: 50%;
background-color: #FA5858 ;
margin: 0px;
}
.blink_me {
  animation: blinker 1s linear infinite;
}
@keyframes blinker {  
  50% { opacity: 0; }
}

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

#botao {
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        margin: 0 auto; 
    
}

@keyframes blinker {  
  50% { opacity: 0; }
}

</style>


<style type="text/css">

.main-sidebar {
    display: none;
}

.main-header{
    display: none;
}
</style>
    
    
    <div oncontextmenu="return false"  class="callout callout-info">
     
      </div>
      <div   class="callout callout-info">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border"  >
              <h3 class="box-title"></h3>
            </div>
           
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="./tabulador-update">
              <div class="box-body">

                {{ csrf_field()  }}
              <br>
                <div class="col-lg-12"  >     
                  <h5 style="color:#;"><b>Dados da Básicos</b>   
                  </h5>
                 
                  <hr>
              <div class="row"  >
                
                     <div class="form-group col-md-1">
                        <label for="exampleInputEmail1">ID:</label>
                        <input type="text" class="form-control form-control-sm" name="id" style="background:#" value="<?php echo  $dados['dados'][0]->id;?>" readonly="">
                    </div>
                
                    
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Provedor:</label>
                        <input type="text" class="form-control form-control-sm" name="PROVEDOR" style="background:#" value="<?php echo  $dados['dados'][0]->PROVEDOR;?>" readonly="">
                    </div>
                
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">N Ordem:</label>
                        <input type="text" class="form-control form-control-sm" name="N_ORDEM" style="background:#" value="<?php echo  $dados['dados'][0]->N_ORDEM;?>" readonly>
                    </div>
                        <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Produto:</label>
                        <input type="text" class="form-control form-control-sm" name="PRODUTO" style="background:#" value="<?php echo  $dados['dados'][0]->PRODUTO;?>" readonly>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="exampleInputEmail1">Atividade:</label>
                        <input type="text" class="form-control form-control-sm" name="ATIVIDADE" id="ATIVIDADE" style="background:#" value="<?php echo  $dados['dados'][0]->ATIVIDADE;?>" readonly>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="exampleInputEmail1">Estado:</label>
                        <input type="text" class="form-control form-control-sm" name="ESTADO" style="background:#" value="<?php echo  $dados['dados'][0]->ESTADO;?>" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Endereco:</label>
                        <input type="text" class="form-control form-control-sm" name="ENDERECO" style="background:#" value="<?php echo $dados['dados'][0]->ENDERECO.' - '.$dados['dados'][0]->COMPLEMENTO.' - '.$dados['dados'][0]->CIDADE;?>" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Cliente:</label>
                        <input type="text" class="form-control form-control-sm" name="CLIENTE" style="background:#" value="<?php echo  $dados['dados'][0]->CLIENTE;?>" readonly>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="exampleInputEmail1">Ordem:</label>
                        <input type="text" class="form-control form-control-sm" name="ORDEM" style="background:#" value="<?php echo  $dados['dados'][0]->ORDEM;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Data:</label>
                        <input type="text" class="form-control form-control-sm" name="DATA" style="background:#" value="<?php echo  $dados['dados'][0]->DATA;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Mudança:</label>
                        <input type="text" class="form-control form-control-sm" name="MUDANCA" style="background:#" value="<?php echo  $dados['dados'][0]->MUDANCA;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Troca de tecnologia:</label>
                        <input type="text" class="form-control form-control-sm" name="TROCA_TECNOLOGIA" style="background:#" value="<?php echo  $dados['dados'][0]->TROCA_TECNOLOGIA;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                    <label for="exampleInputEmail1">Telefone 01:  <a href="tel:<?php echo  '+55'.$dados['dados'][0]->CELULAR;?>" target="_blank">Ligar</a></label>
                        <input type="telephone" class="form-control form-control-sm" id="ROBERT_TELEFONE_1" name="TELEFONE_1" style="background:#" value="<?php echo  $dados['dados'][0]->TELEFONE_1;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Celular:  <a href="tel:<?php echo  '+55'.$dados['dados'][0]->CELULAR;?>" target="_blank">Ligar</a></label>
                        <input type="text" class="form-control form-control-sm" id="ROBERT_CELULAR" name="CELULAR" style="background:#" value="<?php echo  $dados['dados'][0]->CELULAR;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Telefone 02:  <a href="tel:<?php echo  '+55'.$dados['dados'][0]->CELULAR;?>" target="_blank">Ligar</a></label>
                        <input type="text" class="form-control form-control-sm" id="ROBERT_TELEFONE_2" name="TELEFONE_2" style="background:#" value="<?php echo  $dados['dados'][0]->TELEFONE_2;?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Telefone 03:  <a href="tel:<?php echo  '+55'.$dados['dados'][0]->CELULAR;?>" target="_blank">Ligar</a></label>
                        <input type="text" class="form-control form-control-sm" id="ROBERT_TELEFONE_3" name="TELEFONE_3" style="background:#" value="<?php echo  $dados['dados'][0]->TELEFONE_3;?>" readonly>
                    </div>
                    
                      <?php 
                    
                    date_default_timezone_set('America/Sao_Paulo');
                    $agora = date('Y-m-d H:i:s');
                    $date1 = strtotime($dados['dados'][0]->RESERVA_ATIVIDADE);
                    $date2 = strtotime($agora);
                    $diff = abs($date2 - $date1);
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24)
                    								/ (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 -
                    			$months*30*60*60*24)/ (60*60*24));
                    if ($days < 4) {
                          $cor = '#0eff06';
                    }
                    if ($days > 4 && $days < 6) {
                          $cor = '#ffe962';
                    }
                    if ($days > 6 && $days < 11) {
                          $cor = '#ff7f50';
                    }
                    if ($days > 10 && $days < 21) {
                          $cor = '#ff0000';
                    }
                    if ($days > 21) {
                          $cor = '#b30000';
                    }
                    ?>
                    
                    
                    
                    
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Reserva Atividade:</label> <?php echo '<b style="background:'.$cor.'">(Aging de '. $days .' dias)</b>';?>
                        <input type="text" class="form-control form-control-sm" name="RESERVA_ATIVIDADE" style="background:#" value="<?php echo  $dados['dados'][0]->RESERVA_ATIVIDADE;?>" readonly>
                    </div>
                    
                    
                    
                    
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Velocidade:</label>
                        <input type="text" class="form-control form-control-sm" name="VELOCIDADE" style="background:#" value="<?php echo  $dados['dados'][0]->VELOCIDADE;?>" readonly>
                        <input type="hidden" class="form-control form-control-sm" name="ABRIU" style="background:#" value="<?php echo  $dados['dados'][0]->ABRIU;?>" readonly>
                    </div>
                    
                    
                    </div>
                          </div>
                           </div>
                            </div>
                                    </div>
                            </div>
                            
                            
                                             </div>
                         <div class="callout callout-info" >
                             
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            
                 <div class="col-lg-12">     
                  <h5 style="color:#;"><b>Dados para contato | <span id="time">Carregando...</span></b>
                  </h5>
                 
                  <hr>
              <div class="row">
                    
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Sucesso no contato?:</label>
                        <select name="SUCESSO_CONTATO" id="SUCESSO_CONTATO" class="form-control form-control-sm" onchange="ocultarCombo()" value="" >
                            <option selected value="">Selecione</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                        </select>
                        </div>
                      <!--
                        <div class="form-group col-md-2" id="CONTATO_COM_SUCESSO" >
                        <label for="exampleInputEmail1">Contato com sucesso?</label>
                        <select name="CONTATO_COM_SUCESSO" id="CONTATO_COM_SUCESSO" class="form-control form-control-sm" value="" >
                            <option value="COM SUCESSO">COM SUCESSO</option>
                            <option value="SEM SUCESSO">SEM SUCESSO</option>
                        </select>
                        </div>
                        -->
                         <div class="form-group col-md-2" id="CONDICOES_AGENDAMENTO">
                        <label for="exampleInputEmail1">Condições de agendamento?</label>
                        <select name="CONDICOES_AGENDAMENTO" id="CONDICOES_AGENDAMENTO_NOVO" class="form-control form-control-sm" onchange="condicoesAgendamentoNovo()" value="" >
                            <option selected value="">Selecione</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                        </select>
                        </div>
                        
                        <div class="form-group col-md-3" id="RESULTADO_CONTATO_1">
                        <label for="exampleInputEmail1">Qual foi resultado no contato 01? <?php echo  $dados['dados'][0]->TELEFONE_1;?></label>
                        <select name="RESULTADO_CONTATO_1" id="STATUS_RESULTADO_CONTATO_1"  class="form-control form-control-sm" value="" onchange="gravarModal()">
                            <option value="COM SUCESSO">COM SUCESSO</option>
                            <option value="CHAMA E NAO ATENDE">CHAMA E NÃO ATENDE</option>
                            <option value="CAIXA POSTAL">CAIXA POSTAL</option>
                            <option value="NUMERO NAO EXISTE">NÚMERO NÃO EXISTE</option>
                            <option value="NAO COMPLETA">NÃO COMPLETA</option>
                            <option value="OCUPADO">OCUPADO</option>
                            <option value="OUTRO">OUTRO</option>
                        </select>
                        </div>
                        
                        <div class="form-group col-md-3"  id="RESULTADO_CONTATO_2">
                        <label for="exampleInputEmail1">Qual foi resultado no contato 02? <?php echo  $dados['dados'][0]->TELEFONE_2;?></label>
                        <select name="RESULTADO_CONTATO_2" id="STATUS_RESULTADO_CONTATO_2" class="form-control form-control-sm" value="" >
                            <option value="COM SUCESSO">COM SUCESSO</option>
                            <option value="CHAMA E NAO ATENDE">CHAMA E NÃO ATENDE</option>
                            <option value="CAIXA POSTAL">CAIXA POSTAL</option>
                            <option value="NUMERO NAO EXISTE">NÚMERO NÃO EXISTE</option>
                            <option value="NAO COMPLETA">NÃO COMPLETA</option>
                            <option value="OCUPADO">OCUPADO</option>
                            <option value="OUTRO">OUTRO</option>
                        </select>
                        </div>
                        
                        <div class="form-group col-md-3" id="RESULTADO_CONTATO_3" >
                        <label for="exampleInputEmail1">Qual foi resultado no contato 03? <?php echo  $dados['dados'][0]->TELEFONE_3;?></label>
                        <select name="RESULTADO_CONTATO_3" id="STATUS_RESULTADO_CONTATO_3" class="form-control form-control-sm" value="" >
                            <option value="COM SUCESSO">COM SUCESSO</option>
                            <option value="CHAMA E NAO ATENDE">CHAMA E NÃO ATENDE</option>
                            <option value="CAIXA POSTAL">CAIXA POSTAL</option>
                            <option value="NUMERO NAO EXISTE">NÚMERO NÃO EXISTE</option>
                            <option value="NAO COMPLETA">NÃO COMPLETA</option>
                            <option value="OCUPADO">OCUPADO</option>
                            <option value="OUTRO">OUTRO</option>
                        </select>
                        </div>
                        
                        <div class="form-group col-md-3" id="RESULTADO_CONTATO_4" >
                        <label for="exampleInputEmail1">Qual foi resultado no contato 04? <?php echo  $dados['dados'][0]->CELULAR;?></label>
                        <select name="RESULTADO_CONTATO_4" id="RESULTADO_CONTATO_48" class="form-control form-control-sm" value="" >
                            <option value="COM SUCESSO">COM SUCESSO</option>
                            <option value="CHAMA E NAO ATENDE">CHAMA E NÃO ATENDE</option>
                            <option value="CAIXA POSTAL">CAIXA POSTAL</option>
                            <option value="NUMERO NAO EXISTE">NÚMERO NÃO EXISTE</option>
                            <option value="NAO COMPLETA">NÃO COMPLETA</option>
                            <option value="OCUPADO">OCUPADO</option>
                            <option value="OUTRO">OUTRO</option>
                        </select>
                        </div>
                        
                        <div class="form-group col-md-2" id="BUCKET_ATUAL" >
                        <label for="exampleInputEmail1">Bucket atual:</label>
                        <select name="BUCKET_ATUAL" id="BUCKET_ATUAL" class="form-control form-control-sm" value="" readonly>
                            <option value="<?php echo  $dados['dados'][0]->PROVEDOR;?>"><?php echo  $dados['dados'][0]->PROVEDOR;?></option>
                        </select>
                        </div>
                             
                          <div class="form-group col-md-2" id="BUCKET_DESTINO" >
                        <label for="exampleInputEmail1">Bucket Destino:</label>
                         <input type="text" id="STATUS_BUCKET_DESTINO" class="form-control form-control-sm" name="BUCKET_DESTINO" style="background:#" value="">
                        </div>
                        
                    <div class="form-group col-md-4"  id="NOME_CONTATO" >
                        <label for="exampleInputEmail1">Nome do contato:</label>
                        <input type="text" class="form-control form-control-sm" name="NOME_CONTATO" id="NOME_CONTATO" style="background:#" value=""  >
                    </div>
                    <div class="form-group col-md-4"  id="MOTIVO_N_AGENDAMENTO" >
                        <label for="exampleInputEmail1">Motivo do não agendamento:</label>
                        <select name="MOTIVO_N_AGENDAMENTO" id="STATUS_MOTIVO_N_AGENDAMENTO" class="form-control form-control-sm" value="" >
                            <option selected value="" disabled>Selecione</option>
                            <option value="DESISTIU DO PRODUTO">DESISTIU DO PRODUTO</option>
                            <option value="RECOMPRA">RECOMPRA</option>
                            <option value="CLIENTE NAO SOLICITOU">CLIENTE NÃO SOLICITOU</option>
                            <option value="ORDEM DUPLICADA">ORDEM DUPLICADA</option>
                            <option value="NAO CONHECE O ASSINANTE">NÃO CONHECE O ASSINANTE</option>
                            <option value="CONTRATOU OUTRA OPERADORA">CONTRATOU OUTRA OPERADORA</option>
                            <option value="ENDERECO INCORRETO">ENDEREÇO INCORRETO</option>
                            <option value="PRODUTO INCORRETO - VELOCIDADE">PRODUTO INCORRETO - VELOCIDADE</option>
                            <option value="PRODUTO INCORRETO - TECNOLOGIA">PRODUTO INCORRETO - TECNOLOGIA</option>
                            <option value="NOME INCORRETO">NOME INCORRETO</option>
                            <option value="COMPLEMENTO INCORRETO">COMPLEMENTO INCORRETO</option>
                        </select>
                    </div>
                    
                 
                    
                    <div class="form-group col-md-4" id="DATA_SOLICITADA" >
                        <label for="exampleInputEmail1">Data Agendamento:</label>
                        <input type="date" class="form-control form-control-sm" id="DATA_SOLICITADA_1" name="DATA_AGENDAMENTO" style="background:#" value="">
                    </div>
                    
                    <div class="form-group col-md-4" id="TURNO" >
                        <label for="exampleInputEmail1">Turno:</label>
                        <select name="TURNO" id="STATUS_TURNO" class="form-control form-control-sm" value="" >
                            <option selected value="" disabled>Selecione</option>
                            <option value="MANHA">MANHA</option>
                            <option value="TARDE">TARDE</option>
                            <option value="COMERCIAL">COMERCIAL</option>
                        </select>
                    </div>
                    
                     <div class="form-group col-md-4" id="CANCELAR_REPARO_TESTE" >
                        <label for="exampleInputEmail1">Cancelar reparo?</label>
                        <select name="CANCELAR_REPARO" id="CANCELAR_REPARO" class="form-control form-control-sm" value="" >
                            <option selected value="" disabled>Selecione</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                        </select>
                    </div>
                    
                     <div class="form-group col-md-4" id="MOTIVO_CANCELAR_REPARO_TESTE" >
                        <label for="exampleInputEmail1">Motivo cancelamento:</label>
                        <select name="MOTIVO_CANCELAR_REPARO" id="MOTIVO_CANCELAR_REPARO" class="form-control form-control-sm" value="" >
                            <option selected value="" disabled>Selecione</option>
                            <option value="CANCELAR">CANCELAR</option>
                            <option value="VOLTOU FUNCIONAR">VOLTOU FUNCIONAR</option>
                        </select>
                    </div>
                    
                     <div class="form-group col-md-12" id="OBS">
                            <label for="exampleFormControlTextarea1">Observação:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="obs" ></textarea>
                         </div>
        
                    
                       <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Data cadastro:</label>
                        <input type="text" class="form-control form-control-sm" name="DATA_CADASTRO" style="background:#" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y H:i:s');?>" readonly="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Login Cadastro:</label>
                        <input type="text" class="form-control form-control-sm" name="LOGIN_CADASTRO" style="background:#" value="<?php echo  auth()->user()->name;?>" readonly="">
                    </div>
              </div><br>
               </p>

<br>


<!-- Large modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Máscara TOA | Confirma os dados preenchidos?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group col-md-12" id="AGENDAMENTO_SEM_SUCESSO_NO_CONTATO"> 
             <b>AGENDAMENTO SEM SUCESSO NO CONTATO</b> <br> 
             | <b>CLIENTE:</b> <?php echo  $dados['dados'][0]->CLIENTE;?> <br>
             | <b>TELEFONE DE CONTATO (1):</b> <?php echo  $dados['dados'][0]->TELEFONE_1;?> <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_10"></h> <br> 
             | <b>TELEFONE DE CONTATO (2): </b><?php echo  $dados['dados'][0]->TELEFONE_2;?> <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_20"></h> <br>
             | <b>TELEFONE DE CONTATO (3): </b><?php echo  $dados['dados'][0]->TELEFONE_3;?> <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_30"></h> <br>
             | <b>TELEFONE DE CONTATO (4): </b><?php echo  $dados['dados'][0]->CELULAR;?> <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_40"></h> <br>
             | <b>BUCKET DE DESTINO: </b><h id="STATUS_BUCKET_DESTINO_0"></h> <br>
             | <b>OPERADOR:</b> <?php echo  auth()->user()->name;?> <br>
             | <b>DATA E HORA:</b> <?php echo date('d/m/Y H:i:s');?>
             <br>
        </div>
        
        <div class="form-group col-md-12" id="AGENDAMENTO_SEM_SUCESSO"> 
            <b>AGENDAMENTO SEM SUCESSO</b> <br>
            | <b>CLIENTE:</b> <?php echo  $dados['dados'][0]->CLIENTE;?>  <br>
             | <b>TELEFONE DE CONTATO (1):</b> <?php echo  $dados['dados'][0]->TELEFONE_1;?> <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_101"></h> <br> 
             | <b>TELEFONE DE CONTATO (2): </b><?php echo  $dados['dados'][0]->TELEFONE_2;?> <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_201"></h> <br>
             | <b>TELEFONE DE CONTATO (3): </b><?php echo  $dados['dados'][0]->TELEFONE_3;?> <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_301"></h> <br>
             | <b>TELEFONE DE CONTATO (4): </b><?php echo  $dados['dados'][0]->CELULAR;?> <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_401"></h> <br>
            | <b>CONDIÇÃO DE AGENDAMENTO?:</b> NÃO <br>
            | <b>MOTIVO DO NÃO AGENDAMENTO:</b> <h id="STATUS_MOTIVO_N_AGENDAMENTO_1"></h> <br>
            | <b>BUCKET DE DESTINO:</b> <h id="STATUS_BUCKET_DESTINO_1"></h> <br>
            | <b>OPERADOR:</b>  <?php echo  auth()->user()->name;?> <br>
            | <b>DATA E HORA:</b> <?php echo date('d/m/Y H:i:s');?><br>
            <br>
        </div>
        
        <div class="form-group col-md-12" id="AGENDAMENTO_COM_SUCESSO"> 
            <b>AGENDAMENTO COM SUCESSO</b> <br>
            | <b>CLIENTE:</b> <?php echo  $dados['dados'][0]->CLIENTE;?>  <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_102"></h> <br> 
             | <b>TELEFONE DE CONTATO (2): </b><?php echo  $dados['dados'][0]->TELEFONE_2;?> <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_202"></h> <br>
             | <b>TELEFONE DE CONTATO (3): </b><?php echo  $dados['dados'][0]->TELEFONE_3;?> <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_302"></h> <br>
             | <b>TELEFONE DE CONTATO (4): </b><?php echo  $dados['dados'][0]->CELULAR;?> <br>
             | <b>STATUS DO CONTATO:</b> <h id="STATUS_RESULTADO_CONTATO_402"></h> <br>
            | <b>CONDIÇÃO DE AGENDAMENTO?:</b> SIM <br>
            | <b>DATA DE AGENDAMENTO:</b> <h id="STATUS_DATA_SOLICITADA_1"> </h><br>
            | <b>TURNO ESCOLHIDO:</b> <h id="STATUS_TURNO_1"> </h><br>
            | <b>DATA E HORA:</b> <?php echo date('d/m/Y H:i:s');?>
        </div>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-success">Salvar</button>
      </div>
    </div>
  </div>
</div>


<div class="box-footer">
    <button type="button" class="btn btn-primary" onclick="gravarModal()" data-toggle="modal" data-target="#exampleModal">
    Gravar
    </button>
              
              </div><br>
              
              <div class="box-footer">
                  * Se a atividade já foi tratada, favor clicar no botão abaixo:<br><br>
    <a href="./tabulador-tratada?id=<?php echo  $dados['dados'][0]->id;?>&status='INJETADO'&PROVEDOR=<?php echo  $dados['dados'][0]->PROVEDOR;?>&N_ORDEM=<?php echo  $dados['dados'][0]->N_ORDEM;?>&PRODUTO=<?php echo  $dados['dados'][0]->PRODUTO;?>&ATIVIDADE=<?php echo  $dados['dados'][0]->ATIVIDADE;?>&ESTADO=<?php echo  $dados['dados'][0]->ESTADO;?>&ENDERECO=<?php echo  $dados['dados'][0]->ENDERECO;?>&COMPLEMENTO=<?php echo  $dados['dados'][0]->COMPLEMENTO;?>&TROCA_TECNOLOGIA=<?php echo  $dados['dados'][0]->TROCA_TECNOLOGIA;?>&CIDADE=<?php echo  $dados['dados'][0]->CIDADE;?>&CLIENTE=<?php echo  $dados['dados'][0]->CLIENTE;?>&ORDEM=<?php echo  $dados['dados'][0]->ORDEM;?>&DATA=<?php echo  $dados['dados'][0]->DATA;?>&MUDANCA=<?php echo  $dados['dados'][0]->MUDANCA;?>&TELEFONE_1=<?php echo  $dados['dados'][0]->TELEFONE_1;?>&CELULAR=<?php echo  $dados['dados'][0]->CELULAR;?>&TELEFONE_2=<?php echo  $dados['dados'][0]->TELEFONE_2;?>&TELEFONE_3=<?php echo  $dados['dados'][0]->TELEFONE_3;?>&RESERVA_ATIVIDADE=<?php echo  $dados['dados'][0]->RESERVA_ATIVIDADE;?>&VELOCIDADE=<?php echo  $dados['dados'][0]->VELOCIDADE;?>"><button type="button" class="btn btn-danger"><b style="color:white">JÁ TRATADA</b></a>
    
    </button>
              
              </div><br>

              
              
            </form>
          </div>
          <!-- /.box -->
 <head>
  
         <script language="JavaScript">
  window.onbeforeunload = confirmExit;
  function confirmExit()
  {
    return "Se você fechar o navegador, seus dados serão perdidos. Desena Realmente sair?";
  }
</script>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script type="text/javascript">
    
    /* Código exposto em uma página php */
    //var contador = '<?php //echo $fetch['time'];?>'; /**** Variável do PHP ****/
    var contador = '300';
    var contador1 = '60';
    
    /* A partir daqui, pode ficar em um arquivo .js */
    function startTimer(duration, display) {
      var timer = duration, minutes, seconds;
      setInterval(function() {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);
    
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
    
        display.textContent = minutes + ":" + seconds;
    
        if (--timer == 0) {
        alert('Tempo excedido.');
        }
      }, 1000);
    }
    
    window.onload = function() {
      var count = parseInt(contador),
        display = document.querySelector('#time');
        startTimer(count, display);
    };
    
    
    
    window.addEventListener("beforeunload", function(event) { 
        event.preventDefault();
    
    
        event.returnValue = "Mensagem de aviso"; 
        return "Mensagem de aviso";
    });
    
    document.oncontextmenu = function(){
        return false;
    }

    document.getElementById("OBS").style.display = "none";
    document.getElementById("DATA_SOLICITADA").style.display = "none";
    document.getElementById("RESULTADO_CONTATO_1").style.display = "none";
    document.getElementById("RESULTADO_CONTATO_2").style.display = "none";
    document.getElementById("RESULTADO_CONTATO_3").style.display = "none";
    document.getElementById("RESULTADO_CONTATO_4").style.display = "none";
    document.getElementById("BUCKET_ATUAL").style.display = "none";
    document.getElementById("BUCKET_DESTINO").style.display = "none";
    document.getElementById("CONDICOES_AGENDAMENTO").style.display = "none";
    document.getElementById("NOME_CONTATO").style.display = "none";
    document.getElementById("MOTIVO_N_AGENDAMENTO").style.display = "none";
    document.getElementById("TURNO").style.display = "none";
    document.getElementById("CANCELAR_REPARO_TESTE").style.display = "none";
    document.getElementById("MOTIVO_CANCELAR_REPARO_TESTE").style.display = "none";
    document.getElementById("AGENDAMENTO_SEM_SUCESSO_NO_CONTATO").style.display = "none";
    document.getElementById("AGENDAMENTO_SEM_SUCESSO").style.display = "none";
    document.getElementById("AGENDAMENTO_COM_SUCESSO").style.display = "none";


    function ocultarCombo() {
        
        var contatoSucesso = document.getElementById("SUCESSO_CONTATO").value;
        
        if (contatoSucesso === 'S') {
            document.getElementById("OBS").style.display = "block";
            document.getElementById("CONDICOES_AGENDAMENTO").style.display = "block";
            
        } else {

            document.getElementById("AGENDAMENTO_SEM_SUCESSO_NO_CONTATO").style.display = "block";
            document.getElementById("AGENDAMENTO_SEM_SUCESSO").style.display = "none";
            document.getElementById("AGENDAMENTO_COM_SUCESSO").style.display = "none";
            
            
            if (document.getElementById("ROBERT_TELEFONE_1").value == '') {
                document.getElementById("RESULTADO_CONTATO_1").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_1").style.display = "block";
            }
            
            if (document.getElementById("ROBERT_TELEFONE_2").value == '') {
                document.getElementById("RESULTADO_CONTATO_2").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_2").style.display = "block";
            }
            
            if (document.getElementById("ROBERT_TELEFONE_3").value == '') {
                document.getElementById("RESULTADO_CONTATO_3").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_3").style.display = "block";
            }
            
            
            if (document.getElementById("ROBERT_CELULAR").value == '') {
                document.getElementById("RESULTADO_CONTATO_4").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_4").style.display = "block";
            }
            
            
            
            document.getElementById("BUCKET_ATUAL").style.display = "block";
            document.getElementById("BUCKET_DESTINO").style.display = "block";
            document.getElementById("CONDICOES_AGENDAMENTO").style.display = "none";
            document.getElementById("NOME_CONTATO").style.display = "none";
            document.getElementById("MOTIVO_N_AGENDAMENTO").style.display = "none";
            //document.getElementById("DATA_AGENDAMENTO").style.display = "none";
            document.getElementById("TURNO").style.display = "none";
        }
    }
    /* DEFINIR COMBO DA CONDIÇÕES DE AGENDAMENTO */
    function condicoesAgendamentoNovo() {
        var condicoesAgendamento = document.getElementById("CONDICOES_AGENDAMENTO_NOVO").value;
        var atividade =  document.getElementById("ATIVIDADE").value;

        if (condicoesAgendamento == 'S') {
             if (atividade.substr(0, 1) === 'B') {
                if(condicoesAgendamento === 'N') {
                    document.getElementById("CANCELAR_REPARO_TESTE").style.display = "none";
                    document.getElementById("MOTIVO_CANCELAR_REPARO_TESTE").style.display = "none";
                } 
            }
            document.getElementById("AGENDAMENTO_SEM_SUCESSO_NO_CONTATO").style.display = "none";    
            document.getElementById("AGENDAMENTO_SEM_SUCESSO").style.display = "none";
            document.getElementById("AGENDAMENTO_COM_SUCESSO").style.display = "block";

                document.getElementById("DATA_SOLICITADA").style.display = "block";
                
            if (document.getElementById("ROBERT_TELEFONE_1").value == '') {
                document.getElementById("RESULTADO_CONTATO_1").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_1").style.display = "block";
            }
            
            if (document.getElementById("ROBERT_TELEFONE_2").value == '') {
                document.getElementById("RESULTADO_CONTATO_2").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_2").style.display = "block";
            }
            
            if (document.getElementById("ROBERT_TELEFONE_3").value == '') {
                document.getElementById("RESULTADO_CONTATO_3").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_3").style.display = "block";
            }
            
            
            if (document.getElementById("ROBERT_CELULAR").value == '') {
                document.getElementById("RESULTADO_CONTATO_4").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_4").style.display = "block";
            }
            
                document.getElementById("BUCKET_ATUAL").style.display = "block";
                document.getElementById("BUCKET_DESTINO").style.display = "block";
                document.getElementById("NOME_CONTATO").style.display = "block";
                document.getElementById("MOTIVO_N_AGENDAMENTO").style.display = "none";
                document.getElementById("CONDICOES_AGENDAMENTO").style.display = "block";
                document.getElementById("TURNO").style.display = "block";
        } else {
            if (atividade.substr(0, 1) === 'B') {
                    document.getElementById("CANCELAR_REPARO_TESTE").style.display = "block";
                    document.getElementById("MOTIVO_CANCELAR_REPARO_TESTE").style.display = "block";
            }
         
            if (document.getElementById("ROBERT_TELEFONE_1").value == '') {
                document.getElementById("RESULTADO_CONTATO_1").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_1").style.display = "block";
            }
            
            if (document.getElementById("ROBERT_TELEFONE_2").value == '') {
                document.getElementById("RESULTADO_CONTATO_2").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_2").style.display = "block";
            }
            
            if (document.getElementById("ROBERT_TELEFONE_3").value == '') {
                document.getElementById("RESULTADO_CONTATO_3").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_3").style.display = "block";
            }
            
            
            if (document.getElementById("ROBERT_CELULAR").value == '') {
                document.getElementById("RESULTADO_CONTATO_4").style.display = "none";    
            } else {
                document.getElementById("RESULTADO_CONTATO_4").style.display = "block";
            }
            
            
            
            
            document.getElementById("BUCKET_ATUAL").style.display = "block";
            document.getElementById("BUCKET_DESTINO").style.display = "block";
            document.getElementById("NOME_CONTATO").style.display = "none";
            document.getElementById("MOTIVO_N_AGENDAMENTO").style.display = "block";
            document.getElementById("CONDICOES_AGENDAMENTO").style.display = "block";
           // document.getElementById("DATA_AGENDAMENTO").style.display = "none";
            document.getElementById("TURNO").style.display = "none";
            
          
                
               
        
            
            document.getElementById("AGENDAMENTO_SEM_SUCESSO_NO_CONTATO").style.display = "none";    
            document.getElementById("AGENDAMENTO_SEM_SUCESSO").style.display = "block";
            document.getElementById("AGENDAMENTO_COM_SUCESSO").style.display = "none";
           
        }
         
         
 

    }

    function gravarModal() {
        
        
        if (document.getElementById("ROBERT_TELEFONE_1").value != '') {
            var RESULTADO_CONTATO_1 = document.getElementById('STATUS_RESULTADO_CONTATO_1').value;
            document.getElementById('STATUS_RESULTADO_CONTATO_10').innerHTML = RESULTADO_CONTATO_1;
            document.getElementById('STATUS_RESULTADO_CONTATO_101').innerHTML = RESULTADO_CONTATO_1;
            document.getElementById('STATUS_RESULTADO_CONTATO_102').innerHTML = RESULTADO_CONTATO_1;
        }
        
        if (document.getElementById("ROBERT_TELEFONE_2").value != '') {
            var RESULTADO_CONTATO_2 = document.getElementById('STATUS_RESULTADO_CONTATO_2').value;
            document.getElementById('STATUS_RESULTADO_CONTATO_20').innerHTML = RESULTADO_CONTATO_2;
            document.getElementById('STATUS_RESULTADO_CONTATO_201').innerHTML = RESULTADO_CONTATO_2;
            document.getElementById('STATUS_RESULTADO_CONTATO_202').innerHTML = RESULTADO_CONTATO_2;
        }
        
        if (document.getElementById("ROBERT_TELEFONE_3").value != '') {
            var RESULTADO_CONTATO_3 = document.getElementById('STATUS_RESULTADO_CONTATO_3').value;
            document.getElementById('STATUS_RESULTADO_CONTATO_30').innerHTML = RESULTADO_CONTATO_3;
            document.getElementById('STATUS_RESULTADO_CONTATO_301').innerHTML = RESULTADO_CONTATO_3;
            document.getElementById('STATUS_RESULTADO_CONTATO_302').innerHTML = RESULTADO_CONTATO_3;
        }

        if (document.getElementById("ROBERT_CELULAR").value != '') {
            var RESULTADO_CONTATO_49 = document.getElementById('RESULTADO_CONTATO_48').value;
            document.getElementById('STATUS_RESULTADO_CONTATO_40').innerHTML = RESULTADO_CONTATO_49;
            document.getElementById('STATUS_RESULTADO_CONTATO_401').innerHTML = RESULTADO_CONTATO_49;
            document.getElementById('STATUS_RESULTADO_CONTATO_402').innerHTML = RESULTADO_CONTATO_49;
        }

        var BUCKET_DESTINO = document.getElementById('STATUS_BUCKET_DESTINO').value;
        document.getElementById('STATUS_BUCKET_DESTINO_0').innerHTML = BUCKET_DESTINO;

        var BUCKET_DESTINO_2 = document.getElementById('STATUS_BUCKET_DESTINO').value;
        document.getElementById('STATUS_BUCKET_DESTINO_1').innerHTML = BUCKET_DESTINO_2;


        var CONDICOES_AGENDAMENTO = document.getElementById('CONDICOES_AGENDAMENTO_NOVO').value;
      
        if (CONDICOES_AGENDAMENTO == 'S'){
                
            var TURNOO = document.getElementById('STATUS_TURNO').value;
            document.getElementById('STATUS_TURNO_1').innerHTML = TURNOO;
            console.log(TURNOO);
    
            var DATA_SOLICITADA_2 = document.getElementById('DATA_SOLICITADA_1').value;
            console.log(DATA_SOLICITADA_2);
            document.getElementById('STATUS_DATA_SOLICITADA_1').innerHTML = DATA_SOLICITADA_2;            
        } else {
            var MOTIVO_N_AGENDAMENTO = document.getElementById('STATUS_MOTIVO_N_AGENDAMENTO').value;
            document.getElementById('STATUS_MOTIVO_N_AGENDAMENTO_1').innerHTML = MOTIVO_N_AGENDAMENTO;
        
        }
        
    
    }

    </script>
  </head>
         
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

    function requestFullScreen() {

  var el = document.body;

  // Supports most browsers and their versions.
  var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen 
  || el.mozRequestFullScreen || el.msRequestFullScreen;

  if (requestMethod) {

    // Native full screen.
    requestMethod.call(el);

  } else if (typeof window.ActiveXObject !== "undefined") {

    // Older IE.
    var wscript = new ActiveXObject("WScript.Shell");

    if (wscript !== null) {
      wscript.SendKeys("{F11}");
    }
  }
}


</script>
@stop
