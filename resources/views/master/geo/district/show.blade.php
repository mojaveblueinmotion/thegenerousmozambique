@extends('layouts.modal')

@section('modal-body')
	<div class="form-group row">
		<label class="col-sm-12 col-form-label">{{ __('Kota') }}</label>
		<div class="col-sm-12 parent-group">
			<input type="text" value="{{ $record->city->name }}" class="form-control" placeholder="{{ __('Kota') }}" disabled>
		</div>
	</div>
    <div class="form-group row">
		<label class="col-sm-12 col-form-label">{{ __('Kode') }}</label>
		<div class="col-sm-12 parent-group">
			<input type="text" value="{{ $record->code }}" class="form-control" placeholder="{{ __('Kode') }}" disabled>
		</div>
	</div>
    <div class="form-group row">
		<label class="col-sm-12 col-form-label">{{ __('Nama') }}</label>
		<div class="col-sm-12 parent-group">
			<input type="text" value="{{ $record->name }}" class="form-control" placeholder="{{ __('Nama') }}" disabled>
		</div>
	</div>
@endsection

@section('modal-footer')
@endsection
