<div class="row">
	<div class="col-md-12">
		<div class="form-group row">
			<label class="col-md-2 col-form-label">{{ __('Rincian Modifikasi') }}</label>
			<div class="col-md-10 parent-group">
				<textarea @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif required name="rincian_modifikasi" class="base-plugin--summernote" placeholder="{{ __('Rincian Modifikasi') }}">{!! $record->detailNilai->rincian_modifikasi ?? '' !!}</textarea>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label">{{ __('Rincian Pemakaian') }}</label>
			<div class="col-md-10 parent-group">
				<textarea @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif required name="pemakaian" class="base-plugin--summernote" placeholder="{{ __('Rincian Pemakaian') }}">{!! $record->detailNilai->pemakaian ?? '' !!}</textarea>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Nilai Modifikasi') }}</label>
			<div class="col-md-8 parent-group">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->detailNilai->nilai_modifikasi ?? '' }}" 
						@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
						class="form-control base-plugin--inputmask_currency nilai_modifikasi" id="nilai_modifikasi" name="nilai_modifikasi"
							placeholder="{{ __('Nilai Modifikasi') }}">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Tipe') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="tipe" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailNilai->tipe ?? '' }}" class="form-control" placeholder="{{ __('Tipe') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Nilai Mobil') }}</label>
			<div class="col-md-8 parent-group">
				<div class="input-group">
					<div class="parent-group input-group-prepend"><span
						class="input-group-text font-weight-bolder">Rp.</span>
					</div>
						<input value="{{ $record->detailNilai->nilai_mobil ?? '' }}" 
						@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
						class="form-control base-plugin--inputmask_currency nilai_mobil" id="nilai_mobil" name="nilai_mobil"
							placeholder="{{ __('Nilai Mobil') }}">
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
	</div>
	<div class="col-md-6">
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
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('No Plat') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="no_plat" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailNilai->no_plat ?? '' }}" class="form-control" placeholder="{{ __('No Plat') }}">
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