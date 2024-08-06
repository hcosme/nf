{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'Cadastro')
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
@section('content_header')
@stop
<?php //dd($dados['funcionarios']);?>
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
<form role="form" method="post" action="./editar_contato_novo">
   <div class="box-body">
      {{ csrf_field()  }}
      <br>
      <div class="col-lg-12">
         <h5 style="color:#;"><b>Dados da Básicos</b></h5>
         <hr>
         <div class="row">
            <div class="form-group col-md-4">
               <label for="exampleInputEmail1">Nome:</label>
               <input type="text" class="form-control form-control-sm" name="nome" style="background:#" placeholder="José Arimatéia" value="{{ $dados['dados'][0]->nome }}">
               <input type="hidden" class="form-control form-control-sm" name="id" style="background:#" value="{{ $dados['dados'][0]->id }}">
            </div>
            
            <div class="form-group col-md-4">
               <label for="exampleInputEmail1">Contato:</label>
               <input type="text" class="form-control form-control-sm" name="contato" style="background:#" placeholder="Exemplo preenchimento: 21999999999" value="{{ $dados['dados'][0]->contato }}">
            </div>
            
            <div class="form-group col-md-4">
               <label for="exampleInputEmail1">Status:</label>
               <select class="form-control form-control-sm" name="status" required>
                    <option "{{ $dados['dados'][0]->status }}">{{ $dados['dados'][0]->status }}</option>
                    <option "ATIVO">ATIVO</option>
                    <option "INATIVO">INATIVO</option>
               </select>
            </div>
           
            <div class="form-group col-md-12">
               <label for="exampleInputEmail1">Mensagem:</label>
               <textarea type="text" class="form-control form-control-sm" name="motivo"  rows="3" style="background:#" placeholder="Coloque uma mensagem de no máximo 120 caracteres.">{{ $dados['dados'][0]->motivo }}</textarea>
            
            </div>
           
           
            <div class="form-group col-md-3">
               <label for="exampleInputEmail1">Data cadastro:</label>
               <input type="text" class="form-control form-control-sm" name="data_cadastro" style="background:#" value="<?php date_default_timezone_set('America/Sao_Paulo'); echo date('d/m/Y H:i:s');?>" readonly="" >
            </div>
            <div class="form-group col-md-3">
               <label for="exampleInputEmail1">Login Cadastro:</label>
               <input type="text" class="form-control form-control-sm" name="login_cadastro" style="background:#" value="<?php echo  auth()->user()->name;?>" readonly="">
            </div>
         </div>
         <br>
      </div>
      <br>
      <br>
      <div class="box-footer">
         <button type="submit" class="btn btn-success">Salvar</button> </a>
         <a href="./"><button type="button" class="btn btn-secondary">Retornar</button> </a>
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