{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'Advertências')
@section('content_header')
@stop
@section('content')
<div class="callout callout-info">
</div>
<div class="callout callout-info">
<div class="row">
<!-- left column -->
<div class="col-lg-12">
<!-- general form elements -->
<div class="box box-primary">
<div class="box-header with-border">
   <h3 class="box-title"></h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<form role="form" method="post" action="./cadastrar-advertencia">
   <div class="box-body">
   {{ csrf_field()  }}
   <br>
   <div class="col-lg-12">
      <h5 style="color:#;"><b>Dados da Básicos</b></h5>
      <hr>
      <div class="row">
         <div class="form-group col-md-8">
            <label for="exampleInputEmail1">Colaborador:</label>
            <select name="colaborador" class="form-control form-control-sm" value="" required>
               @foreach ($dados['dados'] as $d)
               <option value="{{ $d->tecnicos }}">{{ $d->tecnicos }}</option>
               @endforeach
            </select>
         </div>
         <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Motivo:</label>
            <input type="text" class="form-control form-control-sm" name="motivo" style="background:#" value="" required>
         </div>
         <div class="form-group col-md-2">
            <label for="exampleInputEmail1">Data Ocorrido:</label>
            <input type="date" class="form-control form-control-sm" name="data_ocorrido" style="background:#" value="" required>
         </div>
         <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Local Ocorrido:</label>
            <input type="text" class="form-control form-control-sm" name="local_ocorrido" style="background:#" value="" required>
         </div>
         <div class="form-group col-md-2">
            <label for="exampleInputEmail1">Data Aplicação:</label>
            <input type="date" class="form-control form-control-sm" name="data_aplicacao" style="background:#" value="">
         </div>
         <div class="form-group col-md-2">
            <label for="exampleInputEmail1">Horário Aplicação:</label>
            <input type="time" class="form-control form-control-sm" name="horario_aplicacao" style="background:#" value="">
         </div>
         <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Local Aplicação:</label>
            <input type="text" class="form-control form-control-sm" name="local_aplicacao" style="background:#" value="" required>
         </div>
         <div class="form-group col-md-2">
            <label for="exampleInputEmail1">Aplicado por:</label>
            <input type="text" class="form-control form-control-sm" name="lider_aplicacao" style="background:#" value="" required>
         </div>
          <div class="form-group col-md-2">
            <label for="exampleInputEmail1">Tipo Advertência:</label>
            <select name="tipo_advertencia" class="form-control form-control-sm" value="" required>
               <option value="Marcacao ou inclusao indevida">Marcação ou inclusão indevida</option>
               <option value="Ausencia injustificada">Ausencia injustificada</option>
               <option value="Falta no plantao">Falta no plantão</option>
               <option value="Lider que nao informa troca de turno">Lider que não informa troca de turno</option>
            </select>
         </div>
         <div class="form-group col-md-2">
            <label for="exampleInputEmail1">Status:</label>
            <select name="status" class="form-control form-control-sm" value="" readonly="readonly">
               <option value="PENDENTE">Criação</option>
            </select>
         </div>
         <div class="form-group col-md-2">
            <label for="exampleInputEmail1">Usuário:</label>
            <input type="text" class="form-control form-control-sm" name="usuario" style="background:#" value="{{ auth()->user()->name }}" readonly="">
         </div>
         <div class="form-group col-md-12">
            <label for="exampleFormControlTextarea1">Observação:</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="consideracoes" required></textarea>
         </div>
      </div>
      </head>
      <br>
      <div class="box-footer">
         <button type="submit" class="btn btn-success">Salvar</button> </a>
         <a href="./advertencia"><button type="button" class="btn btn-secondary">Retornar</button> </a>
      </div>
      <br>
</form>
</div>
<!-- /.box -->
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
@stop