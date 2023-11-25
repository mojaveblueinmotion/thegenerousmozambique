@extends('layouts.modal')

@section('action', route($routes.'.detailHargaStore'))

@section('modal-body')
	@method('PATCH')
	<input type="hidden" name="polis_id" value="{{ $detail->id }}">
	<div class="form-group row">
        <label class="col-md-4 col-form-label">{{ __('Pertanggungan Yang Dikalikan') }}</label>
        <div class="col-md-8 parent-group">
            <select name="pertanggungan_id" class="form-control base-plugin--select2-ajax pertanggungan_id"
                data-url="{{ route('ajax.selectPertanggunganTambahan', ['search' => 'all']) }}"
                placeholder="{{ __('Pilih Salah Satu') }}">
                <option value="">{{ __('Pilih Salah Satu') }}</option>
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
					<input
					class="form-control base-plugin--inputmask_currency harga" id="harga" name="harga"
						placeholder="{{ __('Harga') }}">
			</div>
		</div>
	</div>
@endsection

<script>
	$('.modal-dialog').removeClass('modal-md').addClass('modal-lg');
</script>