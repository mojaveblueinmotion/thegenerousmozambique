@extends('layouts.modal')

@section('action', route($routes.'.store'))

@section('modal-body')
	@method('POST')
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">{{ __('Judul') }}</label>
		<div class="col-sm-10 parent-group">
			<input type="text" name="title" class="form-control" placeholder="{{ __('Judul') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-2 col-form-label">{{ __('Isi') }}</label>
		<div class="col-md-10 parent-group">
			<textarea name="description" class="base-plugin--summernote" placeholder="{{ __('Isi') }}"></textarea>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">{{ __('Link') }}</label>
		<div class="col-sm-10 parent-group">
			<input type="text" name="link" class="form-control" placeholder="{{ __('Link') }}">
		</div>
	</div>
	<div class="form-group row">
        <label class="col-md-2 col-form-label">{{ __('Status') }}</label>
        <div class="col-md-10 parent-group">
            <select name="status" class="form-control base-plugin--select2-ajax status"
                placeholder="{{ __('Pilih Salah Satu') }}">
                <option value="">{{ __('Pilih Salah Satu') }}</option>
                <option selected value="active">{{ __('Aktif') }}</option>
                <option value="nonactive">{{ __('Nonaktif') }}</option>
            </select>
        </div>
    </div>
	
@endsection

@push('scripts')
<script>
	$('.modal-dialog').removeClass('modal-md').addClass('modal-xl');
</script>
@endpush