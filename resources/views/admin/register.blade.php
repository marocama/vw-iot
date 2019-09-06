@extends('layouts.main')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
@include('includes.alerts')
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registrar Transmissor</h6>
    </div>
    <div class="card-body">
        <form role="form" method="POST" action="{{ route('admin.tran.save') }}">
			{!! csrf_field() !!}
			<div class="form-row">
				<div class="form-group col-md-7">
					<label>Número Serial</label>
					<input id="serial" type="text" class="form-control" name="serial" placeholder="1234567ABC">
				</div>
				<div class="form-group col-md-2">
					<label>Status</label>
					<select name="status" class="form-control bg-primary text-white" style="font-family:'FontAwesome', Arial;">
						<option value="1">&#xf058;</option>
						<option value="0">&#xf057;</option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label class="text-white">.</label>
					<button class="btn btn-primary btn-block">Salvar</button>
				</div>
			</div>
		</form>
    </div>
</div>
@endsection