@extends('layouts.modal')

@section('action', route($routes.'.riderStore', $record->id))

@section('modal-body')
	@method('POST')
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Rider Asuransi') }}</label>
		<div class="col-sm-8 parent-group">
			<select name="rider_kendaraan_id" class="form-control base-plugin--select2-ajax rider_kendaraan_id"
				data-url="{{ route('ajax.selectRiderKendaraan', 'all') }}"
				data-placeholder="{{ __('Pilih Salah Satu') }}">
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Persentasi') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="number" name="pembayaran_persentasi" class="form-control" placeholder="{{ __('Persentasi') }}">
		</div>
	</div>
@endsection
