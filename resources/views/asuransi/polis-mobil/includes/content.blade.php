@extends('layouts.page')

@section('content-body')
<div class=" flex-column-fluid">
	<form action="{{ route($routes.'.submitSave', $record->id)}}" method="POST" autocomplete="off">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="container-fluid">
			<div class="card card-custom">
				<div class="card-header">
					<h3 class="card-title">Asuransi Mobil</h3>
					<div class="card-toolbar">
						@section('card-toolbar')
						@include('layouts.forms.btnBackTop')
						@show
					</div>
				</div>
				<div class="card-body">
					@include($views.'.includes.notes')
					@include($views.'.includes.header')
					<hr>
				</div>
			</div>
		</div>
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-custom">
						<div class="card-header">
							<h3 class="card-title">Pengecekan Mobil</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-cek')
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
                            <h3 class="card-title">Detail Modifikasi</h3>
                            <div class="card-toolbar">
                            </div>
                        </div>
                        <div class="card-body">
    						<div class="row">
								<div class="col-sm-12">
									<div class="form-group row">
										<div class="col-sm-12 parent-group">
											<div class="table-responsive" style="overflow-x:auto!important;">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th class="text-center width-20px">#</th>
															<th class="text-center width-200px">{{ __('Nama Modifikasi') }}</th>
															<th class="text-center width-100px">{{ __('Harga Modifikasi') }}</th>
															<th class="text-center valign-top width-30px">
																<button type="button" class="btn btn-sm btn-icon btn-circle btn-primary add-mod-part"><i class="fa fa-plus"></i></button>
															</th>
														</tr>
													</thead>
													<tbody>
														@foreach ($record->detailModifikasi as $part)
															<tr data-key="{{ $loop->iteration }}">
																<td class="text-center width-20px no">{{ $loop->iteration }}</td>
																<td class="text-left parent-group">
																	<input name="mod_part[{{ $loop->iteration }}][name]"
																		class="form-control" id="name"
																		placeholder="{{ __('Nama Modifikasi') }}" value="{{ $part->name }}">
																</td>
																<td class="text-left parent-group">
																	<input name="mod_part[{{ $loop->iteration }}][nilai_modifikasi]"
																		class="form-control base-plugin--inputmask_currency nilai_modifikasi_detail" id="nilai_modifikasi_detail"
																		placeholder="{{ __('Harga Modifikasi') }}" value="{{ $part->nilai_modifikasi }}">
																</td>
																<td class="text-center valign-top width-30px">
																	<button type="button" class="btn btn-sm btn-icon btn-circle btn-danger remove-ext-part">
																		<i class="fa fa-trash"></i>
																	</button>
																</td>
															</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
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
							<h3 class="card-title">Nilai Mobil</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-nilai')
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
							<h3 class="card-title">Pertanggungan Tambahan</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-grid-laporan')
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
							<h3 class="card-title">Foto Mobil</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-file')
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
                            <h3 class="card-title">Detail Rider | Penambahan Fitur</h3>
                            <div class="card-toolbar">
                            </div>
                        </div>
						<input type="hidden" class="form-control" value="{{ $record->id }}" id="idRecord">
                        <div class="card-body">
    						<div class="row">
								<div class="col-sm-12">
									<div class="form-group row">
										<div class="col-sm-12 parent-group">
											<div class="table-responsive" style="overflow-x:auto!important;">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th class="text-center width-20px">#</th>
															<th class="text-center width-200px">{{ __('Rider') }}</th>
															<th class="text-center width-100px">{{ __('Persentasi Eksisting') }}</th>
															<th class="text-center width-100px">{{ __('Persentasi Perkalian') }}</th>
															<th class="text-center width-100px">{{ __('Harga Perkalian') }}</th>
															<th class="text-center width-100px">{{ __('Total Harga') }}</th>
															<th class="text-center valign-top width-30px">
																<button type="button" class="btn btn-sm btn-icon btn-circle btn-primary add-ext-part"><i class="fa fa-plus"></i></button>
															</th>
														</tr>
													</thead>
													<tbody>
														@foreach ($record->rider as $part)
															<tr data-key="{{ $loop->iteration }}">
																<td class="text-center width-20px no">{{ $loop->iteration }}</td>
																<td class="text-left width-200px parent-group">
																	<select name="ext_part[{{ $loop->iteration }}][rider_id]"
																		class="form-control base-plugin--select2-ajax rider_id"
																		data-url="{{ route('ajax.selectRiderKendaraan', [
																		'search'=>'byAsuransi',
																		'asuransi_id'=> $record->asuransi_id,
																		]) }}"
																		style="width: 200px"
																		placeholder="{{ __('Pilih Salah Satu') }}">
																		<option value="">{{ __('Pilih Salah Satu') }}</option>
																		@if (!empty($part->rider_kendaraan_id))
																			<option value="{{ $part->rider_kendaraan_id }}" selected>{{ $part->riderKendaraan->name }}</option>
																		@endif
																	</select>
																</td>
																<td class="text-left parent-group">
																	<input readonly name="ext_part[{{ $loop->iteration }}][persentasi_eksisting]"
																		class="form-control" id="persentasi_eksisting"
																		placeholder="{{ __('Persentasi') }}" value="{{ $part->persentasi_eksisting }}">
																</td>
																
																<td class="text-left parent-group">
																	<input readonly name="ext_part[{{ $loop->iteration }}][persentasi_perkalian]"
																		class="form-control" id="persentasi_perkalian"
																		placeholder="{{ __('Persentasi Perkalian') }}" value="100">
																</td>
																<td class="text-left parent-group">
																	<input readonly name="ext_part[{{ $loop->iteration }}][harga_pembayaran]"
																		class="form-control base-plugin--inputmask_currency" id="harga_pembayaran"
																		placeholder="{{ __('Harga Perkalian') }}" value="{{ $part->harga_pembayaran }}">
																</td>
																<td class="text-left parent-group">
																	<input readonly name="ext_part[{{ $loop->iteration }}][total_harga]"
																		class="form-control base-plugin--inputmask_currency" id="total_harga"
																		placeholder="{{ __('Total Harga') }}" value="{{ $part->total_harga }}">
																</td>
																<td class="text-center valign-top width-30px">
																	<button type="button" class="btn btn-sm btn-icon btn-circle btn-danger remove-ext-part">
																		<i class="fa fa-trash"></i>
																	</button>
																</td>
															</tr>
														@endforeach
														{{-- <tr data-key="1">
															<td class="text-center width-20px no">1</td>
															<td class="text-left width-200px parent-group">
																<select name="ext_part[1][rider_id]"
																	class="form-control base-plugin--select2-ajax rider_id"
																	data-url="{{ route('ajax.selectRiderKendaraan', [
																		'search'=>'byAsuransi',
																		'asuransi_id'=> $record->asuransi_id,
																		]) }}"
																	style="width: 200px"
																	placeholder="{{ __('Pilih Salah Satu') }}">
																	<option value="">{{ __('Pilih Salah Satu') }}</option>
																</select>
															</td>
															<td class="text-left parent-group">
																<input type="text" name="ext_part[1][persentasi_eksisting]"
																class="form-control" id="persentasi_eksisting" readonly>
															</td>
														</tr> --}}
													</tbody>
												</table>
											</div>
										</div>
									</div>
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
							<h3 class="card-title">Detail Harga</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-harga')
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
							<h3 class="card-title">Detail Client</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-client')
						</div>
					</div>
				</div>
			</div>
		</div>
		@if(!empty($record->status) && $record->status == 'pending')
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-custom">
						<div class="card-header">
							<h3 class="card-title">Pembayaran</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-payment')
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		@if(request()->route()->getName() != $routes.'.detail.show')
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-6">
					<div class="card card-custom">
						<div class="card-header">
							<h3 class="card-title">Alur Persetujuan</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body text-center">
							@php
							$colors = [
							1 => 'primary',
							2 => 'info',
							];
							@endphp
							@if ($menu = \App\Models\Setting\Globals\Menu::where('module',
							'asuransi.polis-mobil')->first())
							@if ($menu->flows()->get()->groupBy('order')->count() == null)
							<span class="label label-light-info font-weight-bold label-inline" data-toggle="tooltip">Belum
								memiliki Alur Persetujuan.</span>
							@else
							@foreach ($orders = $menu->flows()->get()->groupBy('order') as $i => $flows)
							@foreach ($flows as $j => $flow)
							<span class="label label-light-{{ $colors[$flow->type] }} font-weight-bold label-inline"
								data-toggle="tooltip" title="{{ $flow->show_type }}">{{ $flow->role->name }}</span>
							@if (!($i === $orders->keys()->last() && $j === $flows->keys()->last()))
							<i class="mx-2 fas fa-angle-double-right text-muted"></i>
							@endif
							@endforeach
							@endforeach
							@endif
							@endif
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
								Sebelum submit, pastikan isian data sudah lengkap dan alur persetujuan sudah benar.
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