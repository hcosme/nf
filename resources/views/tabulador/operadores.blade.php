@extends('adminlte::page')

@section('title', 'Tabulador')

@section('content_header')
<meta http-equiv="refresh" content="120">
<!--   <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop

@section('content')

      <style>
/*
table thead{
    background: #084B8A;
    color: #FFF;
}
table tbody{
    background: #3498db;
    color: #FFF;
}
table thead tr td{
    padding: 5px;
    text-align: center;
}
table tbody tr td{
    padding: 5px;
} */
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
       table, th, td {
        border: 2px solid black;
        border-collapse: collapse;
        border-color: #E6E6E6;
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

    <div class="callout callout-secondary">
  <p>

   <form action="./tabulador-index" method="get">

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
                
    <div class="box-body table-responsive no-padding">


        <table id="" class="table table-striped table-sm table-bordered dataTable">
            <thead>
                <tr class="bg-light text-center py-0 align-middle">
                    <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[CONTROLE DE OPERADORES] </th> 
                </tr>
                <tr class="bg-light text- py-0 align-middle">
                    <th style=" background-color:#;color:black;width:20px"><center>Usuario</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Login</th>
                    <th style=" background-color:#;color:black;width:90px"><center>Ultima ligação</th>
                    <th style=" background-color:#;color:black;width:160px"><center>Ultima atividade</th>
                    <th style=" background-color:#;color:black;width:120px"><center>Status</th>
                    <th style=" background-color:#;color:black;width:160px"><center>Tempo em ligação</th>
                    <th style=" background-color:#;color:black;width:160px"><center>Tempo última submissão x Agora</th>
                    
                </tr>
            </thead>
            <tbody><CENTER>
            <?php 
                $numero = 1;
                foreach ($dados['dados'] as $gr) {
                    
                    date_default_timezone_set('America/Sao_Paulo');
                    $agora = date('Y-m-d H:i:s');
                    // Declare and define two dates
                    $date1 = strtotime($gr->em_agendamento);
                    $date2 = strtotime($agora);
                    
                    // Formulate the Difference between two dates
                    $diff = abs($date2 - $date1);

                    $years = floor($diff / (365*60*60*24));
  
                    $months = floor(($diff - $years * 365*60*60*24)
                    								/ (30*60*60*24));
      
                    $days = floor(($diff - $years * 365*60*60*24 -
                    			$months*30*60*60*24)/ (60*60*24));
                    

                    $hours = floor(($diff - $years * 365*60*60*24
                    		- $months*30*60*60*24 - $days*60*60*24)
                    									/ (60*60));
                    

                    $minutes = floor(($diff - $years * 365*60*60*24
                    		- $months*30*60*60*24 - $days*60*60*24
                    							- $hours*60*60)/ 60);
                    

                    $seconds = floor(($diff - $years * 365*60*60*24
                    		- $months*30*60*60*24 - $days*60*60*24
                    				- $hours*60*60 - $minutes*60));
                    $tempo_ligacao = $hours.":".$minutes.":".$seconds;
       
                   /* TEMPO OCIOSO */
                    $date1 = strtotime($gr->ultima_atividade);
                    $date2 = strtotime($agora);
                    
                    // Formulate the Difference between two dates
                    $diff = abs($date2 - $date1);

                    $years = floor($diff / (365*60*60*24));
  
                    $months = floor(($diff - $years * 365*60*60*24)
                    								/ (30*60*60*24));
      
                    $days = floor(($diff - $years * 365*60*60*24 -
                    			$months*30*60*60*24)/ (60*60*24));
                    

                    $hours = floor(($diff - $years * 365*60*60*24
                    		- $months*30*60*60*24 - $days*60*60*24)
                    									/ (60*60));
                    

                    $minutes = floor(($diff - $years * 365*60*60*24
                    		- $months*30*60*60*24 - $days*60*60*24
                    							- $hours*60*60)/ 60);
                    

                    $seconds = floor(($diff - $years * 365*60*60*24
                    		- $months*30*60*60*24 - $days*60*60*24
                    				- $hours*60*60 - $minutes*60));
                    $tempo_ocioso = $hours.":".$minutes.":".$seconds;
       
                    
                    
                    
                    
                    
                    
                    $data = $gr->em_agendamento;
             
                    $duracao = '00:04:00';
                    $data2 = date('Y-m-d H:i:s');
                    $v = explode(':', $duracao);
                    $v2 = date('Y-m-d H:i:s', strtotime("{$data} + {$v[0]} hours {$v[1]} minutes {$v[2]} seconds"));
                 
                    if ($v2 < $data2) {
                        $atendimento = 'Ocioso';    
                    } else {
                        $atendimento = 'Ativo';    
                    }
                    
                    if (($atendimento) == 'Ativo') {
                        $div = '<div class="blink_me" id="circuloVerde">';
                        $pista = ' class="" style="background:green;color:white" ';
                    } else {
                        $pista = ' class="blink_me" style="background:red;color:white" ';
                        $div = '<div class="blink_me" id="circuloVermelho">';
                    }
                    
                    echo '<tr class="bg- text- py-0 align-middle"><center>
                    
                            <td '.$pista.'><center>'.$gr->usuario.'</center></td>
                            <td '.$pista.'><center>'.date('d/m/Y H:i:s', strtotime($gr->login)).'</center></td>
                            <td '.$pista.'><center>'.date('d/m/Y H:i:s', strtotime($gr->em_agendamento)).'</center></td>
                            <td '.$pista.'><center>'.date('d/m/Y H:i:s', strtotime($gr->ultima_atividade)).'</center></td>
                            <td '.$pista.'><center>'.$atendimento.'</center></td>
                            <td '.$pista.'><center>'.$tempo_ligacao.'</center></td>
                            <td '.$pista.'><center>'.$tempo_ocioso.'</center></td>
                            
                    ';
                }
            ?>

    </tbody>
  </table>
  </form>


              <!-- /.box-body -->
              </div>
          <!-- /.box 
        </div>
      </div>-->
      </div>
       </div>
      
      
      
      
        <div class="callout callout-secondary">
  <p>

   <form action="./tabulador-index" method="get">

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
                
    <div class="box-body table-responsive no-padding">


        <table id="" class="table table-striped table-sm table-bordered dataTable">
            <thead>
                <tr class="bg-light text-center py-0 align-middle">
                    <th style=" background-color:#;color:black;width:200px" colspan="19"><center>[CONTROLE DE OPERADORES - ATIVIDADES] </th> 
                </tr>
                <tr class="bg-light text- py-0 align-middle">
                    <th style=" background-color:#;color:black;width:20px"><center>Usuário</th>
                    <th style=" background-color:#;color:black;width:60px"><center>Ligações</th>
                    <th style=" background-color:#;color:black;width:90px"><center>Sem sucesso </th>
                    <th style=" background-color:#;color:black;width:90px"><center>Com sucesso </th>
                    <th style=" background-color:#;color:black;width:120px"><center>Agendamentos Hoje</th>
                    <th style=" background-color:#;color:black;width:120px"><center>Agendamentos Futuro</th>
                    
                </tr>
            </thead>
            <tbody><CENTER>
            <?php 
                $numero = 1;
                foreach ($dados['status_operadores'] as $gr) {
                    
                    date_default_timezone_set('America/Sao_Paulo');
                    
                    echo '<tr class="bg- text- py-0 align-middle"><center>
                    
                            <td><center>'.$gr->LOGIN_CADASTRO.'</center></td>
                            <td ><center>'.$gr->LIGACAO.'</center></td>
                            <td><center>'.$gr->SEM_SUCESSO.'</center></td>
                            <td><center>'.$gr->COM_SUCESSO.'</center></td>
                            <td><center>'.$gr->AGENDAMENTOS_HOJE.'</center></td>
                            <td><center>'.$gr->AGENDAMENTOS_FUTURO.'</center></td>
                                   
                    ';
                }
            ?>

    </tbody>
  </table>
  </form>


              <!-- /.box-body -->
              </div>
          <!-- /.box 
        </div>
      </div>-->
      </div>
      
      
      
      
      
      
      
      
      
      
      
      
@section('js')
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    
        /* Código exposto em uma página php */
    //var contador = '<?php //echo $fetch['time'];?>'; /**** Variável do PHP ****/
    var contador = '240';
    
    /* A partir daqui, pode ficar em um arquivo .js */
    function startTimer(duration, display) {
      var timer = duration, minutes, seconds;
      setInterval(function() {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);
    
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
    
        display.textContent = minutes + ":" + seconds;
    
        if (--timer < 0) {
          location.reload();
        }
      }, 1000);
    }
    
    window.onload = function() {
      var count = parseInt(contador),
        display = document.querySelector('#time');
      startTimer(count, display);
    };
    
    
    

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

@stop
