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
	<label class="col-sm-4 col-form-label">{{ __('Kategori Asuransi') }}</label>
	<div class="col-sm-8 parent-group">
		<select disabled name="kategori_asuransi_id" class="form-control base-plugin--select2-ajax branch_id"
			data-url="{{ route('ajax.selectKategoriAsuransi', 'all') }}"
			data-placeholder="{{ __('Pilih Salah Satu') }}">
			@if (!empty($record->kategori_asuransi_id))
				<option value="{{ $record->kategori_asuransi_id }}" selected>{{ $record->kategoriAsuransi->name }}</option>
			@endif
		</select>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Nama Asuransi') }}</label>
	<div class="col-sm-8 parent-group">
		<input type="text" value="{{ $record->name }}" disabled name="name" class="form-control" placeholder="{{ __('Nama Asuransi') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Wilayah 1 Batas Atas') }}</label>
	<div class="col-sm-8 parent-group">
		<input type="number" value="{{ $record->wilayah_satu_batas_atas }}" disabled name="wilayah_satu_batas_atas" class="form-control" placeholder="{{ __('Wilayah 1 Batas Atas') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Wilayah 1 Batas Bawah') }}</label>
	<div class="col-sm-8 parent-group">
		<input type="number" value="{{ $record->wilayah_satu_batas_bawah }}" disabled name="wilayah_satu_batas_bawah" class="form-control" placeholder="{{ __('Wilayah 1 Batas Bawah') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Wilayah 2 Batas Atas') }}</label>
	<div class="col-sm-8 parent-group">
		<input type="number" value="{{ $record->wilayah_dua_batas_atas }}" disabled name="wilayah_dua_batas_atas" class="form-control" placeholder="{{ __('Wilayah 2 Batas Atas') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Wilayah 2 Batas Bawah') }}</label>
	<div class="col-sm-8 parent-group">
		<input type="number" value="{{ $record->wilayah_dua_batas_bawah }}" disabled name="wilayah_dua_batas_bawah" class="form-control" placeholder="{{ __('Wilayah 1 Batas Bawah') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Wilayah 3 Batas Atas') }}</label>
	<div class="col-sm-8 parent-group">
		<input type="number" value="{{ $record->wilayah_tiga_batas_atas }}" disabled name="wilayah_tiga_batas_atas" class="form-control" placeholder="{{ __('Wilayah 3 Batas Atas') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Wilayah 3 Batas Bawah') }}</label>
	<div class="col-sm-8 parent-group">
		<input type="number" value="{{ $record->wilayah_tiga_batas_bawah }}" disabled name="wilayah_tiga_batas_bawah" class="form-control" placeholder="{{ __('Wilayah 3 Batas Bawah') }}">
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
		<input value="{{ $record->call_center }}" type="text" disabled name="call_center" class="form-control" placeholder="{{ __('Call Center') }}">
	</div>
</div>
@endsection

@section('modal-footer')
@endsection
