<!-- resources/views/notas_fiscais/create.blade.php -->
@extends('adminlte::page')


@section('content')
    <h1>Cadastrar Nota Fiscal</h1>
    <form action="{{ route('notas_fiscais.store') }}" method="POST">
        @csrf
        @include('notas_fiscais.form')
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection
