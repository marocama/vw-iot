@extends('layouts.main')

@section('content')
@include('includes.alerts')
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transmissores</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="width:10%"></th>
                    <th scope="col">Identificador</th>
                    <th scope="col">Registro</th>
                    <th scope="col" class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
            @forelse($boards as $board)
                <tr>
                    <th scope="row" class="text-center align-middle">
                        <form role="form" method="POST" action="{{ route('monitoring') }}">
                            {!! csrf_field() !!}  
                            <input type="hidden" name="interaction" id="interaction" value="{{ $board->interaction_id }}">
                            <input type="hidden" name="number_serial" id="number_serial" value="{{ $board->number_serial }}">
                            <button type="submit" class="btn btn-primary btn-sm text-white my-1 mx-1"><i class="fas fa-eye"></i></button>
                        </form>
                        <a class="btn btn-secondary btn-sm text-white" href="
                        @if ($board->location != NULL)
                        https://www.google.com.br/maps/search/{{ $board->location }}"
                        @else
                        " data-toggle="modal" data-target="#locationModal"
                        @endif
                        target="_blank"><i class="fas fa-map"></i></a>
                    </th>
                    <td class="align-middle">{{ $board->name }}</td>
                    <td class="align-middle">{{ $board->number_serial }}</td>
                    <td class="align-middle text-center">
                    @if($board->status)
                        <i class="fas fa-check-circle text-success"></i>
                    @else
                        <i class="fas fa-times-circle text-danger"></i>
                     @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Você não possui nenhum transmissor registrado.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel"><i class="fas fa-question-circle"></i> Ops..</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Parece que este transmissor não possui um endereço cadastrado.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
@endsection