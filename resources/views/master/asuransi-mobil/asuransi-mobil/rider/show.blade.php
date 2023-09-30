@extends('layouts.modal')

@section('modal-body')
<div class="form-group row">
    <label class="col-sm-4 col-form-label">{{ __('Rider Asuransi') }}</label>
    <div class="col-sm-8 parent-group">
        <select disabled name="rider_kendaraan_id" class="form-control base-plugin--select2-ajax rider_kendaraan_id"
            data-url="{{ route('ajax.selectRiderKendaraan', 'all') }}"
            data-placeholder="{{ __('Pilih Salah Satu') }}">
            @if (!empty($rider->rider_kendaraan_id))
                <option value="{{ $rider->rider_kendaraan_id }}" selected>{{ $rider->riderKendaraan->name }}</option>
            @endif
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-4 col-form-label">{{ __('Persentasi') }}</label>
    <div class="col-sm-8 parent-group">
        <input disabled type="number" value="{{ $rider->pembayaran_persentasi }}" name="pembayaran_persentasi" class="form-control" placeholder="{{ __('Persentasi') }}">
    </div>
</div>
@endsection

@section('modal-footer')
@endsection
