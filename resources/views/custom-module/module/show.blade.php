@extends('layouts.page')

@section('content-body')
	<style>
		.note-editor.note-frame .panel-heading.note-toolbar{
			width: 100%;
    		height: 50px; /* Adjust the height as needed */
		}
	</style>
    <div class="flex-column-fluid">
            <div class="container-fluid">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Module</h3>
                        <div class="card-toolbar">
                        @section('card-toolbar')
                            @include('layouts.forms.btnBackTop')
                        @show
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">{{ __('Judul Utama') }}</label>
								<div class="col-sm-8 parent-group">
									<input type="text" disabled value="{{ $record->title }}" name="title" class="form-control" placeholder="{{ __('Judul Utama') }}">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">{{ __('Status') }}</label>
								<div class="col-sm-8 parent-group">
									<select disabled class="form-control filter-control base-plugin--select2"
										name="status"
										data-placeholder="{{ __('Pilih Salah Satu') }}">
										<option value="">{{ __('Pilih Salah Satu') }}</option>
										<option @if($record->status == "active") selected @endif value="active">Aktif</option>
										<option @if($record->status == "nonactive") selected @endif value="nonactive">Nonaktif</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">{{ __('Deskripsi') }}</label>
								<div class="col-sm-10 parent-group">
									<textarea disabled data-height="200" name="description" class="base-plugin--summernote" placeholder="{{ __('Deskripsi') }}">{{ $record->description }}</textarea>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom">
                        <div class="card-header">
                            <h3 class="card-title">Detail Module</h3>
                            <div class="card-toolbar">
                            </div>
                        </div>
                        <div class="card-body">
							{{-- Detail --}}
                            <div class="col-sm-12">
								<hr>
								<div class="form-group row">
									<div class="col-sm-12 parent-group">
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th class="text-center width-40px" >#</th>
														<th class="text-center">{{ __('Nama') }}</th>
													</tr>
												</thead>
												<tbody>
													@foreach ( $data['body'] as $i => $detail)
														<tr data-keys="{{ $i }} " id="trParent">
															<td class="text-center width-40px no"> {{ $i }} </td>
															<td class="parent-group text-left">
																<div class="input-group" style="display:flex;">
																	<div class="parent-group" style="width:30%%;">
																		<input disabled type="text" name="details[{{ $i }}][title_number]"
																		class="form-control" value="{{ $detail['id'] ?? '' }}"
																		placeholder="{{ __('Penomoran') }}">
																	</div>
																	<div class="parent-group" style="width:80%;">
																		<input disabled type="text" name="details[{{ $i }}][title]"
																		class="form-control" value="{{ $detail['heading'] ?? '' }}"
																		placeholder="{{ __('Judul') }}">
																	</div>
																</div>
															</td>
														</tr>
														<tr>
															<td></td>
															<td>
																<table data-keys="{{ $i }} " class="table table-bordered" id="detailsBody{{ $i }}">
																	<thead>
																		<tr>
																			<th class="text-center width-80px">{{ __('No') }}</th>
																			<th class="text-center">{{ __('Tipe Kolom') }}</th>
																			<th class="text-center">{{ __('Data') }}</th>
																			<th class="text-center">{{ __('Kosong?') }}</th>
																			<th class="text-center">{{ __('Judul') }}</th>
																			<th class="text-center">{{ __('Information') }}</th>
																		</tr>
																	</thead>
																	<tbody>
																		@foreach ($detail['data'] as $j => $child)
																		<tr data-parent="{{ $i }} " data-key="{{ $j }}">
																			<td class="text-left parent-group">
																				<input disabled type="text" name="details[{{ $i }} ][{{ $j }}][numbering]"
																					class="form-control" value="{{ $child['id'] }}"
																					placeholder="{{ __('No') }}">
																			</td>
																			<td class="text-left parent-group">
																				<select disabled class="form-control filter-control base-plugin--select2"
																					name="details[{{ $i }} ][{{ $j }}][type]"
																					data-placeholder="{{ __('Pilih Salah Satu') }}">
																					<option value="">{{ __('Pilih Salah Satu') }}</option>
																					<option @if($child['type'] == 'multiselect') selected @endif value="multiselect">Pilihan Multi</option>
																					<option @if($child['type'] == 'money') selected @endif value="money">Uang</option>
																					<option @if($child['type'] == 'date') selected @endif value="date">Tanggal</option>
																					<option @if($child['type'] == 'select') selected @endif value="select">Pilihan</option>
																					<option @if($child['type'] == 'integer') selected @endif value="integer">Angka</option>
																					<option @if($child['type'] == 'string') selected @endif value="string">Teks Singkat</option>
																					<option @if($child['type'] == 'textarea') selected @endif value="textarea">Teks</option>
																				</select>
																			</td>
																			<td class="text-left parent-group">
																				<textarea disabled id="summernote-disabled" name="details[{{ $i }} ][{{ $j }}][value]" class="base-plugin--summernote-2" placeholder="{{ __('Data') }}">@foreach ($child['data'] as $value)<p >{{$value['value']}}</p >@endforeach</textarea>
																			</td>
																			<td class="text-left parent-group">
																				<select disabled class="form-control filter-control base-plugin--select2"
																					name="details[{{ $i }} ][{{ $j }}][required]"
																					data-placeholder="{{ __('Pilih Salah Satu') }}">
																					<option value="">{{ __('Pilih Salah Satu') }}</option>
																					<option @if($child['require'] == 'false') selected @endif value="false">Boleh Kosong</option>
																					<option @if($child['require'] == 'true') selected @endif value="true">Wajib Diisi</option>
																				</select>
																			</td>
																			<td class="text-left parent-group">
																				<textarea disabled data-height="200" name="details[{{ $i }} ][{{ $j }}][title]" class="form-control" placeholder="{{ __('Judul') }}">{{ $child['title'] }}</textarea>
																			</td>
																			<td class="text-left parent-group">
																				<textarea disabled data-height="200" name="details[{{ $i }} ][{{ $j }}][information]" class="form-control" placeholder="{{ __('Informasi') }}">{{ $child['informationMsg'] }}</textarea>
																			</td>
																		</tr>
																		@endforeach
																		
																	</tbody>
																</table>
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							{{-- Detail --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (request()->route()->getName() !=
                $routes . '.detail.show')
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-custom">
                            <div class="card-header">
                                <h3 class="card-title">Reminder</h3>
                                <div class="card-toolbar">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    Sebelum submit, pastikan data sesuai & alur persetujuan terisi.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-custom">
                            <div class="card-header">
                                <h3 class="card-title">Aksi</h3>
                                <div class="card-toolbar">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    @include('layouts.forms.btnDropdownSubmit')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
</div>
</div>
@endsection

@section('buttons')
@endsection

@push('scripts')
	@include($views.'.includes.scripts')
@endpush
