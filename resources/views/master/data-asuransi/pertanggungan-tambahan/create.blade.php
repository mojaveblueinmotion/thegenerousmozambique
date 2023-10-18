@extends('layouts.modal')

@section('action', route($routes.'.store'))

@section('modal-body')
	@method('POST')
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Pertanggungan Tambahan') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="text" name="name" class="form-control" placeholder="{{ __('Pertanggungan Tambahan') }}">
		</div>
	</div>
	{{-- <div class="form-group row">
		<label class="col-md-4 col-form-label">{{ __('Rider Yang Di-kalikan') }}</label>
		<div class="col-md-8 parent-group">
			<select name="riders[]" class="form-control base-plugin--select2-ajax"
				data-url="{{ route('ajax.selectRiderKendaraan', [
					'search'=>'all',
				]) }}"
				multiple
				placeholder="{{ __('Pilih Beberapa') }}">
				<option value="">{{ __('Pilih Beberapa') }}</option>
			</select>
		</div>
	</div> --}}
	<div class="form-group row">
		<label class="col-md-4 col-form-label">{{ __('Deskripsi') }}</label>
		<div class="col-md-8 parent-group">
			<textarea name="description" class="form-control" placeholder="{{ __('Deskripsi') }}"></textarea>
		</div>
	</div>
@endsection

@push('scripts')
<script>
	$('.modal-dialog').removeClass('modal-md').addClass('modal-lg');
</script>
@endpush