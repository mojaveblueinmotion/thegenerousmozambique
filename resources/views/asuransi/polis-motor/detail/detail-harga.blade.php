<div class="row">
	
	<div class="col-md-12">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Harga Asuransi') }}</label>
			<div class="col-sm-8 parent-group ">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->harga_asuransi ?? '' }}" 
						readonly
						class="form-control base-plugin--inputmask_currency harga_asuransi" id="harga_asuransi" name="harga_asuransi"
							placeholder="{{ __('Harga Asuransi') }}">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Harga Rider') }}</label>
			<div class="col-sm-8 parent-group ">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->harga_rider ?? '' }}" 
						readonly
						class="form-control base-plugin--inputmask_currency harga_rider" id="harga_rider" name="harga_rider"
							placeholder="{{ __('Harga Rider') }}">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Biaya Polis') }}</label>
			<div class="col-sm-8 parent-group ">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->biaya_polis ?? '' }}" 
						class="form-control base-plugin--inputmask_currency biaya_polis" id="biaya_polis" name="biaya_polis"
							placeholder="{{ __('Biaya Polis') }}">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Biaya Materai') }}</label>
			<div class="col-sm-8 parent-group ">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->biaya_materai ?? '' }}" 
						class="form-control base-plugin--inputmask_currency biaya_materai" id="biaya_materai" name="biaya_materai"
							placeholder="{{ __('Biaya Materai') }}">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Diskon') }}</label>
			<div class="col-sm-8 parent-group ">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->diskon ?? '' }}" 
						class="form-control base-plugin--inputmask_currency diskon" id="diskon" name="diskon"
							placeholder="{{ __('Diskon') }}">
				</div>
			</div>
		</div>
		<hr>
		<hr>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label"><b>{{ __('Total Harga') }}</b></label>
			<div class="col-sm-8 parent-group ">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->total_harga ?? '' }}" 
						readonly
						class="form-control base-plugin--inputmask_currency total_harga" id="total_harga" name="total_harga"
							placeholder="{{ __('Total Harga') }}">
				</div>
			</div>
		</div>
	</div>
</div>


@push('scripts')
<script>
	$(function () {
		
	});
</script>
@endpush