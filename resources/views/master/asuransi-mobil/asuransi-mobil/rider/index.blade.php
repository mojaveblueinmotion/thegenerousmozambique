@extends('layouts.page', ['container' => 'container'])

@section('card-body')
	@method('POST')
	<div class="row">
	    <div class="col-sm-6">
	        <div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Perusahaan') }}</label>
				<div class="col-sm-8 parent-group">
					<select disabled name="perusahaan_asuransi_id" class="form-control base-plugin--select2-ajax branch_id"
						data-url="{{ route('ajax.selectPerusahaanAsuransi', 'all') }}"
						data-placeholder="{{ __('Pilih Salah Satu') }}">
						@if (!empty($record->perusahaan_asuransi_id))
							<option value="{{ $record->perusahaan_asuransi_id }}" selected>{{ $record->perusahaanAsuransi->name }}</option>
						@endif
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Kategori Asuransi') }}</label>
				<div class="col-sm-8 parent-group">
					<select disabled name="kategori_asuransi_id" class="form-control base-plugin--select2-ajax branch_id"
						data-url="{{ route('ajax.selectKategoriAsuransi', 'all') }}"
						data-placeholder="{{ __('Pilih Salah Satu') }}">
						@if (!empty($record->kategori_asuransi_id))
							<option value="{{ $record->kategori_asuransi_id }}" selected>{{ $record->kategoriAsuransi->name }}</option>
						@endif
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Nama Asuransi') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="text" value="{{ $record->name }}" disabled name="name" class="form-control" placeholder="{{ __('Nama Asuransi') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Interval Pembayaran') }}</label>
				<div class="col-sm-8 parent-group">
					<select disabled name="interval_pembayaran_id" class="form-control base-plugin--select2-ajax branch_id"
						data-url="{{ route('ajax.selectIntervalPembayaran', 'all') }}"
						data-placeholder="{{ __('Pilih Salah Satu') }}">
						@if (!empty($record->interval_pembayaran_id))
							<option value="{{ $record->interval_pembayaran_id }}" selected>{{ $record->intervalPembayaran->name }}</option>
						@endif
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-4 col-form-label">{{ __('Fitur') }}</label>
				<div class="col-md-8 parent-group">
					<select disabled name="to[]" class="form-control base-plugin--select2-ajax"
						data-url="{{ route('ajax.selectFiturAsuransi', [
							'search'=>'all',
						]) }}"
						multiple
						placeholder="{{ __('Pilih Beberapa') }}">
						<option value="">{{ __('Pilih Beberapa') }}</option>
						@if (!empty($record->fiturs))
						@foreach ($record->fiturs as $value)
							<option value="{{ $record->interval_pembayaran_id }}" selected>{{ $record->intervalPembayaran->name }}</option>
						@endforeach
						@endif
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Call Center') }}</label>
				<div class="col-sm-8 parent-group">
					<input value="{{ $record->call_center }}" type="text" disabled name="call_center" class="form-control" placeholder="{{ __('Call Center') }}">
				</div>
			</div>
	    </div>
	    <div class="col-sm-6">
			
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 1 Batas Atas') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" value="{{ $record->wilayah_satu_batas_atas }}" disabled name="wilayah_satu_batas_atas" class="form-control" placeholder="{{ __('Wilayah 1 Batas Atas') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 1 Batas Bawah') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" value="{{ $record->wilayah_satu_batas_bawah }}" disabled name="wilayah_satu_batas_bawah" class="form-control" placeholder="{{ __('Wilayah 1 Batas Bawah') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 2 Batas Atas') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" value="{{ $record->wilayah_dua_batas_atas }}" disabled name="wilayah_dua_batas_atas" class="form-control" placeholder="{{ __('Wilayah 2 Batas Atas') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 2 Batas Bawah') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" value="{{ $record->wilayah_dua_batas_bawah }}" disabled name="wilayah_dua_batas_bawah" class="form-control" placeholder="{{ __('Wilayah 1 Batas Bawah') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 3 Batas Atas') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" value="{{ $record->wilayah_tiga_batas_atas }}" disabled name="wilayah_tiga_batas_atas" class="form-control" placeholder="{{ __('Wilayah 3 Batas Atas') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Wilayah 3 Batas Bawah') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="number" value="{{ $record->wilayah_tiga_batas_bawah }}" disabled name="wilayah_tiga_batas_bawah" class="form-control" placeholder="{{ __('Wilayah 3 Batas Bawah') }}">
				</div>
			</div>
	    </div>
	</div>
	<hr>
	<table id="dataFilters" class="width-full">
		<tbody>
			<tr>
				<td class="pb-2 valign-top td-filter-reset width-80px">
					<div class="reset-filter mr-1 hide">
						<button class="btn btn-secondary btn-icon width-full reset button" data-toggle="tooltip" data-original-title="Reset Filter"><i class="fas fa-sync"></i></button>
					</div>
					<div class="label-filter mr-1">
						<button class="btn btn-secondary btn-icon width-full filter button" data-toggle="tooltip" data-original-title="Filter"><i class="fas fa-filter"></i></button>
					</div>
				</td>
				<td>
					<div class="row">
						<div class="col-12 col-sm-6 col-xl-3 pb-2">
							<input type="text" class="form-control filter-control"
								data-post="statement"
								placeholder="{{ __('Pernyataan') }}">
						</div>
					</div>
				</td>
				<td class="text-right td-btn-create width-200px">
					@include('layouts.forms.btnAdd', [
						'urlAdd' => route($routes.'.riderCreate', $record->id)
					])
				</td>
			</tr>
		</tbody>
	</table>
	<div class="table-responsive">
	    @if(isset($tableStruct['datatable_1']))
		    <table id="datatable_1" class="table table-bordered is-datatable" style="width: 100%;"
		    	data-url="{{ $tableStruct['url'] }}"
		    	data-paging="{{ $paging ?? true }}"
		    	data-info="{{ $info ?? true }}">
		        <thead>
		            <tr>
		                @foreach ($tableStruct['datatable_1'] as $struct)
		                	<th class="text-center v-middle"
		                		data-columns-name="{{ $struct['name'] ?? '' }}"
		                		data-columns-data="{{ $struct['data'] ?? '' }}"
		                		data-columns-label="{{ $struct['label'] ?? '' }}"
		                		data-columns-sortable="{{ $struct['sortable'] === true ? 'true' : 'false' }}"
		                		data-columns-width="{{ $struct['width'] ?? '' }}"
		                		data-columns-class-name="{{ $struct['className'] ?? '' }}"
		                		style="{{ isset($struct['width']) ? 'width: '.$struct['width'].'; ' : '' }}">
		                		{{ $struct['label'] }}
		                	</th>
		                @endforeach
		            </tr>
		        </thead>
		        <tbody>
		        </tbody>
		    </table>
		@endif
	</div>
@endsection

@section('buttons')
@endsection

@push('scripts')
@endpush