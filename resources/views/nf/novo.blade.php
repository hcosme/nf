@extends('adminlte::page')
@section('title', 'Cadastro')
@section('content_header')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
            </div>

            @if (auth()->user()->status == 'pendente')
                <center><h3>Aguarde até que seja feita sua aprovação.</h3></center>
            @endif

            @if (auth()->user()->status != 'pendente')
                <form role="form" method="post" action="./cadastrar-nf" enctype="multipart/form-data">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <br>
                        <div class="callout callout-info">
                            <div class="col-lg-12">
                                <h5 style="color:#;"><b>Dados Básicos</b></h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">Empresa:</label>
                                        <select class="form-control form-control-md" name="empresa">
                                            <option value="02032251000183">TLP</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="exampleInputEmail1">Material/Serviço:</label>
                                        <select class="form-control form-control-md" name="status">
                                            <option value="Material">Material</option>
                                            <option value="Serviço">Serviço</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1">CPF/CNPJ:</label>
                                        <select class="form-control form-control-md" name="cpf_cnpj">
                                            <option value="{{ auth()->user()->cpf }}">{{ auth()->user()->cpf }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="exampleInputEmail1">Escopo:</label>
                                        <select class="form-control form-control-md" name="escopo">
                                            <option value="Pedido de Compra">Pedido de Compra</option>
                                            <option value="Contratual">Contratual</option>
                                        </select>
                                    </div>
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
                                    <input type="number" class="form-control form-control-sm" name="numero_nf" style="background:#" value="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="exampleInputEmail1">Série:</label>
                                    <input type="number" class="form-control form-control-sm" name="serie" style="background:#" value="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="exampleInputEmail1">Data emissão:</label>
                                    <input type="date" class="form-control form-control-sm" name="data_emissao" style="background:#" value="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="exampleInputEmail1">Anexo:</label>
                                    <input type="file" class="form-control form-control-sm" name="anexo_nf" style="background:#" value="">
                                </div>
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
                                            <th class="cabecalho" style="width:100px">
                                                <center>Ações</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pedidos as $nf) 
                                            <tr>
                                                <td><input style="background:#F8F8FF" readonly class="form-control form-control-sm" type="text" value="{{ $nf->pedido }}" name="pedido[]" /></td>
                                                <td><input style="background:#F8F8FF" readonly class="form-control form-control-sm" type="text" value="{{ $nf->item }}" name="item[]" /></td>
                                                <td><input style="background:#F8F8FF" readonly class="form-control form-control-sm" type="number" value="{{ $nf->quantidade }}" oninput="calculateTotal(this)" name="quantidade[]" /></td>
                                                <td><input style="background:#F8F8FF" readonly class="form-control form-control-sm" type="text" value="{{ number_format((float) $nf->valor_unit, 2, ',', '.') }}" oninput="calculateTotal(this)" name="valor_unit_item[]" /></td>
                                                <td><input style="background:#F8F8FF" readonly class="form-control form-control-sm" type="text" value="{{ number_format((float) ($nf->valor_unit * $nf->quantidade), 2, ',', '.') }}" name="total_valor[]" /></td>
                                                <td><input type="checkbox" class="item-checkbox" name="selected_items[]" value="{{ $nf->id }}" onchange="updateSelectedTotal()"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <input type="hidden" class="form-control form-control-sm" name="usuario" style="background:#" value="{{ auth()->user()->name }}" readonly="">
                            </div>
                        </div> 

                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail1">Valor da nota:</label>
                            <input type="text" class="form-control form-control-sm" name="total_valor" id="total_valor" style="background:#" value="" readonly>
                        </div>

                        <br>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="./notas_fiscais"><button type="button" class="btn btn-secondary">Retornar</button></a>
                        </div>
                        <br>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

function parseCurrency(value) {
    if (!value) return 0;
    return parseFloat(value.replace(/\./g, '').replace(',', '.')) || 0;
}

function formatCurrency(value) {
    return value.toFixed(2).toString().replace('.', ',');
}

function updateSelectedTotal() {
    var total = 0;
    $('.item-checkbox:checked').each(function() {
        var $row = $(this).closest('tr');
        var totalPrice = parseCurrency($row.find('input[name="total_valor[]"]').val());
        total += totalPrice;
    });
    $('#total_valor').val(formatCurrency(total));
}

function calculateTotal(input) {
    var $row = $(input).closest('tr');
    var quantity = parseFloat($row.find('input[name="quantidade[]"]').val()) || 0;
    var unitPrice = parseFloat($row.find('input[name="valor_unit_item[]"]').val().replace(',', '.')) || 0;
    var totalPrice = quantity * unitPrice;
    $row.find('input[name="total_valor[]"]').val(formatCurrency(totalPrice));
    updateSelectedTotal();
}

$(document).ready(function() {
    $('.item-checkbox').change(updateSelectedTotal);

    $('input[name="quantidade[]"], input[name="valor_unit_item[]"]').on('input', function() {
        calculateTotal(this);
    });
});

</script>
@stop

@endsection
