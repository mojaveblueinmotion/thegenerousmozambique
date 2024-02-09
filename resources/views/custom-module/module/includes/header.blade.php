<div class="row">
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">{{ __('Judul Utama') }}</label>
            <div class="col-sm-8 parent-group">
		        <input type="text" name="title" class="form-control" placeholder="{{ __('Judul Utama') }}">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">{{ __('Status') }}</label>
            <div class="col-sm-8 parent-group">
                <select class="form-control filter-control base-plugin--select2"
                    name="status"
                    data-placeholder="{{ __('Pilih Salah Satu') }}">
                    <option value="">{{ __('Pilih Salah Satu') }}</option>
                    <option value="active">Aktif</option>
                    <option value="nonactive">Nonaktif</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">{{ __('Deskripsi') }}</label>
            <div class="col-sm-10 parent-group">
                <textarea data-height="200" name="description" class="base-plugin--summernote" placeholder="{{ __('Deskripsi') }}"></textarea>
            </div>
        </div>
    </div>
</div>
