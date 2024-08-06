{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'Cadastro')
@section('content_header')
@stop
@section('content')
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
<form role="form" method="post" action="./editar-nf" enctype="multipart/form-data">
    <div class="box-body">
        {{ csrf_field() }}
        <br>
        <div class="callout callout-info">
            <div class="col-lg-12">
                <h5 style="color:#;"><b>Dados da Básicos</b></h5>
                <hr>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Material/Serviço:</label>
                        <select class="form-control form-control-md" name="status" style="background:#F8F8FF" readonly>
                            <option value="{{ $dados[0]->status }}">{{ $dados[0]->status }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">CPF/CNPJ:</label>
                        <select class="form-control form-control-md" name="cpf_cnpj" style="background:#F8F8FF" readonly>
                            <option value="{{ $dados[0]->cpf_cnpj }}">{{ $dados[0]->cpf_cnpj }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Escopo:</label>
                        <select class="form-control form-control-md" name="escopo" style="background:#F8F8FF" readonly>
                            <option value="{{ $dados[0]->escopo }}">{{ $dados[0]->escopo }}</option>
                        </select>
                    </div>
                    <!--<div class="form-group col-md-2">
                        <label for="exampleInputEmail1"><b style="color: white">.</b></label>
                        <input type="submit" class="form-control form-control-md btn btn-light" value="Pesquisar">
                    </div> -->
                </div>
            </div>
        </div>
        <div class="callout callout-info">
            <h5><b>Dados da nota fiscal</b></h5>
            <hr>
            <br>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Nr.Nota:</label>
                    <input type="number" class="form-control form-control-sm" readonly style="background:#F8F8FF" name="numero_nf"  value="{{ $dados[0]->numero_nf }}">
                </div>
                <div class="form-group col-md-2">
                    <label for="exampleInputEmail1">Série:</label>
                    <input type="number" class="form-control form-control-sm" readonly style="background:#F8F8FF" name="serie" value="{{ $dados[0]->serie }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Valor da nota:</label>
                     @php
                        $totalSum = 0;
                    @endphp
                    @foreach ($dados as $nf) 
                    @php
                        $totalSum += $nf->total_valor;
                    @endphp
                    @endforeach
                    <input type="text" class="form-control form-control-sm" style="background:#F8F8FF" name="total_valor" id="total_valor" value="{{ number_format((float) $totalSum, 2, ',', '.') }}" readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="exampleInputEmail1">Data emissão:</label>
                    <input type="date" class="form-control form-control-sm" style="background:#F8F8FF" readonly name="data_emissao" value="{{ $dados[0]->data_emissao }}">
                </div>
                <br><br><br><br>
                <hr><br>
            </div>
        </div>
        <div class="callout callout-info">
            <h5><b>Itens da nota fiscal</b></h5>
            <hr>
            <br>
            <div class="row">
                <table id="tbl_atribuicao" class="table table-striped table-sm table-bordered dataTable">
                    <thead>
                        <tr class="bg-light text-center py-0 align-middle">
                            <th class="cabecalho" style="width:120px">
                                <center>Pedidos</center>
                            </th>
                            <th class="cabecalho" style="width:60px">
                                <center>Descrição/Item</center>
                            </th>
                            <th class="cabecalho" style="width:60px">
                                <center>Quantidade</center>
                            </th>
                            <th class="cabecalho" style="width:60px">
                                <center>Vr.Unitário</center>
                            </th>
                            <th class="cabecalho" style="width:60px">
                                <center>Vr.Total</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            
                        $qtdColuna = 1;
                        @endphp
                        @foreach ($dados as $nf) 
                        <tr>
                            <td><center><input style="background:#F8F8FF" readonly class="form-control form-control-sm" type="text" value="{{ $nf->pedido }}" name="pedido[]" /></td>
                            <td><center><input style="background:#F8F8FF" readonly class="form-control form-control-sm" type="text" value="{{ $nf->item }}" name="item[]" /></td>
                            <td><center><input  style="background:#F8F8FF" readonly class="form-control form-control-sm" type="number" value="{{ $nf->quantidade }}" name="quantidade[]" /></td>
                            <td><center><input style="background:#F8F8FF" readonly class="form-control form-control-sm" type="text" value="{{ number_format((float) $nf->valor_unit_item, 2, ',', '.') }}" name="valor_unit_item[]" /></td>
                            <td><center><input style="background:#F8F8FF" readonly class="form-control form-control-sm" type="text" value="{{ number_format((float) $nf->total_valor, 2, ',', '.') }}" name="total_valor[]" /></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" class="form-control form-control-sm" name="usuario" style="background:#" value="{{ auth()->user()->name }}" readonly="">
            </div>
        </div>
        
        <br>
        @if ( auth()->user()->role == 'administrador') 
         <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Status:</label>
                  <select class="form-control form-control-md" name="situacao">
                    
                 <option value="{{ $dados[0]->situacao }}">{{ $dados[0]->situacao }} | Atual</option>
        
                  <option value="select">Selecione</option>
                  <option value="Em processamento">Em processamento</option>
                  <option value="Nota aceita">Nota aceita</option>
                  <option value="Nota recusada">Nota recusada</option>
                  <option value="Aguardando Pagamento">Aguardando pagamento</option>
                  <option value="Pagamento efetuado">Pagamento efetuado</option>
             
                  </select>
                </div>
             
        <div class="box-footer">
            <button type="submit" class="btn btn-success">Salvar</button>
        @endif
            <a href="./notas_fiscais"><button type="button" class="btn btn-secondary">Retornar</button></a>
        </div>
        <br>
    </div>
</form>
<!-- /.box -->
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
function limpaCampos() {
    document.getElementById("new-item1").value = '';
    document.getElementById("new-item2").value = '';
    document.getElementById("new-item3").value = '';
    document.getElementById("new-item4").value = '';
    document.getElementById("new-item5").value = '';
}

RemoveTableRow = function(handler) {
    var tr = $(handler).closest('tr');
    tr.fadeOut(400, function() {
        tr.remove();
        updateNotaTotal();
    });
    return false;
};

function calculateTotal() {
    var quantity = parseFloat(document.getElementById("new-item3").value) || 0;
    var unitPrice = parseFloat(document.getElementById("new-item4").value) || 0;
    var totalPrice = quantity * unitPrice;
    document.getElementById("new-item5").value = totalPrice.toFixed(2);
}

function updateNotaTotal() {
    var total = 0;
    $('input[name="total_valor[]"]').each(function() {
        total += parseFloat($(this).val()) || 0;
    });
    $('#vlr_nota').val(total.toFixed(2));
}

$(function() {
    $('#add-item').on('click', function() {
        var itemText1 = $('#new-item1').val();
        var itemText2 = $('#new-item2').val();
        var itemText3 = $('#new-item3').val();
        var itemText4 = $('#new-item4').val();
        var itemText5 = $('#new-item5').val();
        var newEl = $('<tr>
                        <td><input readonly class="form-control form-control-sm" type="text" value="' + itemText1 + '" name="pedido[]" /></td>
                        <td><input readonly class="form-control form-control-sm" type="text" value="' + itemText2 + '" name="item[]" /></td>
                        <td><input readonly class="form-control form-control-sm" type="number" value="' + itemText3 + '" name="quantidade[]" /></td>
                        <td><input readonly class="form-control form-control-sm" type="number" value="' + itemText4 + '" name="valor_unit_item[]" /></td>
                        <td><input readonly class="form-control form-control-sm" type="number" value="' + itemText5 + '" name="total_valor[]" /></td><td>
                        <button class="btn btn-danger waves-effect w-md waves-light m-b-5" onclick="RemoveTableRow(this)" type="button">X</button></td>
                        </tr>
                        ');

        newEl.hide();
        $('tbody').prepend(newEl);
        newEl.slideDown();
        limpaCampos();
        updateNotaTotal();
    });

    $(document).on('input', 'input[name="quantidade[]"], input[name="valor_unit_item[]"]', function() {
        var $row = $(this).closest('tr');
        var quantity = parseFloat($row.find('input[name="quantidade[]"]').val()) || 0;
        var unitPrice = parseFloat($row.find('input[name="valor_unit_item[]"]').val()) || 0;
        var totalPrice = quantity * unitPrice;
        $row.find('input[name="total_valor[]"]').val(totalPrice.toFixed(2));
        updateNotaTotal();
    });

});
</script>
@stop
