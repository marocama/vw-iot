<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Dados</h6>
    </div>
    <div class="card-body">
    @forelse ($readouts as $readout)
        <span class="text-muted">
        @if (date('d/m/Y') == date('d/m/Y', strtotime($readout->created_at)))
            Hoje, às {{ date('H:i', strtotime($readout->created_at)) }}
        @elseif (date('d/m/Y', strtotime('yesterday')) == date('d/m/Y', strtotime($readout->created_at)))
            Ontem, às {{ date('H:i', strtotime($readout->created_at)) }}
        @else
            {{ date('d/m/Y à\s H:i', strtotime($readout->created_at)) }}
        @endif
        </span>
        <br>
        &nbsp;&nbsp;&nbsp;{<br>
        @foreach ($readout->protocol as $key => $value)
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>"{{ $key }}"</b> : "{{ $value }}",<br>
        @endforeach
        &nbsp;&nbsp;&nbsp;}<br><hr>
    @empty
        <span class="text-muted">Nenhum registro encontrado.</span>
    @endforelse
    </div>
</div>