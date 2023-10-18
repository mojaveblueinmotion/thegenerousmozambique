<script>
	$(function () {
		let totalHargaRider = 0
		$(function () {
			$('.content-page')
			.on('change', '.rider_id', function(){
				var me = $(this),
				table = me.closest('tr');

				var ok = table.find('#persentasi_eksisting');
				$.ajax({
					method: 'GET',
					url: '{{ url('/ajax/getRiderKendaraanMobilPersentasi') }}',
					data: {
						rider_id: $(this).val(),
					},
					success: function(response, state, xhr) {
						$(ok).val(response.pembayaran_persentasi);
					},
					error: function(a, b, c) {
						console.log(a, b, c);
					}
				});
			});

			$('.content-page')
			.on('change', '.rider_id', function(){
				var me = $(this),
				table = me.closest('tr');

				var ok = table.find('#harga_pembayaran');
				$.ajax({
					method: 'GET',
					url: '{{ url('/ajax/getHargaPembayaranRider') }}',
					data: {
						rider_id: $(this).val(),
						asuransi_id: $('#idRecord').val(),
					},
					success: function(response, state, xhr) {
						// nilai_mobil
						if(response.harga != null){
							$(ok).val(response.harga);
						}else if(response.nilai_mobil != null){
							$(ok).val(response.nilai_mobil);
						}else if($('#nilai_mobil').val() !== ''){
							$(ok).val($('#nilai_mobil').val());
						}else{
							alert('Nilai Mobil Belum Dimasukkan!');
							$(ok).val(0);
						}

						if(me.val() == 6){
							var harga = null;
							if($(ok).val().replace(/,/g, '') <= 25000000){
								harga = $(ok).val().replace(/,/g, '') * 0.01;
							}
					
							if($(ok).val().replace(/,/g, '') >= 25000000 && $(ok).val().replace(/,/g, '') <= 50000000){
								harga = $(ok).val().replace(/,/g, '') * 0.005;
							}
					
							if($(ok).val().replace(/,/g, '') >= 50000000 && $(ok).val().replace(/,/g, '') <= 50000000){
								harga = $(ok).val().replace(/,/g, '') * 0.0025;
							}
							var total_harga = harga;
						}else if(me.val() == 8){
							var harga = null;
							if($(ok).val().replace(/,/g, '') <= 25000000){
								harga = $(ok).val().replace(/,/g, '') * 0.005;
							}
					
							if($(ok).val().replace(/,/g, '') >= 25000000 && $(ok).val().replace(/,/g, '') <= 50000000){
								harga = $(ok).val().replace(/,/g, '') * 0.0025;
							}
					
							if($(ok).val().replace(/,/g, '') >= 50000000 && $(ok).val().replace(/,/g, '') <= 50000000){
								harga = $(ok).val().replace(/,/g, '') * 0.00125;
							}
							var total_harga = harga;
						}else{
							var total_harga = $(ok).val().replace(/,/g, '') * (table.find('#persentasi_eksisting').val()/100) * 1;
						}
						table.find('#total_harga').val(total_harga);
						var elements = $('[id="total_harga"]');
						var sum = 0;

						// Loop through the selected elements and add their values
						elements.each(function() {
							var value = parseFloat($(this).val().replace(/,/g, '')); // Assuming the values are numeric
							if (!isNaN(value)) {
								sum += value;
							}
						});
						$('#harga_rider').val(sum);
					},
					error: function(a, b, c) {
						console.log(a, b, c);
					}
				});

				
			});

			$('.content-page')
			.on('keyup', '#nilai_mobil', function(){
				var nilai_mobil = parseInt($(this).val().replace(/,/g, ''));

				var harga_akhir = 0;
				var tanggalAwal = $('#tanggal_asuransi_awal').val().split('/'); // Split the date by '/'
				var tanggalAkhir = $('#tanggal_asuransi_akhir').val().split('/'); // Split the date by '/'
				var tahun = tanggalAkhir[2] - tanggalAwal[2];

				for (var i = 1; i <= tahun; i++) {
					if (i === 1) {
						harga_akhir += nilai_mobil* ($('#wilayah_satu_batas_atas').val()/100);
						console.log(harga_akhir);
					} else if (i === 2) {
						harga_akhir += nilai_mobil * 0.85 * ($('#wilayah_satu_batas_atas').val()/100);
						console.log(harga_akhir);
					} else if (i === 3) {
						harga_akhir += nilai_mobil * 0.75 * ($('#wilayah_satu_batas_atas').val()/100);
						console.log(harga_akhir);
					} else {
						harga_akhir += nilai_mobil * 0.70 * ($('#wilayah_satu_batas_atas').val()/100);
						console.log(harga_akhir);
					}
				}

				// harga_akhir = harga_akhir * ($('#wilayah_satu_batas_atas').val()/100);

				console.log(harga_akhir);
				$('#harga_asuransi').val(harga_akhir);
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
				<td class="text-left parent-group">
					<input readonly name="ext_part[`+key+`][persentasi_perkalian]"
						class="form-control" id="persentasi_perkalian"
						placeholder="{{ __('Persentasi Perkalian') }}" value="100">
				</td>
				<td class="text-left parent-group">
					<input readonly name="ext_part[`+key+`][harga_pembayaran]"
						class="form-control base-plugin--inputmask_currency" id="harga_pembayaran"
						placeholder="{{ __('Harga Perkalian') }}">
				</td>
				<td class="text-left parent-group">
					<input readonly name="ext_part[`+key+`][total_harga]"
						class="form-control base-plugin--inputmask_currency" id="total_harga"
						placeholder="{{ __('Total Harga') }}">
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