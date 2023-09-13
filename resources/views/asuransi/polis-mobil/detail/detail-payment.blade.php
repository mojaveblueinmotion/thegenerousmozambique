<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Bank') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="bank" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailPayment->bank ?? '' }}" class="form-control" placeholder="{{ __('Bank') }}">
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('No Rekening') }}</label>
			<div class="col-sm-8 parent-group ">
				<input type="text" name="no_rekening" 
				@if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif
				value="{{ $record->detailPayment->no_rekening ?? '' }}" class="form-control" placeholder="{{ __('No Rekening') }}">
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">{{ __('Bukti Pembayaran') }}</label>
			<div class="col-sm-10 parent-group">
				<div class="custom-file">
					<input type="hidden" name="bukti_pembayaran[uploaded]" class="uploaded" value="0">
					<input @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif type="file" multiple class="custom-file-input base-form--save-temp-files" data-name="bukti_pembayaran"
						data-container="parent-group" data-max-size="20024" data-max-file="100" accept="*">
					<label class="custom-file-label" for="file">Choose File</label>
				</div>
				<div class="form-text text-muted">*Maksimal 20MB</div>
				@foreach ($record->files($module)->where('flag', 'bukti_pembayaran')->get() as $file)
				<div class="progress-container w-100" data-uid="{{ $file->id }}">
					<div class="alert alert-custom alert-light fade show py-2 px-4 mb-0 mt-2 success-uploaded" role="alert">
						<div class="alert-icon">
							<i class="{{ $file->file_icon }}"></i>
						</div>
						<div class="alert-text text-left">
							<input type="hidden" name="bukti_pembayaran[files_ids][]" value="{{ $file->id }}">
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