@extends('layouts.modal')

@section('modal-body')
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{ __('Nama') }}</label>
		<div class="col-sm-8 parent-group">
			<input disabled type="text" value="{{ $record->name }}" name="name" class="form-control" placeholder="{{ __('Nama') }}">
		</div>
	</div>
	<div class="form-group row">
        <label class="col-md-4 col-form-label">{{ __('Bagian') }}</label>
        <div class="col-md-8 parent-group">
            <select disabled name="section" class="form-control base-plugin--select2-ajax section"
                placeholder="{{ __('Pilih Salah Satu') }}">
                <option value="">{{ __('Pilih Salah Satu') }}</option>
                <option @if($record->section == 1) selected @endif value="1">{{ __('Bagian 1') }}</option>
                <option @if($record->section == 2) selected @endif value="2">{{ __('Bagian 2') }}</option>
            </select>
        </div>
    </div>
	<div class="form-group row">
		<label class="col-md-4 col-form-label">{{ __('Deskripsi') }}</label>
		<div class="col-md-8 parent-group">
			<textarea disabled name="description" class="form-control" placeholder="{{ __('Deskripsi') }}">{{ $record->description }}</textarea>
		</div>
	</div>
@endsection

@section('modal-footer')
@endsection
