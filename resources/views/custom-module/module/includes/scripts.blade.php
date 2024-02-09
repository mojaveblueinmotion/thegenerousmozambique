<script>
	$(function () {
		handleExtPartDetails();
		handleExtPart()
	});
</script>
<script>
	var handleExtPart = function () {
    $('.content-page').on('click', '.add-ext-part', function (e) {
        var me = $(this);
        var tbody = me.closest('table').find('tbody').first();

		// var keys = tbody.find('tr').length ? (parseInt(tbody.find('tr').last().data('keys')) + 1) : 1;

        // var keys = tbody.find('tr').length ? (tbody.find('tr').last().data('keys') + 1) : 1;
        var key = 1;

		var keys = parseInt(tbody.find('.no').last().html()) + 1;
        var template = `
        <tr data-keys="`+ keys + `" id="trParent">
            <td class="text-center width-40px no">` + keys + `</td>
            <td class="parent-group text-left">
                <div class="input-group" style="display:flex;">
                    <div class="parent-group" style="width:30%%;">
                        <input type="text" name="details[`+ keys +`][title_number]"
                        class="form-control"
                        placeholder="{{ __('Penomoran') }}">
                    </div>
                    <div class="parent-group" style="width:80%;">
                        <input type="text" name="details[`+ keys +`][title]"
                        class="form-control"
                        placeholder="{{ __('Judul') }}">
                    </div>
                </div>
            </td>
            <td class="text-center valign-top width-30px">
                <button type="button" class="btn btn-sm btn-icon btn-circle btn-danger remove-ext-part">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table data-keys="`+ keys + `" class="table table-bordered" id="detailsBody`+ keys +`">
                    <thead>
                        <tr>
                            <th class="text-center width-80px">{{ __('No') }}</th>
                            <th class="text-center">{{ __('Tipe Kolom') }}</th>
                            <th class="text-center">{{ __('Data') }}</th>
                            <th class="text-center">{{ __('Kosong?') }}</th>
                            <th class="text-center">{{ __('Judul') }}</th>
                            <th class="text-center">{{ __('Information') }}</th>
                            <th class="text-center valign-top width-30px">
                                <button type="button" class="btn btn-sm btn-icon btn-circle btn-primary add-ext-part-details"><i class="fa fa-plus"></i></button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-parent="`+ keys + `" data-key="`+ key + `">
                            <td class="text-left parent-group">
                                <input type="text" name="details[`+ keys + `][`+ key + `][numbering]"
                                    class="form-control"
                                    placeholder="{{ __('No') }}">
                            </td>
                            <td class="text-left parent-group">
                                <select class="form-control filter-control base-plugin--select2"
                                    name="details[`+ keys + `][`+ key + `][type]"
                                    data-placeholder="{{ __('Pilih Salah Satu') }}">
                                    <option value="">{{ __('Pilih Salah Satu') }}</option>
                                    <option value="multiselect">Pilihan Multi</option>
                                    <option value="date">Tanggal</option>
                                    <option value="select">Pilihan</option>
                                    <option value="integer">Angka</option>
                                    <option value="string">Teks Singkat</option>
                                    <option value="textarea">Teks</option>
                                </select>
                            </td>
                            <td class="text-left parent-group">
                                <textarea id="summernote-disabled" name="details[`+ keys + `][`+ key + `][value]" class="base-plugin--summernote-2" placeholder="{{ __('Data') }}"></textarea>
                            </td>
                            <td class="text-left parent-group">
                                <select class="form-control filter-control base-plugin--select2"
                                    name="details[`+ keys + `][`+ key + `][required]"
                                    data-placeholder="{{ __('Pilih Salah Satu') }}">
                                    <option value="">{{ __('Pilih Salah Satu') }}</option>
                                    <option value="null">Boleh Kosong</option>
                                    <option value="required">Wajib Diisi</option>
                                </select>
                            </td>
                            <td class="text-left parent-group">
                                <input type="text" name="details[`+ keys + `][`+ key + `][title]"
                                    class="form-control"
                                    placeholder="{{ __('Judul') }}">
                            </td>
                            <td class="text-left parent-group">
                                <textarea data-height="200" name="details[`+ keys + `][`+ key + `][information]" class="form-control" placeholder="{{ __('Informasi') }}"></textarea>
                            </td>
                            <td class="text-center valign-top width-30px">
                                <button type="button" class="btn btn-sm btn-icon btn-circle btn-danger remove-ext-part-details">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        `;
        tbody.append(template);
        BasePlugin.initSelect2();
        BasePlugin.initSummernote();
    });

    $('.content-page').on('click', '.remove-ext-part', function (e) {
		var me = $(this);
		var tbody = me.closest('table').find('tbody').first();
		var table = me.closest('table');

		me.closest('tr').next('tr').find('tr').remove();
		me.closest('tr').next('tr').find('td').remove();
		me.closest('tr').next('tr').find('tbody').remove();
		me.closest('tr').next('tr').find('thead').remove();
		me.closest('tr').remove();

		// Check if there are no more rows in the tbody, then remove the thead too
		if (tbody.find('tr').length === 0) {
			table.find('thead').remove();
		}
		tbody.find('.no').each(function (i, val) {
			$(this).html(i+1);
		});
	});

}

var handleExtPartDetails = function () {
    $('.content-page').on('click', '.add-ext-part-details', function (e) {
        var me = $(this);
        var tbody = me.closest('table').find('tbody').first();
        var key = tbody.find('tr').length ? (tbody.find('tr').last().data('key') + 1) : 1;
		var keys = parseInt(me.closest('table').data('keys'));

        var template = `
            <tr data-parent="`+ keys + `" data-key="`+ key + `">
                <td class="text-left parent-group">
                    <input type="text" name="details[`+ keys + `][`+ key + `][numbering]"
                        class="form-control"
                        placeholder="{{ __('No') }}">
                </td>
                <td class="text-left parent-group">
                    <select class="form-control filter-control base-plugin--select2"
                        name="details[`+ keys + `][`+ key + `][type]"
                        data-placeholder="{{ __('Pilih Salah Satu') }}">
                        <option value="">{{ __('Pilih Salah Satu') }}</option>
                        <option value="multiselect">Pilihan Multi</option>
                        <option value="date">Tanggal</option>
                        <option value="select">Pilihan</option>
                        <option value="integer">Angka</option>
                        <option value="string">Teks Singkat</option>
                        <option value="textarea">Teks</option>
                    </select>
                </td>
                <td class="text-left parent-group">
                    <textarea id="summernote-disabled" name="details[`+ keys + `][`+ key + `][value]" class="base-plugin--summernote-2" placeholder="{{ __('Data') }}"></textarea>
                </td>
                <td class="text-left parent-group">
                    <select class="form-control filter-control base-plugin--select2"
                        name="details[`+ keys + `][`+ key + `][required]"
                        data-placeholder="{{ __('Pilih Salah Satu') }}">
                        <option value="">{{ __('Pilih Salah Satu') }}</option>
                        <option value="null">Boleh Kosong</option>
                        <option value="required">Wajib Diisi</option>
                    </select>
                </td>
                <td class="text-left parent-group">
                    <input type="text" name="details[`+ keys + `][`+ key + `][title]"
                        class="form-control"
                        placeholder="{{ __('Judul') }}">
                </td>
                <td class="text-left parent-group">
                    <textarea data-height="200" name="details[`+ keys + `][`+ key + `][information]" class="form-control" placeholder="{{ __('Informasi') }}"></textarea>
                </td>
                <td class="text-center valign-top width-30px">
                    <button type="button" class="btn btn-sm btn-icon btn-circle btn-danger remove-ext-part-details">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        tbody.append(template);
        BasePlugin.initSelect2();
        BasePlugin.initSummernote();
    });

    $('.content-page').on('click', '.remove-ext-part-details', function (e) {
        var me = $(this);
		// console.log(key)
        var tbody = me.closest('table').find('tbody').first();

        me.closest('tr').remove();
		
    });
}

// Call the functions

</script>