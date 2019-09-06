@extends('layouts.main')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
@include('includes.alerts')
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Consulta</h6>
    </div>
    <div class="card-body">
        <form role="form" method="POST" action="{{ route('admin.tran.edit') }}">
			{!! csrf_field() !!}
			<input type="hidden" name="identify" id="identify" value="{{$tran->id}}">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label>Identificador</label>
					<input id="name" type="text" class="form-control" name="name" value="{{$tran->name}}">
				</div>
				<div class="form-group col-md-4">
					<label>Número Serial</label>
					<input id="serial" type="text" class="form-control" name="serial" value="{{$tran->number_serial}}">
				</div>
				<div class="form-group col-md-2">
					<label>Status</label>
					<select name="status" class="form-control bg-primary text-white" style="font-family:'FontAwesome', Arial;">
						<option value="1" @if($tran->status) selected @endif>&#xf058;</option>
						<option value="0" @if(!$tran->status) selected @endif>&#xf057;</option>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label>Localização</label>
					<input id="location" type="text" class="form-control" name="location" value="{{$tran->location}}">
				</div>
				<div class="form-group col-md-4">
					<label>Proprietário</label>
					<input id="user" type="text" class="form-control" name="user" disabled value="@if($user->count() > 0){{$user->name}}@else---@endif">
				</div>
				<div class="form-group col-md-2">
					<label>Interface</label>
					<input id="interface" type="text" class="form-control" name="interface" disabled value="@if($interface->count() > 0){{$interface->name}}@else---@endif">
				</div>		
			</div><br>
			<div class="form-group">
				<button class="btn btn-primary btn-block">Salvar</button>
			</div>
		</form>
    </div>
</div>
@endsection