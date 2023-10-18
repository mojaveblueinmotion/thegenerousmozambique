@extends('layouts.modal')

@section('action', route($routes.'.detailHargaUpdate', $detail->id))

@section('modal-body')
	@method('PATCH')
	<input type="hidden" name="polis_id" value="{{ $detail->polis_id }}">
	<div class="form-group row">
        <label class="col-md-4 col-form-label">{{ __('Pertanggungan Yang Dikalikan') }}</label>
        <div class="col-md-8 parent-group">
            <select name="pertanggungan_id" class="form-control base-plugin--select2-ajax pertanggungan_id"
                data-url="{{ route('ajax.selectPertanggunganTambahan', ['search' => 'all']) }}"
                placeholder="{{ __('Pilih Salah Satu') }}">
                <option value="">{{ __('Pilih Salah Satu') }}</option>
				@if (!empty($detail->pertanggungan_id))
					<option value="{{ $detail->pertanggungan_id }}" selected>{{ $detail->pertanggungan->name }}</option>
				@endif
            </select>
        </div>
    </div>
	<div class="form-group row">
		<label class="col-md-4 col-form-label">{{ __('Harga') }}</label>
		<div class="col-md-8 parent-group">
			<div class="input-group">
				<div class="parent-group input-group-prepend"><span
					class="input-group-text font-weight-bolder">Rp.</span>
				</div>
					<input value="{{ $detail->harga ?? '' }}" 
					class="form-control base-plugin--inputmask_currency harga" id="harga" name="harga"
						placeholder="{{ __('Harga') }}">
			</div>
		</div>
	</div>
@endsection
<script>
	$('.modal-dialog').removeClass('modal-md').addClass('modal-lg');
</script>