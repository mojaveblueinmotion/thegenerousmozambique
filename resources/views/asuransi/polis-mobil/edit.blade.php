@extends('layouts.modal')

@section('action', route($routes.'.update', $record->id))

@section('modal-body')
@method('PATCH')
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('No Asuransi') }}</label>
	<div class="col-sm-8 parent-group ">
		<input type="hidden" value="{{ $record->no_max }}" name="no_max">
		<input type="text" readonly value="{{ $record->no_asuransi }}" name="no_asuransi" class="form-control" placeholder="{{ __('No Asuransi') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-md-4 col-form-label">{{ __('Tanggal Asuransi') }}</label>
	<div class="col-md-8 parent-group">
		<div class="row no-gutters input-group">
			<div class="col-md-6 parent-group" >
				<input type="text" name="tanggal"
					class="form-control base-plugin--datepicker date_start rounded-right-0"
					placeholder="{{ __('Awal') }}"
					value="{{ $record->tanggal->format('d/m/Y') }}"
					data-orientation="top">
			</div>
			<div class="col-md-6 parent-group" >
				<input type="text" name="tanggal_akhir_asuransi"
					class="form-control base-plugin--datepicker date_end rounded-left-0"
					placeholder="{{ __('Akhir') }}"
					value="{{ $record->tanggal_akhir_asuransi ? $record->tanggal_akhir_asuransi->format('d/m/Y') : null }}"
					data-orientation="top" disabled>
			</div>
		</div>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Agent') }}</label>
	<div class="col-sm-8 parent-group">
		<select required name="agent_id" class="form-control base-plugin--select2-ajax"
			data-url="{{ route('ajax.selectAgent', 'all') }}" placeholder="{{ __('Pilih Salah Satu') }}">
			<option value="">{{ __('Pilih Salah Satu') }}</option>
			@if (!empty($record->agent_id))
				<option value="{{ $record->agent_id }}" selected>{{ $record->agent->name }}</option>
			@endif
		</select>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Asuransi Mobil') }}</label>
	<div class="col-sm-8 parent-group">
		<select required name="asuransi_id" class="form-control base-plugin--select2-ajax"
			data-url="{{ route('ajax.selectAsuransiMobil', 'all') }}" placeholder="{{ __('Pilih Salah Satu') }}">
			<option value="">{{ __('Pilih Salah Satu') }}</option>
			@if (!empty($record->asuransi_id))
				<option value="{{ $record->asuransi_id }}" selected>{{ $record->asuransi->name }}</option>
			@endif
		</select>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Nama Client') }}</label>
	<div class="col-sm-8 parent-group ">
		<input type="text" name="name" value="{{ $record->name }}" class="form-control" placeholder="{{ __('Nama Client') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('No. Telepon') }}</label>
	<div class="col-sm-8 parent-group ">
		<input type="number" value="{{ $record->phone }}" name="phone" class="form-control" placeholder="{{ __('No. Telepon') }}">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{ __('Email') }}</label>
	<div class="col-sm-8 parent-group ">
		<input type="text" value="{{ $record->email }}" name="email" class="form-control" placeholder="{{ __('Email') }}">
	</div>
</div>
@endsection


@push('scripts')
<script>
	$(function () {
			$('.content-page').on('changeDate', 'input.date_start', function (value) {
				var me = $(this);
				if (me.val()) {
					var startDate = new Date(value.date.valueOf());
					var date_end = me.closest('.input-group').find('input.date_end');
					date_end.prop('disabled', false)
							.val(me.val())
							.datepicker('setStartDate', startDate)
							.focus();
				}
			});
		});
</script>
@endpush
