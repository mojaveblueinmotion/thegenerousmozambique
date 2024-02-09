@extends('layouts.page')

@section('content-body')
	<style>
		.note-editor.note-frame .panel-heading.note-toolbar{
			width: 100%;
    		height: 50px; /* Adjust the height as needed */
		}
	</style>
    <div class="flex-column-fluid">
        <form action="{{ route($routes . '.store') }}" method="POST" autocomplete="off">
			@method('POST')
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
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
                    @include($views . '.includes.header')
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
														<th class="text-center valign-top width-30px">
															<button type="button" class="btn btn-sm btn-icon btn-circle btn-primary add-ext-part"><i class="fa fa-plus"></i></button>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr data-keys="1" id="trParent">
														<td class="text-center width-40px no">1</td>
														<td class="parent-group text-left">
															<div class="input-group" style="display:flex;">
																<div class="parent-group" style="width:30%%;">
																	<input type="text" name="details[1][title_number]"
																	class="form-control"
																	placeholder="{{ __('Penomoran') }}">
																</div>
																<div class="parent-group" style="width:80%;">
																	<input type="text" name="details[1][title]"
																	class="form-control"
																	placeholder="{{ __('Judul') }}">
																</div>
															</div>
														</td>
														<td class="text-center valign-top width-30px">
															<button type="button" class="btn btn-sm btn-icon btn-circle btn-danger remove-ext-part">
																<i class="fa fa-trash"></i>
															</button>
														</td>
													</tr>
													<tr>
														<td></td>
														<td>
															<table data-keys="1" class="table table-bordered" id="detailsBody">
																<thead>
																	<tr>
																		<th class="text-center width-80px">{{ __('No') }}</th>
																		<th class="text-center width-100px">{{ __('Tipe Kolom') }}</th>
																		<th class="text-center width-100px">{{ __('Data') }}</th>
																		<th class="text-center">{{ __('Kosong?') }}</th>
																		<th class="text-center">{{ __('Judul') }}</th>
																		<th class="text-center">{{ __('Informasi') }}</th>
																		<th class="text-center valign-top width-30px">
																			<button type="button" class="btn btn-sm btn-icon btn-circle btn-primary add-ext-part-details"><i class="fa fa-plus"></i></button>
																		</th>
																	</tr>
																</thead>
																<tbody>
																	<tr data-key="1">
																		{{-- <td class="text-center width-40px no">1</td> --}}
																		<td class="text-left parent-group">
																			<input type="text" name="details[1][1][numbering]"
																				class="form-control"
																				placeholder="{{ __('No') }}">
																		</td>
																		<td class="text-left parent-group">
																			<select class="form-control filter-control base-plugin--select2"
																				name="details[1][1][type]"
																				data-placeholder="{{ __('Pilih Salah Satu') }}">
																				<option value="">{{ __('Pilih Salah Satu') }}</option>
																				<option value="multiselect">Pilihan Multi</option>
																				<option value="money">Uang</option>
																				<option value="date">Tanggal</option>
																				<option value="select">Pilihan</option>
																				<option value="integer">Angka</option>
																				<option value="string">Teks Singkat</option>
																				<option value="textarea">Teks</option>
																			</select>
																		</td>
																		<td class="text-left parent-group">
																			<textarea id="summernote-disabled" name="details[1][1][value]" class="base-plugin--summernote-2" placeholder="{{ __('Data') }}"></textarea>
																		</td>
																		<td class="text-left parent-group">
																			<select class="form-control filter-control base-plugin--select2"
																				name="details[1][1][required]"
																				data-placeholder="{{ __('Pilih Salah Satu') }}">
																				<option value="">{{ __('Pilih Salah Satu') }}</option>
																				<option value="false">Boleh Kosong</option>
																				<option value="true">Wajib Diisi</option>
																			</select>
																		</td>
																		<td class="text-left parent-group">
																			<textarea data-height="200" name="details[1][1][title]" class="form-control" placeholder="{{ __('Judul') }}"></textarea>
																		</td>
																		<td class="text-left parent-group">
																			<textarea data-height="200" name="details[1][1][information]" class="form-control" placeholder="{{ __('Informasi') }}"></textarea>
																		</td>
																		<td class="text-center valign-top width-30px">
																			<button type="button" class="btn btn-sm btn-icon btn-circle btn-danger remove-ext-part-details">
																				<i class="fa fa-trash"></i>
																			</button>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
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
