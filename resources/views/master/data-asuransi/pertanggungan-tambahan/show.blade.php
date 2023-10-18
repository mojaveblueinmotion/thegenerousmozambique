@extends('layouts.modal')

@section('modal-body')
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Pertanggungan Tambahan') }}</label>
		<div class="col-sm-8 parent-group">
			<input disabled type="text" value="{{ $record->name }}" name="name" class="form-control" placeholder="{{ __('Pertanggungan Tambahan') }}">
		</div>
	</div>
	{{-- <div class="form-group row">
		<label class="col-md-4 col-form-label">{{ __('Rider Yang Di-kalikan') }}</label>
		<div class="col-md-8 parent-group">
			<select disabled name="riders[]" class="form-control base-plugin--select2-ajax"
				data-url="{{ route('ajax.selectRiderKendaraan', [
					'search'=>'all',
				]) }}"
				multiple
				placeholder="{{ __('Pilih Beberapa') }}">
				<option value="">{{ __('Pilih Beberapa') }}</option>
				@foreach ($record->riders as $val)
					<option value="{{ $val->id }}" selected>{{ $val->name }}</option>
				@endforeach
			</select>
		</div>
	</div> --}}
	<div class="form-group row">
		<label class="col-md-4 col-form-label">{{ __('Deskripsi') }}</label>
		<div class="col-md-8 parent-group">
			<textarea disabled name="description" class="form-control" placeholder="{{ __('Deskripsi') }}">{{ $record->description }}</textarea>
		</div>
	</div>
@endsection

@section('modal-footer')
@endsection


@push('scripts')
<script>
	$('.modal-dialog').removeClass('modal-md').addClass('modal-lg');
</script>
@endpush