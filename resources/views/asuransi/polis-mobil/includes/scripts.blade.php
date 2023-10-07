<script>
	$(function () {
		let totalHarga = 0
		$(function () {
			$('.content-page')
			.on('change', '.rider_id', function(){
				var me = $(this),
				table = me.closest('tr');

				var ok = table.find('#persentasi_eksisting');
				$.ajax({
					method: 'GET',
					url: '{{ url('/ajax/getRiderKendaraanMotorPersentasi') }}',
					data: {
						rider_id: $(this).val()
					},
					success: function(response, state, xhr) {
						$(ok).val(response.pembayaran_persentasi);
					},
					error: function(a, b, c) {
						console.log(a, b, c);
					}
				});
			});
		});
		initExtPart();
	});
</script>

<script>
	var initExtPart = function () {
		$('.content-page').on('click', '.add-ext-part', function (e) {
			e.preventDefault();
			var me = $(this);
			var tbody = me.closest('table').find('tbody').first();
			var key = tbody.find('tr').last().length ? (tbody.find('tr').last().data('key') + 1) : 1;
			var template = 
			`<tr class="animate__animated animate__fadeIn" data-key="`+key+`">
				<td class="text-center width-20px no">`+key+`</td>
				<td class="text-left width-200px parent-group">
					<select name="ext_part[`+key+`][rider_id]"
						class="form-control base-plugin--select2-ajax rider_id"
						data-url="{{ route('ajax.selectRiderKendaraan', [
							'search'=>'byAsuransi',
							'asuransi_id'=> $record->asuransi_id,
						]) }}"
						style="width: 200px"
						placeholder="{{ __('Pilih Salah Satu') }}">
						<option value="">{{ __('Pilih Salah Satu') }}</option>
					</select>
				</td>
				<td class="text-left parent-group">
					<input type="text" name="ext_part[`+key+`][persentasi_eksisting]"
						class="form-control" id="persentasi_eksisting" readonly>
				</td>
				<td class="text-center valign-top width-30px">
					<button type="button" class="btn btn-sm btn-icon btn-circle btn-danger remove-ext-part">
						<i class="fa fa-trash"></i>
					</button>
				</td>
			</tr>`;
			tbody.append(template);

			tbody.find('.no').each(function (i, el) {
				$(el).html((i+1));
			});

			if (tbody.find('.remove-detail').length > 1) {
				tbody.find('.remove-detail').prop('disabled', false);
			}

			BasePlugin.initSelect2();
			BasePlugin.initTimepicker();
		});

		$('.content-page').on('click', '.remove-ext-part', function (e) {
			var me = $(this),
				tbody = me.closest('table').find('tbody').first();

			table = me.closest('tr');
			me.closest('tr').remove();
			tbody.find('.no').each(function (i, val) {
				$(this).html(i+1);
			});
			BasePlugin.initSelect2();
		});
	}
</script>