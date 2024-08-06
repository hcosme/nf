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
        <td>{{ $requisito }} @if($requisito == 'Fechamento') - {{ $requirement->closure->reason }} @endif</td>
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
                <button title="Aprovar" onclick="aprove({{ $requirement->id }}, '{{ $table }}')" class="btn btn-success btn-sm">
                    <i class="fas fa-solid fa-check"></i>
                </button>
                <button title="Reprovar" onclick="reprove({{ $requirement->id }}, '{{ $table }}')" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">
                    <i class="fas fa-solid fa-times"></i>
                </button>
            @endif
        </td>
    </tr>
@endforeach