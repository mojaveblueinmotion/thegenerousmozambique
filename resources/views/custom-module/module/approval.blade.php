@extends('layouts.page', ['container' => 'container'])

@section('card-body')
	@include('preparation.assignment.includes.header')
	<hr>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Tanggal Surat') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="text" class="form-control" value="{{ $record->letter_date->format('d/m/Y') }}" disabled>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-4 col-form-label">{{ __('Dari') }}</label>
				<div class="col-md-8 parent-group">
					<select name="from_id" class="form-control base-plugin--select2-ajax"
						data-url="{{ rut('ajax.selectUser', [
							'search'=>'auditor',
							'summary_id'=>$summary->id
						]) }}"
						placeholder="{{ __('Pilih Salah Satu') }}" disabled>
						<option value="">{{ __('Pilih Salah Satu') }}</option>
						@if ($val = $record->from)
							<option value="{{ $val->id }}" selected>{{ $val->name }} ({{ $val->position->name }})</option>
						@endif
					</select>
				</div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('No Surat') }}</label>
				<div class="col-sm-8 parent-group">
					<input type="text" class="form-control" value="{{ $record->show_letter_no }}" disabled>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">{{ __('Alamat') }}</label>
				<div class="col-sm-8 parent-group">
					<textarea class="form-control" disabled>{!! $record->to_address !!}</textarea>
				</div>
			</div>
		</div>
	</div>
	@if($summary->type_id != 2)
	<div class="form-group row">
		<label class="col-md-2 col-form-label">{{ __('Kepada') }}</label>
		<div class="col-md-10 parent-group">
			<select disabled name="users[]" class="form-control base-plugin--select2-ajax"
				data-url="{{ rut('ajax.selectUser', [
					'search'=>'auditee',
					'summary_id'=>$summary->id
				]) }}"
				multiple
				placeholder="{{ __('Pilih Beberapa') }}">
				<option value="">{{ __('Pilih Beberapa') }}</option>
				@foreach ($record->to as $val)
					<option value="{{ $val->id }}" selected>{{ $val->name }} ({{ isset($val->position) ? $val->position->name : $val->jabatan_provider }})</option>
				@endforeach
			</select>
		</div>
	</div>
	@else
	<div class="form-group row">
		<label class="col-md-2 col-form-label">{{ __('Kepada') }}</label>
		<div class="col-md-10 parent-group">
			<select disabled name="users[]" class="form-control base-plugin--select2-ajax"
				data-url="{{ rut('ajax.selectUser', [
					'search'=>'user-ti',
					'summary_id'=>$summary->id
				]) }}"
				multiple placeholder="{{ __('Pilih Beberapa') }}">
				<option value="">{{ __('Pilih Beberapa') }}</option>
				@foreach ($record->to as $val)
					<option value="{{ $val->id }}" selected>{{ $val->name }} ({{ $val->jabatan_provider }})</option>
				@endforeach
			</select>
		</div>
	</div>
	@endif
	<div class="form-group row">
		<label class="col-2 col-form-label">{{ __('Tembusan') }}</label>
		<div class="col-10 parent-group">
			<select name="cc[]" class="form-control base-plugin--select2-ajax"
				data-url="{{ rut('ajax.selectUser', 'all') }}" disabled multiple placeholder="{{ __('Pilih Beberapa') }}">
				@foreach ($record->cc as $cc)
					<option selected value="{{ $cc->id }}">{{ $cc->name }} ({{ $cc->position->name }})</option>
				@endforeach
			</select>
		</div>
	</div>
	<hr>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">{{ __('Perihal') }}</label>
		<div class="col-sm-10 parent-group">
			<textarea name="perihal" class="form-control" placeholder="{{ __('Perihal') }}" disabled>{!! $record->perihal !!}</textarea>
		</div>
	</div>
    <div class="form-group row">
		<label class="col-sm-2 col-form-label">{{ __('Pembuka') }}</label>
		<div class="col-sm-10 parent-group">
			<textarea name="description" class="form-control" placeholder="{{ __('Pembuka') }}" disabled>{!! $record->description !!}</textarea>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-2 col-form-label">{{ __('Penutup') }}</label>
		<div class="col-md-10 parent-group">
			<textarea name="penutup" class="form-control" placeholder="{{ __('Penutup') }}" disabled>{!! $record->penutup !!}</textarea>
		</div>
	</div>
    <div class="form-group row">
		<label class="col-md-2 col-form-label">{{ __('Tujuan Audit') }}</label>
		<div class="col-md-10 parent-group">
			<textarea name="objective" class="form-control" placeholder="{{ __('Tujuan Audit') }}" disabled>{!! $record->objective !!}</textarea>
		</div>
	</div>
	<hr>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">{{ __('Penanggung Jawab') }}</label>
		<div class="col-sm-10 parent-group">
			<select name="pic_id" class="form-control base-plugin--select2-ajax"
				data-url="{{ rut('ajax.selectUser', 'auditor') }}"
				disabled
				placeholder="{{ __('Pilih Salah Satu') }}">
				<option value="">{{ __('Pilih Salah Satu') }}</option>
				@if ($val = $record->pic)
					<option value="{{ $val->id }}" selected>{{ $val->name }} ({{ $val->position->name }})</option>
				@endif
			</select>
		</div>
	</div>
    <div class="form-group row">
		<label class="col-sm-2 col-form-label">{{ __('Pengendali Teknis') }}</label>
		<div class="col-sm-10 parent-group">
			<select name="supervisor_id" class="form-control base-plugin--select2-ajax"
				data-url="{{ rut('ajax.selectUser', 'auditor') }}"
				disabled
				placeholder="{{ __('Pilih Salah Satu') }}">
				<option value="">{{ __('Pilih Salah Satu') }}</option>
				@if ($val = $record->supervisor)
					<option value="{{ $val->id }}" selected>{{ $val->name }} ({{ $val->position->name }})</option>
				@endif
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">{{ __('Ketua Tim') }}</label>
		<div class="col-sm-10 parent-group">
			<select name="leader_id" class="form-control base-plugin--select2-ajax"
				data-url="{{ rut('ajax.selectUser', 'auditor') }}"
				disabled
				placeholder="{{ __('Pilih Salah Satu') }}">
				<option value="">{{ __('Pilih Salah Satu') }}</option>
				@if ($val = $record->leader)
					<option value="{{ $val->id }}" selected>{{ $val->name }} ({{ $val->position->name }})</option>
				@endif
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">{{ __('Anggota Tim') }}</label>
		<div class="col-sm-10 parent-group">
			<select name="members[]" class="form-control base-plugin--select2-ajax"
				data-url="{{ rut('ajax.selectUser', 'auditor') }}"
				multiple
				disabled
				placeholder="{{ __('Pilih Salah Satu') }}">
				<option value="">{{ __('Pilih Salah Satu') }}</option>
				@foreach ($record->members as $val)
					<option value="{{ $val->id }}" selected>{{ $val->name }} ({{ $val->position->name }})</option>
				@endforeach
			</select>
		</div>
	</div>
	<hr>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">{{ __('Keterangan') }}</label>
		<div class="col-sm-10 parent-group">
			<textarea name="note" class="form-control" placeholder="{{ __('Keterangan') }}" disabled>{!! $record->note !!}</textarea>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">{{ __('Tanggal Pelaksanaan') }}</label>
		<div class="col-sm-10 parent-group">
			<div class="input-group">
				<input type="text" name="date_start"
					class="form-control"
					disabled
					value="{{ $record->date_start->format('d/m/Y') }}">
				<div class="input-group-append">
					<span class="input-group-text">
						<i class="la la-ellipsis-h"></i>
					</span>
				</div>
				<input type="text" name="date_end"
					class="form-control"
					disabled
					value="{{ $record->date_end->format('d/m/Y') }}">
			</div>
		</div>
	</div>
	<hr>
	<div class="form-group row">
		<label class="col-md-2 col-form-label">{{ __('Lingkup Audit') }}</label>
		<div class="col-md-10 parent-group">
			<select name="aspects[]" class="form-control base-plugin--select2-ajax"
				data-url="{{ rut('ajax.selectAspect', [
					'search' => 'by_object',
					'category' => $summary->getCategory(true),
					'object_id' => $summary->getObjectId(),
				]) }}"
				multiple
				disabled
				placeholder="{{ __('Pilih Beberapa') }}">
				<option value="">{{ __('Pilih Beberapa') }}</option>
				@foreach ($record->aspects as $val)
					<option value="{{ $val->id }}" selected>{{ $val->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
@endsection

@section('buttons')
	@if ($record->checkAction('approval', $perms))
		<div class="card-footer">
			<div class="d-flex justify-content-between">
				@include('layouts.forms.btnBack')
				@include('layouts.forms.btnDropdownApproval')
				@include('layouts.forms.modalReject')
			</div>
		</div>
	@endif
@endsection
