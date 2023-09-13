<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Perjalanan Dari Provinsi?') }}</label>
			<div class="col-md-8 parent-group">
				<select name="from_province_id" class="form-control base-plugin--select2-ajax from_province_id"
					data-url="{{ route('ajax.selectProvinceForCity', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->from_province_id))
						<option value="{{ $record->from_province_id }}" selected>{{ $record->fromProvince->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Perjalanan Dari Kota?') }}</label>
			<div class="col-md-8 parent-group">
				<input type="hidden" name="from_city_id" value="{{ $record->from_city_id ?? '' }}">
				<select name="from_city_id" class="form-control base-plugin--select2-ajax from_city_id"
					data-url="{{ route('ajax.cityOptions', ['merk_id' => '']) }}"
					data-url-origin="{{ route('ajax.cityOptions') }}" placeholder="{{ __('Pilih Salah Satu') }}" disabled
					required>
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->from_city_id))
						<option value="{{ $record->from_city_id }}" selected>{{ $record->fromCity->name }}</option>
					@endif
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Perjalanan Menuju Provinsi?') }}</label>
			<div class="col-md-8 parent-group">
				<select name="destination_province_id" class="form-control base-plugin--select2-ajax destination_province_id"
					data-url="{{ route('ajax.selectProvinceForCity', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->destination_province_id))
						<option value="{{ $record->destination_province_id }}" selected>{{ $record->fromProvince->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Perjalanan Menuju Kota?') }}</label>
			<div class="col-md-8 parent-group">
				<input type="hidden" name="destination_city_id" value="{{ $record->destination_city_id ?? '' }}">
				<select name="destination_city_id" class="form-control base-plugin--select2-ajax destination_city_id"
					data-url="{{ route('ajax.cityOptions', ['merk_id' => '']) }}"
					data-url-origin="{{ route('ajax.cityOptions') }}" placeholder="{{ __('Pilih Salah Satu') }}" disabled
					required>
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->destination_city_id))
						<option value="{{ $record->destination_city_id }}" selected>{{ $record->fromCity->name }}</option>
					@endif
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Nama Ahli Waris') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="ahli_waris" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->ahli_waris ?? '' }}" class="form-control" placeholder="{{ __('Nama Ahli Waris') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Hubungan Ahli Waris') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="hubungan_ahli_waris" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->hubungan_ahli_waris ?? '' }}" class="form-control" placeholder="{{ __('Nama Ahli Waris') }}">
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('KTP') }}</label>
			<div class="col-sm-8 parent-group">
				<div class="custom-file">
					<input type="hidden" name="ktp[uploaded]" class="uploaded" value="0">
					<input @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif type="file" multiple class="custom-file-input base-form--save-temp-files" data-name="ktp"
						data-container="parent-group" data-max-size="20024" data-max-file="100" accept="*">
					<label class="custom-file-label" for="file">Choose File</label>
				</div>
				<div class="form-text text-muted">*Maksimal 20MB</div>
				@foreach ($record->files($module)->where('flag', 'ktp')->get() as $file)
				<div class="progress-container w-100" data-uid="{{ $file->id }}">
					<div class="alert alert-custom alert-light fade show py-2 px-4 mb-0 mt-2 success-uploaded" role="alert">
						<div class="alert-icon">
							<i class="{{ $file->file_icon }}"></i>
						</div>
						<div class="alert-text text-left">
							<input type="hidden" name="ktp[files_ids][]" value="{{ $file->id }}">
							<div>Uploaded File:</div>
							<a href="{{ $file->file_url }}" target="_blank" class="text-primary">
								{{ $file->file_name }}
							</a>
						</div>
						<div class="alert-close">
							<button type="button" class="close base-form--remove-temp-files" data-toggle="tooltip"
								data-original-title="Remove">
								<span aria-hidden="true">
									<i class="ki ki-close"></i>
								</span>
							</button>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group row">
			<label class="col-md-2 col-form-label">{{ __('Catatan') }}</label>
			<div class="col-md-10 parent-group">
				<textarea @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif required name="catatan" class="base-plugin--summernote" placeholder="{{ __('catatan') }}">{!! $record->catatan ?? '' !!}</textarea>
			</div>
		</div>
	</div>
</div>

@push('scripts')
<script>
	$(function () {
			$('.content-page').on('change', 'select.from_province_id', function (e) {
				var me = $(this);
				if (me.val()) {
					var objectId = $('select.from_city_id');
					var urlOrigin = objectId.data('url-origin');
					var urlParam = $.param({province_id: me.val()});
					objectId.data('url', decodeURIComponent(decodeURIComponent(urlOrigin+'?'+urlParam)));
					objectId.val(null).prop('disabled', false);
				}
				BasePlugin.initSelect2();
			});

			$('.content-page').on('change', 'select.destination_province_id', function (e) {
				var me = $(this);
				if (me.val()) {
					var objectId = $('select.destination_city_id');
					var urlOrigin = objectId.data('url-origin');
					var urlParam = $.param({province_id: me.val()});
					objectId.data('url', decodeURIComponent(decodeURIComponent(urlOrigin+'?'+urlParam)));
					objectId.val(null).prop('disabled', false);
				}
				BasePlugin.initSelect2();
			});
			
		});
</script>
@endpush