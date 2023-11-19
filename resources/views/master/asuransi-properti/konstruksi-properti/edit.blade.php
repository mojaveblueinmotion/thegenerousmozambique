@extends('layouts.modal')

@section('action', route($routes.'.update', $record->id))

@section('modal-body')
	@method('PATCH')
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Nama') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="text" value="{{ $record->name }}" name="name" class="form-control" placeholder="{{ __('Nama') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Zona 1') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="number" value="{{ $record->zona_satu }}" name="zona_satu" class="form-control" placeholder="{{ __('Zona 1') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Zona 2') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="number" value="{{ $record->zona_dua }}" name="zona_dua" class="form-control" placeholder="{{ __('Zona 2') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Zona 3') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="number" value="{{ $record->zona_tiga }}" name="zona_tiga" class="form-control" placeholder="{{ __('Zona 3') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Zona 4') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="number" value="{{ $record->zona_empat }}" name="zona_empat" class="form-control" placeholder="{{ __('Zona 4') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Zona 5') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="number" value="{{ $record->zona_lima }}" name="zona_lima" class="form-control" placeholder="{{ __('Zona 5') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-4 col-form-label">{{ __('Deskripsi') }}</label>
		<div class="col-md-8 parent-group">
			<textarea name="description" class="form-control" placeholder="{{ __('Deskripsi') }}">{{ $record->description }}</textarea>
		</div>
	</div>
@endsection
