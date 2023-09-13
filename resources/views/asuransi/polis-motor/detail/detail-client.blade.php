<div class="row">
	
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Nama Client') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="nama" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailClient->nama ?? '' }}" class="form-control" placeholder="{{ __('Nama Client') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('No Telepon') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="number" name="phone" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailClient->phone ?? '' }}" class="form-control" placeholder="{{ __('No Telepon') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Email') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="email" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailClient->email ?? '' }}" class="form-control" placeholder="{{ __('Email') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Warna') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="warna" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailClient->warna ?? '' }}" class="form-control" placeholder="{{ __('Warna') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('No Chasis') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="no_chasis" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailClient->no_chasis ?? '' }}" class="form-control" placeholder="{{ __('No Chasis') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('No Mesin') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="no_mesin" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailClient->no_mesin ?? '' }}" class="form-control" placeholder="{{ __('No Mesin') }}">
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Provinsi') }}</label>
			<div class="col-md-8 parent-group">
				<select name="province_id" class="form-control base-plugin--select2-ajax province_id"
					data-url="{{ route('ajax.selectProvinceForCity', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailClient->province_id))
						<option value="{{ $record->detailClient->province_id }}" selected>{{ $record->detailClient->province->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Kota') }}</label>
			<div class="col-md-8 parent-group">
				<input type="hidden" name="city_id" value="{{ $record->detailClient->city_id ?? '' }}">
				<select name="city_id" class="form-control base-plugin--select2-ajax city_id"
					data-url="{{ route('ajax.cityOptions', ['merk_id' => '']) }}"
					data-url-origin="{{ route('ajax.cityOptions') }}" placeholder="{{ __('Pilih Salah Satu') }}" disabled
					required>
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailClient->city_id))
						<option value="{{ $record->detailClient->city_id }}" selected>{{ $record->detailClient->city->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Kecamatan') }}</label>
			<div class="col-md-8 parent-group">
				<input type="hidden" name="district_id" value="{{ $record->detailClient->district_id ?? '' }}">
				<select name="district_id" class="form-control base-plugin--select2-ajax district_id"
					data-url="{{ route('ajax.districtOptions', ['seri_id' => '']) }}"
					data-url-origin="{{ route('ajax.districtOptions') }}" placeholder="{{ __('Pilih Salah Satu') }}" disabled
					required>
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailClient->district_id))
						<option value="{{ $record->detailClient->district_id }}" selected>{{ $record->detailClient->district->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Kelurahan') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="village" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailClient->village ?? '' }}" class="form-control" placeholder="{{ __('Kelurahan') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Alamat Lengkap') }}</label>
			<div class="col-md-8 parent-group">
				<textarea rows="3" @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif required name="alamat" class="form-control" placeholder="{{ __('Alamat Lengkap') }}">{!! $record->detailClient->alamat ?? '' !!}</textarea>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group row">
			<label class="col-md-2 col-form-label">{{ __('Keterangan') }}</label>
			<div class="col-md-10 parent-group">
				<textarea @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif required name="keterangan" class="base-plugin--summernote" placeholder="{{ __('Keterangan') }}">{!! $record->detailClient->keterangan ?? '' !!}</textarea>
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
		});
</script>
@endpush