<html lang="pt-br" class="js-focus-visible" data-js-focus-visible="" data-arp-injected="true">
   <head>
      <meta charset="utf-8">
      <title></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="-----//-----">
      <script>
         window.print() 
      </script>
      <style type="text/css">
         @font-face {
         font-weight: 400;
         font-style:  normal;
         font-family: 'Circular-Loom';
         src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Book-cd7d2bcec649b1243839a15d5eb8f0a3.woff2') format('woff2');
         }
         @font-face {
         font-weight: 500;
         font-style:  normal;
         font-family: 'Circular-Loom';
         src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Medium-d74eac43c78bd5852478998ce63dceb3.woff2') format('woff2');
         }
         @font-face {
         font-weight: 700;
         font-style:  normal;
         font-family: 'Circular-Loom';
         src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Bold-83b8ceaf77f49c7cffa44107561909e4.woff2') format('woff2');
         }
         @font-face {
         font-weight: 900;
         font-style:  normal;
         font-family: 'Circular-Loom';
         src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Black-bf067ecb8aa777ceb6df7d72226febca.woff2') format('woff2');
         }
      </style>
   </head>
   <body>
      <div style="width: 100%;" align="">
         <table style="text-align: left; width: 1260px; height: 200px;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
               <tr>
                  <td style="width: 175px;">
                     <div style="text-align: center;">
                     </div>
                     <img style="width: 160px; height: 160px;" alt="" src="https://cdn.izap.com.br/tlpservicos.com.br/plus/images?src=tema/plusfiles/2_26-anos-tlp-site.png"><br>		
                  </td>
                  <td style="width: 845px;text-align: center;">
                     <h1>EXTRATO RV</h1>
                     TLP SERVIÇOS<br>
                     RESULTADO DE ENTREGA E QUALIDADE - RV
                     <br> <?php echo $dados['informacao'][0]->NOME;?> - <?php echo $dados['informacao'][0]->CPF;?><br>
                  </td>
               </tr>
               <tr>
                  <td style="width: 175px; text-align: center;"> </td>
                  <td style="width: 845px; text-align: center;"><b>Situação:</b>
                     <b><?php
                        if ($dados['informacao'][0]->SITUACAO == 'Não') {
                            echo 'Inelegível';
                        } else {
                            echo 'Elegível';
                        }
                        ?> - <?php echo $dados['tipo'][0];?> | <b>Data de Atualização:</b> <?php echo date('d/m/Y H:i:s', strtotime($dados['informacao'][0]->ATUALIZACAO));?> </span>
                  </td>
               </tr>
            </tbody>
         </table>
         <br>
         <table align="" width="100%"  table#lista="" thead{="" position:="" fixed;="" }="" cellspacing="0" cellpadding="0" table="" style="table-layout: fixed; width: 1250px; overflow: hidden;">
         <thead>
            <tr>
               Segundo a politica de bonificação criada pela empresa TLP SERVICOS, inscrita no CNPJ 02.032.251/0001-83, o colaborador descrito no título,
               obteve os seguintes resultados abaixo e receberá o valor de <b>R$  <?php echo number_format($dados['informacao'][0]->VALOR_A_RECEBER,2,',','.');?></b>. Resultado abaixo:</p>
               <b>Presença:</b> <?php echo $dados['informacao'][0]->DT;?> <br>
            
               <p>
                  <b>PRODUÇÃO:</b><br><br>
                  Instalações: <?php echo $dados['informacao'][0]->INSTALACAO;?>  - R$ VERIFICAR;?> 
                  | Reparo: <?php echo $dados['informacao'][0]->REPARO;?> 
                  | Desconexões FTTH: 0 
                  | Desconexões FTTC: 0
                  <br>
               <p>
                   <br> <b>INDICADORES:</b><br>
                   <br>
                  <b>Cumprimento de Agenda (Se o colaborador for de Reparo aparecerá zerado):</b> =>
                   <?php 
                     if (! isset($dados['informacao'][0]->TX__AGENDA)) {
                         echo 'Não se aplica';
                     } else {
                         echo $dados['informacao'][0]->TX__AGENDA;
                     }
                     
                     ?> R$
                  <?php 
                     if (! isset($dados['informacao'][0]->BONUS_AGENDA)) {
                         echo '0,00';
                     } else {
                         echo $dados['informacao'][0]->BONUS_AGENDA;
                     }
                     
                     ?> 
               <p>
                  <b>Repetida => </b>
                  Taxa: 
                  <?php 
                     if (! isset($dados['informacao'][0]->TX__REPETIDA)) {
                         echo 'Não se aplica';
                     } else {
                         echo $dados['informacao'][0]->TX__REPETIDA;
                     }
                     
                     ?> | R$
                  <?php 
                     if (! isset($dados['informacao'][0]->BONUS_REPETIDA)) {
                         echo '0,00';
                     } else {
                         echo $dados['informacao'][0]->BONUS_REPETIDA;
                     }
                     
                     ?> 
              | 
                  <b>Recente => </b>
                  Taxa: 
                  <?php 
                     if (! isset($dados['informacao'][0]->TX__RECENTE)) {
                         echo 'Não se aplica';
                     } else {
                         echo $dados['informacao'][0]->TX__RECENTE;
                     }
                     
                     ?> | 
                  <?php 
                     if (! isset($dados['informacao'][0]->BONUS)) {
                         echo '0,00';
                     } else {
                         echo $dados['informacao'][0]->BONUS;
                     }
                     
                     ?> 
               
                  <b>TT Base => </b>
                  Taxa: 
                  <?php 
                     if (! isset($dados['informacao'][0]->TX__TTBASE)) {
                         echo 'Não se aplica';
                     } else {
                         echo $dados['informacao'][0]->TX__TTBASE;
                     }
                     
                     ?> | R$
                  <?php 
                     if (! isset($dados['informacao'][0]->BONUS_TT_BASE)) {
                         echo '0,00';
                     } else {
                         echo $dados['informacao'][0]->BONUS_TT_BASE;
                     }
                     
                     ?> 
               <p><br>
                   <b>INDICADORES:</b><br><br>
                  <b>TREA => </b>
                  TREA não entregue: <?php echo $dados['informacao'][0]->TREA_DIGITAL;?> | R$ <?php echo $dados['informacao'][0]->TREA_DIGITAL_VALOR;?> 
               <p>
                  <b>RNC => </b>
                  RNC Não Corrigida: <?php echo $dados['informacao'][0]->RNC;?> | R$ <?php echo $dados['informacao'][0]->RNC_VALOR;?> 
            </tr>
            <br>
            <center>
               <br><br><br>
               <table id="tbl_atribuicao" border="1" class="table table-striped table-sm table-bordered dataTable">
   <thead>
      <tr class="bg-light text-center py-0 align-middle cabecalho">
        <th style="width:200px" colspan="19">
          <center>
            [EXTRATO BONUS]
          </center>
        </th>
      </tr>
      <tr class="bg-light text-center py-0 align-middle">
        <th class="cabecalho" style="width:50px">
          <center>#</center>
        </th>
        <th class="cabecalho" style="width:80px">
          <center>Ordem</center>
        </th>
        <th class="cabecalho" style="width:120px">
          <center>Cidade</center>
        </th>
        <th class="cabecalho" style="width:150px">
          <center>Tipo</center>
        </th>
        <th class="cabecalho" style="width:150px">
          <center>Data Execução</center>
        </th>
        <th class="cabecalho" style="width:60px">
          <center>Valor</center>
        </th>
        <th class="cabecalho" style="width:100px">
          <center>Operação</center>
        </th>
        <th class="cabecalho" style="width:150px">
          <center>Motivo</center>
        </th>
        <th class="cabecalho" style="width:100px">
          <center>Referencia</center>
        </th>
      </tr>
    </thead><center>
    <tbody>
      @php
        $qtdColuna = 1;
      @endphp
      @foreach ($dados['analitico_rv'] as $gr)
      <tr>
        <td title="Observação: ">
          <center>

              {{ $qtdColuna++ }}

          </center>
        </td>
        <td title="Observação: ">
          <center>
         
              <center>
                {{ $gr->ordem }}
              </center>
     
          </center>
        </td>
        <td title="Observação: ">
          <center>
        
              {{ $gr->cidade }}
         
          </center>
        </td>
        <td title="Observação: ">
          <center>
 
              {{ $gr->tipo }}

          </center>
        </td>
        <td title="Observação: ">
          <center>
   
              {{ $gr->data_execucao }}
          
          </center>
        </td>
        <td title="Observação: ">
          <center>
   
              {{ number_format($gr->valor,2,',','.') }}

          </center>
        </td>
        <td title="Observação: ">
          <center>
           
              {{ $gr->operacao }}

          </center>
        </td>
        <td title="Observação: ">
          <center>
            
              <center>
                {{ $gr->motivo }}
              </center>
      
          </center>
        </td>
        <td title="Observação: ">

              <center>
                {{ $gr->referencia }}
              </center>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
               <center>
               <br><br><br>
               __________________________________________________________________________________________________<br>
               <?php echo $dados['informacao'][0]->TECNICO;?> | DATA EMISSAO: <?php  date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y H:i:s');?>
            </center>
      </div>
   </body>
   <loom-container id="lo-engage-ext-container">
   <loom-shadow classname="resolved"></loom-shadow></loom-container>
</html>