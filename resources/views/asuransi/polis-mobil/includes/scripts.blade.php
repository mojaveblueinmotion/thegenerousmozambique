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
			.on('keyup', '.biaya_polis, .biaya_materai, .diskon', function(){
				// var hargaAsuransi = $('.harga_asuransi').val();
				// var hargaRider = $('.harga_rider').val();
				// var hargaPolis = $('.biaya_polis').val();
				// var hargaMaterai = $('.biaya_materai').val();
				// var hargaDiskon = $('.diskon').val();
				
				// console.log(hargaAsuransi);
				// console.log(hargaRider);
				// console.log(hargaPolis);
				// console.log(hargaMaterai);
				// console.log(hargaDiskon);

				// $('.total_harga').val(hargaAsuransi+hargaRider+hargaPolis+hargaMaterai-hargaDiskon);
				// console.log(hargaAsuransi+hargaRider+hargaPolis+hargaMaterai-hargaDiskon);
				var hargaAsuransi = parseFloat($('.harga_asuransi').val().replace(/,/g, ''));
				var hargaRider = parseFloat($('.harga_rider').val().replace(/,/g, ''));
				var hargaPolis = parseFloat($('.biaya_polis').val().replace(/,/g, ''));
				var hargaMaterai = parseFloat($('.biaya_materai').val().replace(/,/g, ''));
				var hargaDiskon = parseFloat($('.diskon').val().replace(/,/g, ''));

				// Check if the parsed values are valid numbers (not NaN)
				if (!isNaN(hargaAsuransi) && !isNaN(hargaRider) && !isNaN(hargaPolis) && !isNaN(hargaMaterai) && !isNaN(hargaDiskon)) {
					var totalHarga = hargaAsuransi + hargaRider + hargaPolis + hargaMaterai - hargaDiskon;
					$('.total_harga').val(totalHarga);
				} else {
					$('.total_harga').val('0');
				}
			});

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
			.on('keyup', '#nilai_modifikasi_detail', function(){
				var total = 0;
				var nilaiMobil = parseInt($('#nilai_mobil').val().replace(/,/g, ''));
				$('.nilai_modifikasi_detail').each(function () {
					total += parseFloat($(this).val().replace(/,/g, ''));
				});

				$('#nilai_pertanggungan').val(total + nilaiMobil);
				$('#nilai_modifikasi').val(total);
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
							console.log(1);
						}else if(response.nilai_pertanggungan != null && response.nilai_pertanggungan !== 0){
							$(ok).val(response.nilai_pertanggungan);
							console.log(response);
						}else if($('#nilai_pertanggungan').val() !== '' && $('#nilai_pertanggungan').val() !== '0' ){
							$(ok).val($('#nilai_pertanggungan').val());
							console.log(3);
						}else{
							alert('Nilai Pertanggungan Tidak Valid!');
							console.log(4);
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
						var hargaAsuransi = $('.harga_asuransi').val();
						var hargaRider = $('.harga_rider').val();
						var hargaPolis = $('.biaya_polis').val();
						var hargaMaterai = $('.biaya_materai').val();
						var hargaDiskon = $('.diskon').val();
						
						$('.total_harga').val(hargaAsuransi+hargaRider+hargaPolis+hargaMaterai-hargaDiskon);
					},
					error: function(a, b, c) {
						console.log(a, b, c);
					}
				});

				
			});

			$('.content-page')
			.on('keyup', '#nilai_mobil, #nilai_modifikasi_detail', function(){
				var total = 0;
				var nilaiMobil = parseInt($('#nilai_mobil').val().replace(/,/g, ''));
				$('.nilai_modifikasi_detail').each(function () {
					total += parseFloat($(this).val().replace(/,/g, ''));
				});

				$('#nilai_pertanggungan').val(total + nilaiMobil);
				var kodeWilayah = null;
				$.ajax({
					method: 'GET',
					url: '{{ url('/ajax/getProvinceById') }}',
					data: {
						province_id: $('.province_id').val(),
					},
					success: function(response, state, xhr) {
						$('#kode_wilayah').val(response.code);
						// persentasi.val(response.code_id);
					},
					error: function(a, b, c) {
						console.log(a, b, c);
					}
				});

				var nilai_pertanggungan = parseInt($('#nilai_pertanggungan').val().replace(/,/g, ''));
				var asuransi_id = $('#asuransi_id').val();
				var persentasi_wilayah;
				$.ajax({
					method: 'GET',
					url: '{{ url('/ajax/getAsuransiPersentasiMobil') }}',
					data: {
						harga: nilai_pertanggungan,
						asuransi_id: asuransi_id,
					},
					success: function(response, state, xhr) {
						if($('#kode_wilayah').val() == 1){
							persentasi_wilayah = response.wilayah_satu_atas;
						}else if($('#kode_wilayah').val() == 1){
							persentasi_wilayah = response.wilayah_dua_atas;
						}else{
							persentasi_wilayah = response.wilayah_tiga_atas;
						}
						$('#persentasi_wilayah').val(persentasi_wilayah);
						// persentasi.val(response.code_id);
					},
					error: function(a, b, c) {
						console.log(a, b, c);
					}
				});
				console.log("Persentasi Wilayah"+ $('#persentasi_wilayah').val());
				console.log("Kode Wilayah"+ $('#kode_wilayah').val());

				var harga_akhir = 0;
				var tanggalAwal = $('#tanggal_asuransi_awal').val().split('/'); // Split the date by '/'
				var tanggalAkhir = $('#tanggal_asuransi_akhir').val().split('/'); // Split the date by '/'
				var tanggalMobil = $("#tahun_mobil option:selected").text() // Split the date by '/'
				// var tanggalAkhirMobil = $('#tanggal_mobil_akhir').val().split('/'); // Split the date by '/'
				var tahun = tanggalAkhir[2] - tanggalAwal[2];
				var tahunMobil = new Date().getFullYear() - tanggalMobil;

				var perkalianMobil = 1;
				if(tahunMobil > 5){
					var loadingMobil = tahunMobil - 5;
					perkalianMobil = (1.0+(5*loadingMobil)/100);
				}

				for (var i = 1; i <= tahun; i++) {
					if (i === 1) {
						harga_akhir += perkalianMobil * nilai_pertanggungan* ($('#persentasi_wilayah').val()/100);
					} else if (i === 2) {
						harga_akhir += perkalianMobil * nilai_pertanggungan * 0.85 * ($('#persentasi_wilayah').val()/100);
					} else if (i === 3) {
						harga_akhir += perkalianMobil * nilai_pertanggungan * 0.75 * ($('#persentasi_wilayah').val()/100);
					} else {
						harga_akhir += perkalianMobil * nilai_pertanggungan * 0.70 * ($('#persentasi_wilayah').val()/100);
					}
				}

				// harga_akhir = harga_akhir * ($('#wilayah_satu_batas_atas').val()/100);

				console.log(perkalianMobil);
				console.log(tahunMobil);
				// console.log(harga_akhir);
				$('#harga_asuransi').val(harga_akhir);
			});
		});
		initExtPart();
		initModPart();
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
			table.find('#total_harga').val();
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

			var hargaAsuransi = $('#harga_asuransi').val();
			var hargaRider = $('#harga_rider').val();
			var hargaPolis = $('#biaya_polis').val();
			var hargaMaterai = $('#biaya_materai').val();
			var hargaDiskon = $('#diskon').val();
			
			$('#total_harga').val(hargaAsuransi+hargaRider+hargaPolis+hargaMaterai-hargaDiskon);
			BasePlugin.initSelect2();
		});
	}

	var initModPart = function () {
		$('.content-page').on('click', '.add-mod-part', function (e) {
			e.preventDefault();
			var me = $(this);
			var tbody = me.closest('table').find('tbody').first();
			var key = tbody.find('tr').last().length ? (tbody.find('tr').last().data('key') + 1) : 1;
			var template = 
			`<tr class="animate__animated animate__fadeIn" data-key="`+key+`">
				<td class="text-center width-20px no">`+key+`</td>
				<td class="text-left parent-group">
					<input name="mod_part[`+key+`][name]"
						class="form-control" id="name"
						placeholder="{{ __('Nama Modifikasi') }}">
				</td>
				<td class="text-left parent-group">
					<input name="mod_part[`+key+`][nilai_modifikasi]"
						class="form-control base-plugin--inputmask_currency nilai_modifikasi_detail" id="nilai_modifikasi_detail"
						placeholder="{{ __('Harga Modifikasi') }}">
				</td>
				<td class="text-center valign-top width-30px">
					<button type="button" class="btn btn-sm btn-icon btn-circle btn-danger remove-mod-part">
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
			BasePlugin.initInputMask();
			BasePlugin.initTimepicker();
		});

		$('.content-page').on('click', '.remove-mod-part', function (e) {
			var me = $(this),
				tbody = me.closest('table').find('tbody').first();

			table = me.closest('tr');
			me.closest('tr').remove();
			tbody.find('.no').each(function (i, val) {
				$(this).html(i+1);
			});
			BasePlugin.initSelect2();
			BasePlugin.initInputMask();
		});
	}
</script>