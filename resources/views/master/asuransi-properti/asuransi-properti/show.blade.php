@extends('layouts.modal')

@section('modal-body')
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Perusahaan') }}</label>
	<div class="col-sm-8 parent-group">
		<select disabled name="perusahaan_asuransi_id" class="form-control base-plugin--select2-ajax branch_id"
			data-url="{{ route('ajax.selectPerusahaanAsuransi', 'all') }}"
			data-placeholder="{{ __('Pilih Salah Satu') }}">
			@if (!empty($record->perusahaan_asuransi_id))
				<option value="{{ $record->perusahaan_asuransi_id }}" selected>{{ $record->perusahaanAsuransi->name }}</option>
			@endif
		</select>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Nama Asuransi') }}</label>
	<div class="col-sm-8 parent-group">
		<input disabled type="text" value="{{ $record->name }}" name="name" class="form-control" placeholder="{{ __('Nama Asuransi') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label">{{ __('Pembayaran') }}</label>
	<div class="col-md-8 parent-group">
		<div class="input-group">
			<div class="parent-group input-group-prepend"><span
				class="input-group-text font-weight-bolder">Rp.</span>
			</div>
				<input disabled value="{{ $record->pembayaran_persentasi }}" class="form-control base-plugin--inputmask_currency pembayaran_persentasi" id="pembayaran_persentasi" name="pembayaran_persentasi"
					placeholder="{{ __('Pembayaran') }}">
		</div>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Interval Pembayaran') }}</label>
	<div class="col-sm-8 parent-group">
		<select disabled name="interval_pembayaran_id" class="form-control base-plugin--select2-ajax branch_id"
			data-url="{{ route('ajax.selectIntervalPembayaran', 'all') }}"
			data-placeholder="{{ __('Pilih Salah Satu') }}">
			@if (!empty($record->interval_pembayaran_id))
				<option value="{{ $record->interval_pembayaran_id }}" selected>{{ $record->intervalPembayaran->name }}</option>
			@endif
		</select>
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label">{{ __('Fitur') }}</label>
	<div class="col-md-8 parent-group">
		<select disabled name="to[]" class="form-control base-plugin--select2-ajax"
			data-url="{{ route('ajax.selectFiturAsuransi', [
				'search'=>'all',
			]) }}"
			multiple
			placeholder="{{ __('Pilih Beberapa') }}">
			<option value="">{{ __('Pilih Beberapa') }}</option>
			@if (!empty($record->fiturs))
			@foreach ($record->fiturs as $value)
				<option value="{{ $record->interval_pembayaran_id }}" selected>{{ $record->intervalPembayaran->name }}</option>
			@endforeach
			@endif
		</select>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Call Center') }}</label>
	<div class="col-sm-8 parent-group">
		<input disabled value="{{ $record->call_center }}" type="text" name="call_center" class="form-control" placeholder="{{ __('Call Center') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Bank') }}</label>
	<div class="col-sm-8 parent-group">
		<input disabled type="text" value="{{ $record->bank }}" name="bank" class="form-control" placeholder="{{ __('Bank') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('No Rekening') }}</label>
	<div class="col-sm-8 parent-group">
		<input disabled type="text" value="{{ $record->no_rekening }}" name="no_rekening" class="form-control" placeholder="{{ __('No Rekening') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-2 col-form-label">{{ __('Deskripsi') }}</label>
	<div class="col-md-10 parent-group">
		<textarea name="description" class="base-plugin--summernote" placeholder="{{ __('Deskripsi') }}" disabled>{{ $record->description }}</textarea>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-2 col-form-label">{{ __('Cara Klaim') }}</label>
	<div class="col-md-10 parent-group">
		<textarea name="description_claim" class="base-plugin--summernote" placeholder="{{ __('Cara Klaim') }}" disabled>{{ $record->description_claim }}</textarea>
	</div>
</div>
@endsection

@section('modal-footer')
@endsection
