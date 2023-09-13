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
					@if (!empty($record->detailCek->province_id))
						<option value="{{ $record->detailCek->province_id }}" selected>{{ $record->detailCek->province->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Kota') }}</label>
			<div class="col-md-8 parent-group">
				<input type="hidden" name="city_id" value="{{ $record->detailCek->city_id ?? '' }}">
				<select name="city_id" class="form-control base-plugin--select2-ajax city_id"
					data-url="{{ route('ajax.cityOptions', ['merk_id' => '']) }}"
					data-url-origin="{{ route('ajax.cityOptions') }}" placeholder="{{ __('Pilih Salah Satu') }}" disabled
					required>
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->city_id))
						<option value="{{ $record->detailCek->city_id }}" selected>{{ $record->detailCek->city->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Kecamatan') }}</label>
			<div class="col-md-8 parent-group">
				<input type="hidden" name="district_id" value="{{ $record->detailCek->district_id ?? '' }}">
				<select name="district_id" class="form-control base-plugin--select2-ajax district_id"
					data-url="{{ route('ajax.districtOptions', ['seri_id' => '']) }}"
					data-url-origin="{{ route('ajax.districtOptions') }}" placeholder="{{ __('Pilih Salah Satu') }}" disabled
					required>
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->district_id))
						<option value="{{ $record->detailCek->district_id }}" selected>{{ $record->detailCek->district->name }}</option>
					@endif
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Kelurahan') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="village" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailCek->village ?? '' }}" class="form-control" placeholder="{{ __('Kelurahan') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Alamat Lengkap') }}</label>
			<div class="col-md-8 parent-group">
				<textarea rows="3" @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif required name="alamat" class="form-control" placeholder="{{ __('Alamat Lengkap') }}">{!! $record->detailCek->alamat ?? '' !!}</textarea>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Okupasi') }}</label>
			<div class="col-md-8 parent-group">
				<select name="okupasi_id" class="form-control base-plugin--select2-ajax okupasi_id"
					data-url="{{ route('ajax.selectOkupasi', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->okupasi_id))
						<option value="{{ $record->detailCek->okupasi_id }}" selected>{{ $record->detailCek->okupasi->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Ada Berapa Lantai di Bangunan Tersebut?') }}</label>
			<div class="col-md-8 parent-group">
				<select name="status_lantai" class="form-control base-plugin--select2-ajax status_lantai"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					<option value="1" @if(!empty($record->detailCek->status_lantai) && $record->detailCek->status_lantai == 1) selected @endif>1 - 9 Lantai</option>
					<option value="2" @if(!empty($record->detailCek->status_lantai) && $record->detailCek->status_lantai == 2) selected @endif>Lebih Dari 9 Lantai</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Bangunan Terbuat Dari Beton, Baja/Besi (Kelas 1)?') }}</label>
			<div class="col-md-8 parent-group">
				<select name="status_bangunan" class="form-control base-plugin--select2-ajax status_bangunan"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					<option value="1" @if(!empty($record->detailCek->status_bangunan) && $record->detailCek->status_bangunan == 1) selected @endif>Ya</option>
					<option value="2" @if(!empty($record->detailCek->status_bangunan) && $record->detailCek->status_bangunan == 2) selected @endif>Tidak</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Pernah Terjadi Banjir 6 Tahun Terakhir?') }}</label>
			<div class="col-md-8 parent-group">
				<select name="status_banjir" class="form-control base-plugin--select2-ajax status_banjir"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					<option value="1" @if(!empty($record->detailCek->status_banjir) && $record->detailCek->status_banjir == 1) selected @endif>Ya</option>
					<option value="2" @if(!empty($record->detailCek->status_banjir) && $record->detailCek->status_banjir == 2) selected @endif>Tidak</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Pernah Melakukan Klaim 5 Tahun Terakhir?') }}</label>
			<div class="col-md-8 parent-group">
				<select name="status_klaim" class="form-control base-plugin--select2-ajax status_klaim"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					<option value="1" @if(!empty($record->detailCek->status_klaim) && $record->detailCek->status_klaim == 1) selected @endif>Ya</option>
					<option value="2" @if(!empty($record->detailCek->status_klaim) && $record->detailCek->status_klaim == 2) selected @endif>Tidak</option>
				</select>
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