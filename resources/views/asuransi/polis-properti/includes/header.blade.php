<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">{{ __('No Asuransi') }}</label>
            <div class="col-sm-8 parent-group ">
                <input type="hidden" value="{{ $record->no_max }}" name="no_max">
                <input type="text" readonly value="{{ $record->no_asuransi }}" name="no_asuransi" class="form-control" placeholder="{{ __('No Asuransi') }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 col-form-label">{{ __('Tanggal') }}</label>
            <div class="col-md-8 parent-group">
                <input disabled type="text" name="tanggal"
                class="form-control base-plugin--datepicker tanggal" 
                data-options='@json([
                    "startDate" => "",
                    "endDate"=> now()->format('d/m/Y')
                ])'
                value="{{ $record->tanggal->format('d/m/Y') }}"
                placeholder="{{ __('Tanggal') }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">{{ __('Agent') }}</label>
            <div class="col-sm-8 parent-group">
                <select disabled required name="agent_id" class="form-control base-plugin--select2-ajax"
                    data-url="{{ route('ajax.selectAgent', 'all') }}" placeholder="{{ __('Pilih Salah Satu') }}">
                    <option value="">{{ __('Pilih Salah Satu') }}</option>
                    @if (!empty($record->agent_id))
                        <option value="{{ $record->agent_id }}" selected>{{ $record->agent->name }}</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">{{ __('Asuransi Perjalanan') }}</label>
            <div class="col-sm-8 parent-group">
                <select disabled required name="asuransi_id" class="form-control base-plugin--select2-ajax"
                    data-url="{{ route('ajax.selectAsuransiPerjalanan', 'all') }}" placeholder="{{ __('Pilih Salah Satu') }}">
                    <option value="">{{ __('Pilih Salah Satu') }}</option>
                    @if (!empty($record->asuransi_id))
                        <option value="{{ $record->asuransi_id }}" selected>{{ $record->asuransi->name }}</option>
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">{{ __('Nama Client') }}</label>
            <div class="col-sm-8 parent-group ">
                <input disabled type="text" name="name" value="{{ $record->name }}" class="form-control" placeholder="{{ __('Nama Client') }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">{{ __('No. Telepon') }}</label>
            <div class="col-sm-8 parent-group ">
                <input disabled type="number" value="{{ $record->phone }}" name="phone" class="form-control" placeholder="{{ __('No. Telepon') }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">{{ __('Email') }}</label>
            <div class="col-sm-8 parent-group ">
                <input disabled type="text" value="{{ $record->email }}" name="email" class="form-control" placeholder="{{ __('Email') }}">
            </div>
        </div>
    </div>
</div>
