@extends('adminlte::page')

@section('title', 'Indicadores')

@section('content_header')
 <!--  <h1 class="m-0 text-dark">Report Instalação</h1> -->
@stop

@section('content')



    <div class="callout callout-secondary">
    <h5><B>FILTRO</B></h5><p>
         <a class="btn btn-light" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="true" aria-controls="collapseExample4">
    <i class="fa fa-minus-square" aria-hidden="true"></i> Fechar grupo
  </a><p>
 <b>Fonte de dados:</b> TOA | <b>Última atividade: </b> <?php date_default_timezone_set('America/Sao_Paulo');?>
</p>

<table class="table table-sm">
  <thead>
    <tr>
      <th style="border-color: white" scope="col"></th>
      <th scope="col" style="border-color: white"></th>
      <th colspan="3" style="background-color:#d6d5e0;color:black;width:200px"><center>Produção de Instalação</th>
      <th scope="col" style="border-color: white"></th>
      <th colspan="3" style="background-color:#d6d5e0;color:black;width:200px"><center>Produção Reparo</th>
      <th scope="col" style="border-color: white"></th>
      <th colspan="3" style="background-color:#d6d5e0;color:black;width:200px"><center>Repetida</th>
      <th scope="col" style="border-color: white"></th>
      <th colspan="3" style="background-color:#d6d5e0;color:black;width:200px"><center>Recente</th>
      <th scope="col" style="border-color: white"></th>
      <th colspan="3" style="background-color:#d6d5e0;color:black;width:200px"><center>Rep 24hs</th>
      
    </tr>
    <tr>
      <th scope="col" style="background-color:#403f45;color:white;width:100px">Filial</th>
      <th scope="col" style="background-color:#403f45;color:white;width:300px">Gestor</th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"> <center>Meta</center></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Real</th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Desv.</th>
      <th scope="col"  style="border-color: white;background-color:#;color:white;width:5px"></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"> <center>Meta</center></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Real</th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Desv.</th>

      <th scope="col" style="background-color:#;border-color: white;color:white;width:5px"></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"> <center>Meta</center></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Real</th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Desv.</th>

      <th scope="col" style="background-color:#;border-color: white;color:white;width:5px"></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"> <center>Meta</center></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Real</th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Desv.</th>

      <th scope="col" style="background-color:#;border-color: white;color:white;width:5px"></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"> <center>Meta</center></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Real</th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Desv.</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">SP</th>
      <td>BRUNO DO AMARAL MOREIRA</td>
     <td><center>0</td>
      <td><center>0</td>
      <td><center>0</td>
      <td style="border-color: white;"></td>
      <td><center>0</td>
      <td><center>0</td>
      <td><center>0</td>
      <td style="border-color: white;"></td>
      <td><center>14,00 %</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>5,50%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>87,00%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
    </tr>
     <tr>
      <th scope="row">SP</th>
      <td>RUDILEI DOS SANTOS DELPHIM</td>
      <td><center>0</td>
      <td><center>0</td>
      <td><center>0</td>
      <td style="border-color: white;"></td>
      <td><center>0</td>
      <td><center>0</td>
      <td><center>0</td>
      <td style="border-color: white;"></td>
      <td><center>14,00 %</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>5,50%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>87,00%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
    </tr>
     <tr>
      <th scope="row">SP</th>
      <td>TERCEIRA</td>
      <td><center>0</td>
      <td><center>0</td>
      <td><center>0</td>
      <td style="border-color: white;"></td>
      <td><center>0</td>
      <td><center>0</td>
      <td><center>0</td>
      <td style="border-color: white;"></td>
      <td><center>14,00 %</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>5,50%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>87,00%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
    </tr>
         <tr>
      <th style="background: #d2cfe8; color: black" scope="row">SP</th>
      <td style="background: #d2cfe8; color: black"><b>RESULTADO</b></td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="background: #; border-color:white;color: black"></td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="border-color: white;"></td>
      <td style="background: #d2cfe8; color: black"><b><center>14,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #d2cfe8; color: black"><b><center>5,50%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #d2cfe8; color: black"><b><center>87,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
    </tr>
     <tr>
      <th scope="row">RJ</th>
      <td>RAFAEL DE OLIVEIRA SANTAREM E SILVA</td>
      <td><center>0</td>
      <td><center>0</td>
      <td><center>0</td>
      <td style="border-color: white;"></td>
      <td><center>0</td>
      <td><center>0</td>
      <td><center>0</td>
      <td style="border-color: white;"></td>
      <td><center>14,00 %</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>5,50%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>87,00%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
    </tr>
         <tr>
      <th style="background: #d2cfe8; color: black" scope="row">RJ</th>
      <td style="background: #d2cfe8; color: black"><b>RESULTADO</b></td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="background: #; border-color:white;color: black"></td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="background: #d2cfe8; color: black"><b><center>0</td>
      <td style="border-color: white;"></td>
      <td style="background: #d2cfe8; color: black"><b><center>14,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #d2cfe8; color: black"><b><center>5,50%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #d2cfe8; color: black"><b><center>87,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
    </tr>
    <tr>
      <th style="background: #403f45; color: white" scope="row">FFA</th>
      <td style="background: #403f45; color: white"><b>RESULTADO</b></td>
      <td style="background: #403f45; color: white"><center>0</td>
      <td style="background: #403f45; color: white"><center>0</td>
      <td style="background: #403f45; color: white"><center>0</td>
      <td style="background: #; border-color:white;color: white"></td>
      <td style="background: #403f45; color: white"><center>0</td>
      <td style="background: #403f45; color: white"><center>0</td>
      <td style="background: #403f45; color: white"><center>0</td>
      <td style="border-color: white;"></td>
      <td style="background: #403f45; color: white"><center>14,00%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #403f45; color: white"><center>5,50%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #403f45; color: white"><center>87,00%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
    </tr>
  </tbody>
</table>

<br>

<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col" style="border-color:white;"></th>
      <th scope="col" style="border-color:white;"></th>
      <th colspan="3" style="background-color:#d6d5e0;border-color:white;color:black;width:200px"><center>Efetividade de Agenda</th>
      <th scope="col" style="border-color:white;"></th>
      <th colspan="3" style="background-color:#d6d5e0;border-color:white;color:black;width:200px"><center>Cump. Agenda</th>
      <th scope="col" style="border-color:white;"></th>
      <th colspan="3" style="background-color:#d6d5e0;border-color:white;color:black;width:200px"><center>Instalação 3 D.U.</th>
      <th scope="col" style="border-color:white;"></th>
      <th colspan="3" style="background-color:#d6d5e0;border-color:white;color:black;width:200px"><center>ME 3 D.U.</th>
     
    </tr>
    <tr>
      <th scope="col" style="background-color:#403f45;color:white;width:100px">Filial</th>
      <th scope="col" style="background-color:#403f45;color:white;width:300px">Gestor</th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"> <center>Meta</center></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Real</th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Desv.</th>

      <th scope="col" style="background-color:#;color:white;border-color:white;width:5px"></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"> <center>Meta</center></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Real</th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Desv.</th>

      <th scope="col" style="background-color:#;color:white;border-color:white;width:5px"></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"> <center>Meta</center></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Real</th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Desv.</th>

      <th scope="col" style="background-color:#;color:white;border-color:white;width:5px"></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"> <center>Meta</center></th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Real</th>
      <th scope="col" style="background-color:#403f45;color:white;width:70px"><center>Desv.</th>


     
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">SP</th>
      <td>BRUNO DO AMARAL MOREIRA</td>
      <td><center>92,00%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
     <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
     </tr>
     <tr>
      <th scope="row">SP</th>
      <td>RUDILEI DOS SANTOS DELPHIM</td>
      <td><center>92,00%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
     <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
     </tr>
     <tr>
      <th scope="row">SP</th>
      <td>TERCEIRA</td>
      <td><center>92,00%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
     <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
     </tr>
         <tr>
      <th style="background: #d2cfe8; color: black" scope="row">SP</th>
      <td style="background: #d2cfe8; color: black"><b>RESULTADO</b></td>
      <td style="background: #d2cfe8; color: black"><b><center>92,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #; border-color:white;color: black"></td>
      <td style="background: #d2cfe8; color: black"><b><center>95,24%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #d2cfe8; color: black"><b><center>95,24%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #d2cfe8; color: black"><b><center>95,24%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
     </tr>
     <tr>
      <th scope="row">RJ</th>
      <td>RAFAEL DE OLIVEIRA SANTAREM E SILVA</td>
      <td><center>92,00%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
      <td style="border-color: white;"></td>
     <td><center>95,24%</td>
      <td><center>0,00%</td>
      <td><center>0,00%</td>
    </tr>
         <tr>
      <th style="background: #d2cfe8; color: black" scope="row">RJ</th>
      <td style="background: #d2cfe8; color: black"><b>RESULTADO</b></td>
      <td style="background: #d2cfe8; color: black"><b><center>92,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #; border-color:white;color: black"></td>
      <td style="background: #d2cfe8; color: black"><b><center>95,24%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #d2cfe8; color: black"><b><center>95,24%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #d2cfe8; color: black"><b><center>95,24%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
      <td style="background: #d2cfe8; color: black"><b><center>0,00%</td>
    </tr>
    <tr>
        <th style="background: #403f45; color: white" scope="row">FFA</th>
      <td style="background: #403f45; color: white"><b>RESULTADO</b></td>
      <td style="background: #403f45; color: white"><center>92,00%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="background: #; border-color:white;color: white"></td>
      <td style="background: #403f45; color: white"><center>95,24%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #403f45; color: white"><center>95,24%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="border-color: white;"></td>
      <td style="background: #403f45; color: white"><center>95,24%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
      <td style="background: #403f45; color: white"><center>0,00%</td>
    </tr>
  </tbody>
</table>


@stop
