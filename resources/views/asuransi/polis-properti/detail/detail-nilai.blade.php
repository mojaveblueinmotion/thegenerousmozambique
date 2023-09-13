<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Nilai Bangunan') }}</label>
			<div class="col-md-8 parent-group">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->detailNilai->nilai_bangunan ?? '' }}" 
						@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
						class="form-control base-plugin--inputmask_currency nilai_bangunan" id="nilai_bangunan" name="nilai_bangunan"
							placeholder="{{ __('Nilai Bangunan') }}">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Nilai Isi') }}</label>
			<div class="col-md-8 parent-group">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->detailNilai->nilai_isi ?? '' }}" 
						@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
						class="form-control base-plugin--inputmask_currency nilai_isi" id="nilai_isi" name="nilai_isi"
							placeholder="{{ __('Nilai Isi') }}">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Nilai Mesin') }}</label>
			<div class="col-md-8 parent-group">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->detailNilai->nilai_mesin ?? '' }}" 
						@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
						class="form-control base-plugin--inputmask_currency nilai_mesin" id="nilai_mesin" name="nilai_mesin"
							placeholder="{{ __('Nilai Mesin') }}">
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Nilai Stok') }}</label>
			<div class="col-md-8 parent-group">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->detailNilai->nilai_stok ?? '' }}" 
						@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
						class="form-control base-plugin--inputmask_currency nilai_stok" id="nilai_stok" name="nilai_stok"
							placeholder="{{ __('Nilai Stok') }}">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Nilai Pertanggungan') }}</label>
			<div class="col-md-8 parent-group">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->detailNilai->nilai_pertanggungan ?? '' }}" 
						@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
						class="form-control base-plugin--inputmask_currency nilai_pertanggungan" id="nilai_pertanggungan" name="nilai_pertanggungan"
							placeholder="{{ __('Nilai Pertanggungan') }}">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Tanggal Pemakaian') }}</label>
			<div class="col-md-8 parent-group">
				<div class="row no-gutters input-group">
					<div class="col-md-6 parent-group" >
						<input type="text" name="tanggal_awal"
							@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
							class="form-control base-plugin--datepicker date_start rounded-right-0"
							@if(!empty($record->detailNilai->tanggal_awal))
							value="{{ $record->detailNilai->tanggal_awal->format('d/m/Y') }}"
							@endif
							placeholder="{{ __('Awal') }}"
							data-orientation="top">
					</div>
					<div class="col-md-6 parent-group" >
						<input type="hidden" name="tanggal_akhir"
						@if(!empty($record->detailNilai->tanggal_akhir))
							value="{{ $record->detailNilai->tanggal_akhir->format('d/m/Y') }}"
						@endif>
						<input type="text" name="tanggal_akhir"
							@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
							class="form-control base-plugin--datepicker date_end rounded-left-0"
							@if(!empty($record->detailNilai->tanggal_akhir))
							value="{{ $record->detailNilai->tanggal_akhir->format('d/m/Y') }}"
							@endif
							placeholder="{{ __('Akhir') }}"
							data-orientation="top" disabled>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@push('scripts')
<script>
	$(function () {
			$('.content-page').on('changeDate', 'input.date_start', function (value) {
				var me = $(this);
				if (me.val()) {
					var startDate = new Date(value.date.valueOf());
					var date_end = me.closest('.input-group').find('input.date_end');
					date_end.prop('disabled', false)
							.val(me.val())
							.datepicker('setStartDate', startDate)
							.focus();
				}
			});
		});
</script>
@endpush