<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Merk Motor') }}</label>
			<div class="col-md-8 parent-group">
				<input type="hidden" name="merk_id" value="{{ $record->detailCek->merk_id ?? '' }}">
				<select name="merk_id" class="form-control base-plugin--select2-ajax merk_id"
					data-url="{{ route('ajax.selectMerkMotor', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->merk_id))
						<option value="{{ $record->detailCek->merk_id }}" selected>{{ $record->detailCek->merk->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Seri Motor') }}</label>
			<div class="col-md-8 parent-group">
				<input type="hidden" name="seri_id" value="{{ $record->detailCek->seri_id ?? '' }}">
				<select name="seri_id" class="form-control base-plugin--select2-ajax seri_id"
					data-url="{{ route('ajax.seriMotorOptions', ['merk_id' => '']) }}"
					data-url-origin="{{ route('ajax.seriMotorOptions') }}" placeholder="{{ __('Pilih Salah Satu') }}" disabled
					required>
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->seri_id))
						<option value="{{ $record->detailCek->seri_id }}" selected>{{ $record->detailCek->seri->code }} ({{ $record->detailCek->seri->model }})</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Tahun Motor') }}</label>
			<div class="col-md-8 parent-group">
				<input type="hidden" name="tahun_id" value="{{ $record->detailCek->tahun_id ?? '' }}">
				<select name="tahun_id" class="form-control base-plugin--select2-ajax tahun_id"
					data-url="{{ route('ajax.tahunMotorOptions', ['seri_id' => '']) }}"
					id="tahun_motor"
					data-url-origin="{{ route('ajax.tahunMotorOptions') }}" placeholder="{{ __('Pilih Salah Satu') }}" disabled
					required>
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->tahun_id))
						<option value="{{ $record->detailCek->tahun_id }}" selected>{{ $record->detailCek->tahun->tahun }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Tipe Motor') }}</label>
			<div class="col-md-8 parent-group">
				<select name="tipe_id" class="form-control base-plugin--select2-ajax tipe_id"
					data-url="{{ route('ajax.selectTipeMotor', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->tipe_id))
						<option value="{{ $record->detailCek->tipe_id }}" selected>{{ $record->detailCek->tipemotor->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Tipe Kendaraan') }}</label>
			<div class="col-md-8 parent-group">
				<select name="tipe_kendaraan_id" class="form-control base-plugin--select2-ajax tipe_kendaraan_id"
					data-url="{{ route('ajax.selectTipeKendaraan', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->tipe_kendaraan_id))
						<option value="{{ $record->detailCek->tipe_kendaraan_id }}" selected>{{ $record->detailCek->tipeKendaraan->type }}</option>
					@endif
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Kode Plat') }}</label>
			<div class="col-md-8 parent-group">
				<select name="kode_plat_id" class="form-control base-plugin--select2-ajax kode_plat_id"
					data-url="{{ route('ajax.selectKodePlat', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->kode_plat_id))
						<option value="{{ $record->detailCek->kode_plat_id }}" selected>{{ $record->detailCek->kodePlat->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Plat Nomor') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="kode_plat" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailCek->kode_plat ?? '' }}" class="form-control" placeholder="{{ __('Plat Nomor') }}">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Tipe Pemakaian') }}</label>
			<div class="col-md-8 parent-group">
				<select name="tipe_pemakaian_id" class="form-control base-plugin--select2-ajax tipe_pemakaian_id"
					data-url="{{ route('ajax.selectTipePemakaian', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->tipe_pemakaian_id))
						<option value="{{ $record->detailCek->tipe_pemakaian_id }}" selected>{{ $record->detailCek->tipePemakaian->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Luas Pertanggungan') }}</label>
			<div class="col-md-8 parent-group">
				<select name="luas_pertanggungan_id" class="form-control base-plugin--select2-ajax luas_pertanggungan_id"
					data-url="{{ route('ajax.selectLuasPertanggungan', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->luas_pertanggungan_id))
						<option value="{{ $record->detailCek->luas_pertanggungan_id }}" selected>{{ $record->detailCek->luasPertanggungan->name }}</option>
					@endif
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-4 col-form-label">{{ __('Kondisi Kendaraan') }}</label>
			<div class="col-md-8 parent-group">
				<select name="kondisi_kendaraan_id" class="form-control base-plugin--select2-ajax kondisi_kendaraan_id"
					data-url="{{ route('ajax.selectKondisiKendaraan', ['search' => 'all']) }}"
					@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif	
					placeholder="{{ __('Pilih Salah Satu') }}">
					<option value="">{{ __('Pilih Salah Satu') }}</option>
					@if (!empty($record->detailCek->kondisi_kendaraan_id))
						<option value="{{ $record->detailCek->kondisi_kendaraan_id }}" selected>{{ $record->detailCek->kondisiKendaraan->name }}</option>
					@endif
				</select>
			</div>
		</div>
	</div>
</div>

@push('scripts')
<script>
	$(function () {
			$('.content-page').on('change', 'select.merk_id', function (e) {
				var me = $(this);
				if (me.val()) {
					var objectId = $('select.seri_id');
					var urlOrigin = objectId.data('url-origin');
					var urlParam = $.param({merk_id: me.val()});
					objectId.data('url', decodeURIComponent(decodeURIComponent(urlOrigin+'?'+urlParam)));
					objectId.val(null).prop('disabled', false);
				}
				BasePlugin.initSelect2();
			});
			
			$('.content-page').on('change', 'select.seri_id', function (e) {
				var me = $(this);
				if (me.val()) {
					var objectId = $('select.tahun_id');
					var urlOrigin = objectId.data('url-origin');
					var urlParam = $.param({seri_id: me.val()});
					objectId.data('url', decodeURIComponent(decodeURIComponent(urlOrigin+'?'+urlParam)));
					objectId.val(null).prop('disabled', false);
				}
				BasePlugin.initSelect2();
			});
		});
</script>
@endpush