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
	    </div>
	    <div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Call Center') }}</label>
				<div class="col-sm-8 parent-group">
					<input value="{{ $record->call_center }}" type="text" disabled name="call_center" class="form-control" placeholder="{{ __('Call Center') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Bank') }}</label>
				<div class="col-sm-8 parent-group">
					<input disabled type="text" value="{{ $record->bank }}" name="bank" class="form-control" placeholder="{{ __('Bank') }}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('No Rekening') }}</label>
				<div class="col-sm-8 parent-group">
					<input disabled type="text" value="{{ $record->no_rekening }}" name="no_rekening" class="form-control" placeholder="{{ __('No Rekening') }}">
				</div>
			</div>
	    </div>
	</div>
	<div class="form-group row">
		<label class="col-md-2 col-form-label">{{ __('Deskripsi') }}</label>
		<div class="col-md-10 parent-group">
			<textarea name="description" class="base-plugin--summernote" placeholder="{{ __('Deskripsi') }}" disabled>{{ $record->description }}</textarea>
		</div>
	</div>
	
	<div class="form-group row">
		<label class="col-md-2 col-form-label">{{ __('Cara Klaim') }}</label>
		<div class="col-md-10 parent-group">
			<textarea name="description_claim" class="base-plugin--summernote" placeholder="{{ __('Cara Klaim') }}" disabled>{{ $record->description_claim }}</textarea>
		</div>
	</div>
	<hr>
	<table id="dataFilters" class="width-full">
		<tbody>
			<tr>
				<td>
					<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
						Persentasi Asuransi
					</h5>
				</td>
				<td class="text-right td-btn-create width-200px">
					@include('layouts.forms.btnAdd', [
						'urlAdd' => route($routes.'.persentasiCreate', $record->id)
					])
				</td>
			</tr>
		</tbody>
	</table>
	<div class="table-responsive">
	    @if(isset($tableStruct['datatable_2']))
		    <table id="datatable_2" class="table table-bordered is-datatable" style="width: 100%;"
		    	data-url="{{ $tableStruct['url_2'] }}"
		    	data-paging="{{ $paging ?? true }}"
		    	data-info="{{ $info ?? true }}">
		        <thead>
		            <tr>
		                @foreach ($tableStruct['datatable_2'] as $struct)
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
	<hr>
	<table id="dataFilters" class="width-full">
		<tbody>
			<tr>
				<td>
					<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
						Rider Asuransi
					</h5>
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
