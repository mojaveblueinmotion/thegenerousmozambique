<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Provinsi') }}</label>
			<div class="col-md-8 parent-group">
				<select name="province_id" class="form-control base-plugin--select2-ajax province_id"
					data-url="{{ route('ajax.selectProvinceForCity', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->province_id))
						<option value="{{ $record->province_id }}" selected>{{ $record->province->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Kota') }}</label>
			<div class="col-md-8 parent-group">
				<input type="hidden" name="city_id" value="{{ $record->city_id ?? '' }}">
				<select name="city_id" class="form-control base-plugin--select2-ajax city_id"
					data-url="{{ route('ajax.cityOptions', ['merk_id' => '']) }}"
					data-url-origin="{{ route('ajax.cityOptions') }}" placeholder="{{ __('Pilih Salah Satu') }}" disabled
					required>
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->city_id))
						<option value="{{ $record->city_id }}" selected>{{ $record->city->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Kecamatan') }}</label>
			<div class="col-md-8 parent-group">
				<input type="hidden" name="district_id" value="{{ $record->district_id ?? '' }}">
				<select name="district_id" class="form-control base-plugin--select2-ajax district_id"
					data-url="{{ route('ajax.districtOptions', ['seri_id' => '']) }}"
					data-url-origin="{{ route('ajax.districtOptions') }}" placeholder="{{ __('Pilih Salah Satu') }}" disabled
					required>
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->district_id))
						<option value="{{ $record->district_id }}" selected>{{ $record->district->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Kelurahan') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="village" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->village ?? '' }}" class="form-control" placeholder="{{ __('Kelurahan') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Alamat Lengkap') }}</label>
			<div class="col-md-8 parent-group">
				<textarea rows="3" @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif required name="alamat" class="form-control" placeholder="{{ __('Alamat Lengkap') }}">{!! $record->alamat ?? '' !!}</textarea>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Tanggal Lahir') }}</label>
			<div class="col-md-8 parent-group">
				<input type="text" name="tanggal_lahir"
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				class="form-control base-plugin--datepicker tanggal_lahir"
				@if(!empty($record->tanggal_lahir))
				value="{{ $record->tanggal_lahir->format('d/m/Y') }}"
				@endif
				data-options='@json([
					"startDate" => "",
					"endDate"=> now()->format('d/m/Y')
				])'
				placeholder="{{ __('Tanggal Lahir') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Tanggal Asuransi') }}</label>
			<div class="col-md-8 parent-group">
				<div class="row no-gutters input-group">
					<div class="col-md-6 parent-group" >
						<input type="text" name="tanggal_awal"
							@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
							class="form-control base-plugin--datepicker date_start rounded-right-0"
							@if(!empty($record->tanggal_awal))
							value="{{ $record->tanggal_awal->format('d/m/Y') }}"
							@endif
							placeholder="{{ __('Awal') }}"
							data-orientation="top">
					</div>
					<div class="col-md-6 parent-group" >
						<input type="hidden" name="tanggal_akhir"
						@if(!empty($record->tanggal_akhir))
							value="{{ $record->tanggal_akhir->format('d/m/Y') }}"
						@endif>
						<input type="text" name="tanggal_akhir"
							@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
							class="form-control base-plugin--datepicker date_end rounded-left-0"
							@if(!empty($record->tanggal_akhir))
							value="{{ $record->tanggal_akhir->format('d/m/Y') }}"
							@endif
							placeholder="{{ __('Akhir') }}"
							data-orientation="top" disabled>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('NIK') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="nik" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->nik ?? '' }}" class="form-control" placeholder="{{ __('NIK') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Pekerjaan') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="pekerjaan" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->pekerjaan ?? '' }}" class="form-control" placeholder="{{ __('Pekerjaan') }}">
			</div>
		</div>
	</div>
</div>

@push('scripts')
<script>
	$(function () {
			$('.content-page').on('change', 'select.province_id', function (e) {
				var me = $(this);
				if (me.val()) {
					var objectId = $('select.city_id');
					var urlOrigin = objectId.data('url-origin');
					var urlParam = $.param({province_id: me.val()});
					objectId.data('url', decodeURIComponent(decodeURIComponent(urlOrigin+'?'+urlParam)));
					objectId.val(null).prop('disabled', false);
				}
				BasePlugin.initSelect2();
			});
			
			$('.content-page').on('change', 'select.city_id', function (e) {
				var me = $(this);
				if (me.val()) {
					var objectId = $('select.district_id');
					var urlOrigin = objectId.data('url-origin');
					var urlParam = $.param({city_id: me.val()});
					objectId.data('url', decodeURIComponent(decodeURIComponent(urlOrigin+'?'+urlParam)));
					objectId.val(null).prop('disabled', false);
				}
				BasePlugin.initSelect2();
			});
			
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