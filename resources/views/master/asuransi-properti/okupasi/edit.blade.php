@extends('layouts.modal')

@section('action', route($routes.'.update', $record->id))

@section('modal-body')
	@method('PATCH')
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Kode') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="text" value="{{ $record->code }}" name="code" class="form-control" placeholder="{{ __('Kode') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Nama Okupasi') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="text" value="{{ $record->name }}" name="name" class="form-control" placeholder="{{ __('Nama Okupasi') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Judul Okupasi?') }}</label>
		<div class="col-sm-8 parent-group">
			<select name="status_judul" class="form-control base-plugin--select2-ajax status_judul"
				data-placeholder="{{ __('Pilih Salah Satu') }}">
				<option @if($record->status_judul == 0) selected @endif value="0">Bukan Judul</option>
				<option @if($record->status_judul == 1) selected @endif value="1">Judul</option>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Tarif Kelas Konstruksi 1') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="number" value="{{ $record->tarif_konstruksi_satu }}" name="tarif_konstruksi_satu" class="form-control" placeholder="{{ __('Tarif Kelas Konstruksi 1') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Tarif Kelas Konstruksi 2') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="number" value="{{ $record->tarif_konstruksi_dua }}" name="tarif_konstruksi_dua" class="form-control" placeholder="{{ __('Tarif Kelas Konstruksi 2') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Tarif Kelas Konstruksi 3') }}</label>
		<div class="col-sm-8 parent-group">
			<input type="number" value="{{ $record->tarif_konstruksi_tiga }}" name="tarif_konstruksi_tiga" class="form-control" placeholder="{{ __('Tarif Kelas Konstruksi 3') }}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-4 col-form-label">{{ __('Deskripsi Tambahan') }}</label>
		<div class="col-md-8 parent-group">
			<textarea name="description" class="form-control" placeholder="{{ __('Deskripsi Tambahan') }}">{{ $record->description }}</textarea>
		</div>
	</div>
@endsection
