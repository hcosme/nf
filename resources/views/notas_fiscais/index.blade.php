<!-- resources/views/notas_fiscais/index.blade.php -->
@extends('adminlte::page')


@section('content')
    <h1>Notas Fiscais Pendentes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>CPF/CNPJ</th>
                <th>Escopo</th>
                <th>Número NF</th>
                <th>Série</th>
                <th>Data de Emissão</th>
                <th>Item</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notasFiscais as $notaFiscal)
                <tr>
                    <td>{{ $notaFiscal->id }}</td>
                    <td>{{ $notaFiscal->status }}</td>
                    <td>{{ $notaFiscal->cpf_cnpj }}</td>
                    <td>{{ $notaFiscal->escopo }}</td>
                    <td>{{ $notaFiscal->numero_nf }}</td>
                    <td>{{ $notaFiscal->serie }}</td>
                    <td>{{ $notaFiscal->data_emissao }}</td>
                    <td>{{ $notaFiscal->item }}</td>
                    <td>{{ $notaFiscal->quantidade }}</td>
                    <td>{{ $notaFiscal->valor_unit_item }}</td>
                    <td>{{ $notaFiscal->total_valor }}</td>
                    <td>
                        <form action="{{ route('notas_fiscais.approve', $notaFiscal->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success">Aprovar</button>
                        </form>
                        <form action="{{ route('notas_fiscais.reject', $notaFiscal->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Rejeitar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
