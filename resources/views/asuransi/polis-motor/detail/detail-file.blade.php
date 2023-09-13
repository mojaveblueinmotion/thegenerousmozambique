<div class="row">
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
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('STNK') }}</label>
			<div class="col-sm-8 parent-group">
				<div class="custom-file">
					<input type="hidden" name="stnk[uploaded]" class="uploaded" value="0">
					<input @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif type="file" multiple class="custom-file-input base-form--save-temp-files" data-name="stnk"
						data-container="parent-group" data-max-size="20024" data-max-file="100" accept="*">
					<label class="custom-file-label" for="file">Choose File</label>
				</div>
				<div class="form-text text-muted">*Maksimal 20MB</div>
				@foreach ($record->files($module)->where('flag', 'stnk')->get() as $file)
				<div class="progress-container w-100" data-uid="{{ $file->id }}">
					<div class="alert alert-custom alert-light fade show py-2 px-4 mb-0 mt-2 success-uploaded" role="alert">
						<div class="alert-icon">
							<i class="{{ $file->file_icon }}"></i>
						</div>
						<div class="alert-text text-left">
							<input type="hidden" name="stnk[files_ids][]" value="{{ $file->id }}">
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
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('BSTK') }}</label>
			<div class="col-sm-8 parent-group">
				<div class="custom-file">
					<input type="hidden" name="bstk[uploaded]" class="uploaded" value="0">
					<input @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif type="file" multiple class="custom-file-input base-form--save-temp-files" data-name="bstk"
						data-container="parent-group" data-max-size="20024" data-max-file="100" accept="*">
					<label class="custom-file-label" for="file">Choose File</label>
				</div>
				<div class="form-text text-muted">*Maksimal 20MB</div>
				@foreach ($record->files($module)->where('flag', 'bstk')->get() as $file)
				<div class="progress-container w-100" data-uid="{{ $file->id }}">
					<div class="alert alert-custom alert-light fade show py-2 px-4 mb-0 mt-2 success-uploaded" role="alert">
						<div class="alert-icon">
							<i class="{{ $file->file_icon }}"></i>
						</div>
						<div class="alert-text text-left">
							<input type="hidden" name="bstk[files_ids][]" value="{{ $file->id }}">
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
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Nomor Mesin') }}</label>
			<div class="col-sm-8 parent-group">
				<div class="custom-file">
					<input type="hidden" name="foto_nomor_mesin[uploaded]" class="uploaded" value="0">
					<input @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif type="file" multiple class="custom-file-input base-form--save-temp-files" data-name="foto_nomor_mesin"
						data-container="parent-group" data-max-size="20024" data-max-file="100" accept="*">
					<label class="custom-file-label" for="file">Choose File</label>
				</div>
				<div class="form-text text-muted">*Maksimal 20MB</div>
				@foreach ($record->files($module)->where('flag', 'foto_nomor_mesin')->get() as $file)
				<div class="progress-container w-100" data-uid="{{ $file->id }}">
					<div class="alert alert-custom alert-light fade show py-2 px-4 mb-0 mt-2 success-uploaded" role="alert">
						<div class="alert-icon">
							<i class="{{ $file->file_icon }}"></i>
						</div>
						<div class="alert-text text-left">
							<input type="hidden" name="foto_nomor_mesin[files_ids][]" value="{{ $file->id }}">
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
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Nomor Rangka') }}</label>
			<div class="col-sm-8 parent-group">
				<div class="custom-file">
					<input type="hidden" name="foto_nomor_rangka[uploaded]" class="uploaded" value="0">
					<input @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif type="file" multiple class="custom-file-input base-form--save-temp-files" data-name="foto_nomor_rangka"
						data-container="parent-group" data-max-size="20024" data-max-file="100" accept="*">
					<label class="custom-file-label" for="file">Choose File</label>
				</div>
				<div class="form-text text-muted">*Maksimal 20MB</div>
				@foreach ($record->files($module)->where('flag', 'foto_nomor_rangka')->get() as $file)
				<div class="progress-container w-100" data-uid="{{ $file->id }}">
					<div class="alert alert-custom alert-light fade show py-2 px-4 mb-0 mt-2 success-uploaded" role="alert">
						<div class="alert-icon">
							<i class="{{ $file->file_icon }}"></i>
						</div>
						<div class="alert-text text-left">
							<input type="hidden" name="foto_nomor_rangka[files_ids][]" value="{{ $file->id }}">
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
	<div class="col-md-6">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Motor Tampak Depan') }}</label>
			<div class="col-sm-8 parent-group">
				<div class="custom-file">
					<input type="hidden" name="mobil_tampak_depan[uploaded]" class="uploaded" value="0">
					<input @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif type="file" multiple class="custom-file-input base-form--save-temp-files" data-name="mobil_tampak_depan"
						data-container="parent-group" data-max-size="20024" data-max-file="100" accept="*">
					<label class="custom-file-label" for="file">Choose File</label>
				</div>
				<div class="form-text text-muted">*Maksimal 20MB</div>
				@foreach ($record->files($module)->where('flag', 'mobil_tampak_depan')->get() as $file)
				<div class="progress-container w-100" data-uid="{{ $file->id }}">
					<div class="alert alert-custom alert-light fade show py-2 px-4 mb-0 mt-2 success-uploaded" role="alert">
						<div class="alert-icon">
							<i class="{{ $file->file_icon }}"></i>
						</div>
						<div class="alert-text text-left">
							<input type="hidden" name="mobil_tampak_depan[files_ids][]" value="{{ $file->id }}">
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
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Motor Tampak Kanan') }}</label>
			<div class="col-sm-8 parent-group">
				<div class="custom-file">
					<input type="hidden" name="mobil_tampak_kanan[uploaded]" class="uploaded" value="0">
					<input @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif type="file" multiple class="custom-file-input base-form--save-temp-files" data-name="mobil_tampak_kanan"
						data-container="parent-group" data-max-size="20024" data-max-file="100" accept="*">
					<label class="custom-file-label" for="file">Choose File</label>
				</div>
				<div class="form-text text-muted">*Maksimal 20MB</div>
				@foreach ($record->files($module)->where('flag', 'mobil_tampak_kanan')->get() as $file)
				<div class="progress-container w-100" data-uid="{{ $file->id }}">
					<div class="alert alert-custom alert-light fade show py-2 px-4 mb-0 mt-2 success-uploaded" role="alert">
						<div class="alert-icon">
							<i class="{{ $file->file_icon }}"></i>
						</div>
						<div class="alert-text text-left">
							<input type="hidden" name="mobil_tampak_kanan[files_ids][]" value="{{ $file->id }}">
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
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Motor Tampak Kiri') }}</label>
			<div class="col-sm-8 parent-group">
				<div class="custom-file">
					<input type="hidden" name="mobil_tampak_kiri[uploaded]" class="uploaded" value="0">
					<input @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif type="file" multiple class="custom-file-input base-form--save-temp-files" data-name="mobil_tampak_kiri"
						data-container="parent-group" data-max-size="20024" data-max-file="100" accept="*">
					<label class="custom-file-label" for="file">Choose File</label>
				</div>
				<div class="form-text text-muted">*Maksimal 20MB</div>
				@foreach ($record->files($module)->where('flag', 'mobil_tampak_kiri')->get() as $file)
				<div class="progress-container w-100" data-uid="{{ $file->id }}">
					<div class="alert alert-custom alert-light fade show py-2 px-4 mb-0 mt-2 success-uploaded" role="alert">
						<div class="alert-icon">
							<i class="{{ $file->file_icon }}"></i>
						</div>
						<div class="alert-text text-left">
							<input type="hidden" name="mobil_tampak_kiri[files_ids][]" value="{{ $file->id }}">
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
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Motor Tampak Belakang') }}</label>
			<div class="col-sm-8 parent-group">
				<div class="custom-file">
					<input type="hidden" name="mobil_tampak_belakang[uploaded]" class="uploaded" value="0">
					<input @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif type="file" multiple class="custom-file-input base-form--save-temp-files" data-name="mobil_tampak_belakang"
						data-container="parent-group" data-max-size="20024" data-max-file="100" accept="*">
					<label class="custom-file-label" for="file">Choose File</label>
				</div>
				<div class="form-text text-muted">*Maksimal 20MB</div>
				@foreach ($record->files($module)->where('flag', 'mobil_tampak_belakang')->get() as $file)
				<div class="progress-container w-100" data-uid="{{ $file->id }}">
					<div class="alert alert-custom alert-light fade show py-2 px-4 mb-0 mt-2 success-uploaded" role="alert">
						<div class="alert-icon">
							<i class="{{ $file->file_icon }}"></i>
						</div>
						<div class="alert-text text-left">
							<input type="hidden" name="mobil_tampak_belakang[files_ids][]" value="{{ $file->id }}">
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
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{ __('Dashboard Motor') }}</label>
			<div class="col-sm-8 parent-group">
				<div class="custom-file">
					<input type="hidden" name="dashboard_mobil[uploaded]" class="uploaded" value="0">
					<input @if(request()->route()->getName() == $routes.'.detail.show' || request()->route()->getName() == $routes.'.approval') disabled @endif type="file" multiple class="custom-file-input base-form--save-temp-files" data-name="dashboard_mobil"
						data-container="parent-group" data-max-size="20024" data-max-file="100" accept="*">
					<label class="custom-file-label" for="file">Choose File</label>
				</div>
				<div class="form-text text-muted">*Maksimal 20MB</div>
				@foreach ($record->files($module)->where('flag', 'dashboard_mobil')->get() as $file)
				<div class="progress-container w-100" data-uid="{{ $file->id }}">
					<div class="alert alert-custom alert-light fade show py-2 px-4 mb-0 mt-2 success-uploaded" role="alert">
						<div class="alert-icon">
							<i class="{{ $file->file_icon }}"></i>
						</div>
						<div class="alert-text text-left">
							<input type="hidden" name="dashboard_mobil[files_ids][]" value="{{ $file->id }}">
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

