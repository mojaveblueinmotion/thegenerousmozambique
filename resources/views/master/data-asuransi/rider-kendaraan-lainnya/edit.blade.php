@extends('layouts.modal')

@section('action', route($routes.'.update', $record->id))

@section('modal-body')
	@method('PATCH')
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Rider Kendaraan') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="text" value="{{ $record->name }}" name="name" class="form-control" placeholder="{{ __('Rider Kendaraan') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Persentasi') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="number" value="{{ $rider->persentasi_pembayaran }}" name="persentasi_pembayaran" class="form-control" placeholder="{{ __('Persentasi') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-4 col-form-label">{{ __('Deskripsi') }}</label>
		<div class="col-md-8 parent-group">
			<textarea name="description" class="form-control" placeholder="{{ __('Deskripsi') }}">{{ $record->description }}</textarea>
		</div>
	</div>
@endsection