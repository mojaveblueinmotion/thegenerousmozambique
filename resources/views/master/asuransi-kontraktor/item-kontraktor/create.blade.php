@extends('layouts.modal')

@section('action', route($routes.'.store'))

@section('modal-body')
	@method('POST')
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Nama') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="text" name="name" class="form-control" placeholder="{{ __('Nama') }}">
		</div>
	</div>
	<div class="form-group row">
        <label class="col-md-4 col-form-label">{{ __('Bagian') }}</label>
        <div class="col-md-8 parent-group">
            <select name="section" class="form-control base-plugin--select2-ajax section"
                placeholder="{{ __('Pilih Salah Satu') }}">
                <option value="">{{ __('Pilih Salah Satu') }}</option>
                <option value="1">{{ __('Bagian 1') }}</option>
                <option value="2">{{ __('Bagian 2') }}</option>
            </select>
        </div>
    </div>
	<div class="form-group row">
		<label class="col-md-4 col-form-label">{{ __('Deskripsi') }}</label>
		<div class="col-md-8 parent-group">
			<textarea name="description" class="form-control" placeholder="{{ __('Deskripsi') }}"></textarea>
		</div>
	</div>
@endsection
