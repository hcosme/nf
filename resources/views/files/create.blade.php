@extends('adminlte::page')

@section('title', 'Requisitos')

@section('content_header')
    <h1>Check List</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Requisito</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                            <form id="form" action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order_id }}">
                                @foreach ($requisitos as $requisito)
                                    @php
                                        $status = "Aguardando envio"
                                    @endphp
                                    @if ($requirements->count() > 0)
                                        @php
                                            $status = $requirements->where('name', $requisito)->first()->status;
                                        @endphp
                                    @endif
                                    <tr class="">
                                        <td>{{ $requisito }}</td>
                                        <td>{{ $status }}</td>
                                        <td>
                                            @if ($status != "Aprovado" && $status != "Aguardando Aprovaçao")
                                                @if ($requisito == 'Fechamento')
                                                    <select name="{{ $requisito }}" id="{{ $requisito }}" class="form-control">
                                                        @foreach ($fechamentos as $fechamento)
                                                            <option value="{{ $fechamento->fechamento }}" >{{ $fechamento->fechamento }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="file" name="{{ $requisito }}">
                                                    @error('requirement')
                                                        <span class="invalid-feedback" style="display: revert;" role="alert">
                                                            <strong>
                                                                Este documento é obrigatório.
                                                            </strong>
                                                        </span>
                                                    @enderror
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                    <br>
                    <button onclick="submit()" class="btn btn-primary float-sm-right">
                        Enviar
                    </button>
                    <a href="{{ route('testefinal') }}" class="btn btn-default float-sm-right mr-2">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

@endsection

@section('footer')

@endsection

@section('css')
@endsection

@section('js')
    <script>
        function submit() {
            document.getElementById("form").submit();
        }
    </script>
@endsection