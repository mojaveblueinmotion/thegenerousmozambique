@extends('layouts.modal')

@section('action', route($routes.'.store'))

@section('modal-body')
	@method('POST')
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Rider Motor') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="text" name="name" class="form-control" placeholder="{{ __('Rider Motor') }}">
		</div>
	</div>
	<div class="form-group row">
        <label class="col-md-4 col-form-label">{{ __('Pertanggungan Yang Dikalikan') }}</label>
        <div class="col-md-8 parent-group">
            <select name="pertanggungan_id" class="form-control base-plugin--select2-ajax pertanggungan_id"
                data-url="{{ route('ajax.selectPertanggunganTambahan', ['search' => 'all']) }}"
                placeholder="{{ __('Pilih Salah Satu') }}">
                <option value="">{{ __('Pilih Salah Satu') }}</option>
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
