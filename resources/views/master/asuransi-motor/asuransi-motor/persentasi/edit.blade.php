@extends('layouts.modal')

@section('action', route($routes.'.persentasiUpdate', $persentasi->id))

@section('modal-body')
	@method('PATCH')
	<div class="form-group row">
		<label class="col-sm-3 col-form-label">{{ __('Kategori') }}</label>
		<div class="col-sm-9 parent-group">
			<input type="text" name="kategori" value="{{ $persentasi->kategori }}" class="form-control" placeholder="{{ __('Kategori') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-3 col-form-label">{{ __('Uang Pertanggungan (Rp.)') }}</label>
		<div class="col-md-9 parent-group">
			<div class="input-group">
				<div class="parent-group input-group-prepend"><span
					class="input-group-text font-weight-bolder">Rp.</span>
				</div>
					<input
					class="form-control base-plugin--inputmask_currency uang_pertanggungan_bawah" id="uang_pertanggungan_bawah" name="uang_pertanggungan_bawah" value="{{ $persentasi->uang_pertanggungan_bawah }}"
						placeholder="{{ __('Uang Pertanggungan ') }}">
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-3 col-form-label">{{ __('Sampai Dengan (Rp.) (Rp.)') }}</label>
		<div class="col-md-9 parent-group">
			<div class="input-group">
				<div class="parent-group input-group-prepend"><span
					class="input-group-text font-weight-bolder">Rp.</span>
				</div>
					<input
					class="form-control base-plugin--inputmask_currency uang_pertanggungan_atas" id="uang_pertanggungan_atas" name="uang_pertanggungan_atas" value="{{ $persentasi->uang_pertanggungan_atas }}"
						placeholder="{{ __('Sampai Dengan (Rp.) ') }}">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group row">
				<label class="col-sm-6 col-form-label">{{ __('Wilayah 1 Batas Bawah') }}</label>
				<div class="col-sm-6 parent-group">
					<input type="number" value="{{ $persentasi->wilayah_satu_bawah }}" name="wilayah_satu_bawah" class="form-control" placeholder="{{ __('Wilayah 1 Batas Bawah') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-6 col-form-label">{{ __('Wilayah 2 Batas Bawah') }}</label>
				<div class="col-sm-6 parent-group">
					<input type="number" value="{{ $persentasi->wilayah_dua_bawah }}" name="wilayah_dua_bawah" class="form-control" placeholder="{{ __('Wilayah 1 Batas Bawah') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-6 col-form-label">{{ __('Wilayah 3 Batas Bawah') }}</label>
				<div class="col-sm-6 parent-group">
					<input type="number" value="{{ $persentasi->wilayah_tiga_bawah }}" name="wilayah_tiga_bawah" class="form-control" placeholder="{{ __('Wilayah 3 Batas Bawah') }}">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group row">
				<label class="col-sm-6 col-form-label">{{ __('Wilayah 1 Batas Atas') }}</label>
				<div class="col-sm-6 parent-group">
					<input type="number" value="{{ $persentasi->wilayah_satu_atas }}" name="wilayah_satu_atas" class="form-control" placeholder="{{ __('Wilayah 1 Batas Atas') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-6 col-form-label">{{ __('Wilayah 2 Batas Atas') }}</label>
				<div class="col-sm-6 parent-group">
					<input type="number" value="{{ $persentasi->wilayah_dua_atas }}" name="wilayah_dua_atas" class="form-control" placeholder="{{ __('Wilayah 2 Batas Atas') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-6 col-form-label">{{ __('Wilayah 3 Batas Atas') }}</label>
				<div class="col-sm-6 parent-group">
					<input type="number" value="{{ $persentasi->wilayah_tiga_atas }}" name="wilayah_tiga_atas" class="form-control" placeholder="{{ __('Wilayah 3 Batas Atas') }}">
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