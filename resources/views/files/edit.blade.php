@extends('adminlte::page')

@section('title', 'Requisitos')

@section('content_header')
    <h1>Check list</h1>
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
                        <tbody class="table-one">
                            @if ($requirements->count() > 0)
                                @foreach ($requisitos as $requisito)
                                    @php
                                        $status = "Aguardando envio"
                                    @endphp
                                    @if ($requirements->count() > 0)
                                        @php
                                            $requirement = $requirements->where('name', $requisito)->first();
                                            $status = $requirement->status;
                                        @endphp
                                    @endif
                                    <tr class="">
                                        <td>{{ $requisito }}@if($requisito == 'Fechamento') - {{ $requirement->closure->reason }} @endif</td>
                                        <td>{{ $status }}</td>
                                        <td>
                                            @if (questionsOperation($requisito) && $requisito != 'Fechamento')
                                                <a class="btn btn-light btn-sm" title="Ver documento" href="{{ $requirement->file ? asset('storage/' . $requirement->file->path) : null }}" target="_blank">
                                                    <i class="fas fa-solid fa-eye"></i>
                                                </a>
                                                <a class="btn btn-light btn-sm" title="Baixar documento" href="{{ $requirement->file ? asset('storage/' . $requirement->file->path) : null }}" download="{{ $requisito }}">
                                                    <i class="fas fa-solid fa-download"></i>
                                                </a>
                                            @endif
                                            @if($status != "Aprovado" && $status != "Reprovado")
                                                <button title="Aprovar" onclick="aprove({{ $requirement->id }}, 'table-one')" class="btn btn-success btn-sm">
                                                    <i class="fas fa-solid fa-check"></i>
                                                </button>
                                                <button title="Reprovar" onclick="reprove({{ $requirement->id }}, 'table-one')" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                                                    <i class="fas fa-solid fa-times"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">
                                        Essa ordem ainda não foi atendida;
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

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
                        <tbody class="table-two">
                            @if ($requirements->count() > 0)
                                @foreach ($requirements_aditional as $requisito)
                                    @php
                                        $status = "Aguardando envio"
                                    @endphp
                                    @if ($requirements->count() > 0)
                                        @php
                                            $requirement = $requirements->where('name', $requisito)->first();
                                            $status = $requirement->status;
                                        @endphp
                                    @endif
                                    <tr class="">
                                        <td>{{ $requisito }}</td>
                                        <td>{{ $status }}</td>
                                        <td>
                                            @if (questionsOperation($requisito))
                                                <a class="btn btn-light btn-sm" title="Ver documento" href="{{ $requirement->file ? asset('storage/' . $requirement->file->path) : null }}" target="_blank">
                                                    <i class="fas fa-solid fa-eye"></i>
                                                </a>
                                                <a class="btn btn-light btn-sm" title="Baixar documento" href="{{ $requirement->file ? asset('storage/' . $requirement->file->path) : null }}" download="{{ $requisito }}">
                                                    <i class="fas fa-solid fa-download"></i>
                                                </a>
                                            @endif
                                            @if($status != "Aprovado" && $status != "Reprovado")
                                                <button title="Aprovar" onclick="aprove({{ $requirement->id }}, 'table-two')" class="btn btn-success btn-sm">
                                                    <i class="fas fa-solid fa-check"></i>
                                                </button>
                                                <button title="Reprovar" onclick="reprove({{ $requirement->id }}, 'table-two')" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                                                    <i class="fas fa-solid fa-times"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">
                                        Essa ordem ainda não foi atendida
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form id="form" action="{{ route('file.upload.operador') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order_id }}">
                        <label for="file">Anexar dois anexos (01 obrigatório outro opcional)</label>
                        @if (isset($op) && $op->file == null)
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <input type="file" name="2" required>
                                    @error('requirement')
                                        <span class="invalid-feedback" style="display: revert;" role="alert">
                                            <strong>
                                                Este documento é obrigatório.
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <input type="file" name="3">
                                    @error('requirement')
                                        <span class="invalid-feedback" style="display: revert;" role="alert">
                                            <strong>
                                                Este documento é obrigatório.
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <button onclick="submit()" class="btn btn-primary float-sm-right">
                                    Enviar
                                </button>
                            </div>
                        @elseif (isset($op) && $op->file != null)
                            <br>
                            <strong>Imagens já foram salvas!</strong>
                        @else
                            <br>
                            <strong>Essa ordem ainda não foi atendida </strong>
                        @endif
                    </form>
                </div>
            </div>

            <a href="{{ route('testefinal') }}" class="btn btn-default float-sm-right mr-2">
                Voltar
            </a>

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

    function aprove(id, table) {
        $.ajax({
            url: "/file/approve/" + id,
            type: "POST",
            data: {
                id: id,
                table: table,
                type: '{{ $type }}',
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                if (data.data.table == 'table-one') {
                    $('.table-one').html(data.data.html);
                } else {
                    $('.table-two').html(data.data.html);
                }
            }
        });
    }
    function reprove(id, table) {
        $.ajax({
            url: "/file/reprove/" + id,
            type: "POST",
            data: {
                id: id,
                table: table,
                type: '{{ $type }}',
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                if (data.data.table == 'table-one') {
                    $('.table-one').html(data.data.html);
                } else {
                    $('.table-two').html(data.data.html);
                }
            }
        });
    }
    </script>
@endsection