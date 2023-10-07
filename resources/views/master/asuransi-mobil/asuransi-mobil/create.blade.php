@extends('layouts.modal')

@section('action', route($routes.'.store'))

@section('modal-body')
	@method('POST')
	<div class="row">
		<div class="col-md-6">
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Perusahaan') }}</label>
				<div class="col-sm-8 parent-group">
					<select name="perusahaan_asuransi_id" class="form-control base-plugin--select2-ajax branch_id"
						data-url="{{ route('ajax.selectPerusahaanAsuransi', 'all') }}"
						data-placeholder="{{ __('Pilih Salah Satu') }}">
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Kategori Asuransi') }}</label>
				<div class="col-sm-8 parent-group">
					<select name="kategori_asuransi_id" class="form-control base-plugin--select2-ajax branch_id"
						data-url="{{ route('ajax.selectKategoriAsuransi', 'all') }}"
						data-placeholder="{{ __('Pilih Salah Satu') }}">
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Nama Asuransi') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="text" name="name" class="form-control" placeholder="{{ __('Nama Asuransi') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Bank') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="text" name="bank" class="form-control" placeholder="{{ __('Bank') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('No Rekening') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="text" name="no_rekening" class="form-control" placeholder="{{ __('No Rekening') }}">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Interval Pembayaran') }}</label>
				<div class="col-sm-8 parent-group">
					<select name="interval_pembayaran_id" class="form-control base-plugin--select2-ajax branch_id"
						data-url="{{ route('ajax.selectIntervalPembayaran', 'all') }}"
						data-placeholder="{{ __('Pilih Salah Satu') }}">
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-4 col-form-label">{{ __('Fitur') }}</label>
				<div class="col-md-8 parent-group">
					<select name="to[]" class="form-control base-plugin--select2-ajax"
						data-url="{{ route('ajax.selectFiturAsuransi', [
							'search'=>'all',
						]) }}"
						multiple
						placeholder="{{ __('Pilih Beberapa') }}">
						<option value="">{{ __('Pilih Beberapa') }}</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Call Center') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="text" name="call_center" class="form-control" placeholder="{{ __('Call Center') }}">
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 1 Batas Atas') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" name="wilayah_satu_batas_atas" class="form-control" placeholder="{{ __('Wilayah 1 Batas Atas') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 2 Batas Atas') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" name="wilayah_dua_batas_atas" class="form-control" placeholder="{{ __('Wilayah 2 Batas Atas') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 3 Batas Atas') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" name="wilayah_tiga_batas_atas" class="form-control" placeholder="{{ __('Wilayah 3 Batas Atas') }}">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 1 Batas Bawah') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" name="wilayah_satu_batas_bawah" class="form-control" placeholder="{{ __('Wilayah 1 Batas Bawah') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 2 Batas Bawah') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" name="wilayah_dua_batas_bawah" class="form-control" placeholder="{{ __('Wilayah 1 Batas Bawah') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 3 Batas Bawah') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" name="wilayah_tiga_batas_bawah" class="form-control" placeholder="{{ __('Wilayah 3 Batas Bawah') }}">
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
<script>
	$('.modal-dialog').removeClass('modal-md').addClass('modal-xl');
</script>
@endpush