<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomModule\Module;
use Illuminate\Support\Facades\File;
use App\Models\Master\AsuransiProperti\Okupasi;


class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 
                'title' => "Asuransi Semua Resiko Pendirian",
                'api' => "asuransi-semua-resiko-pendirian",
                'status' => 'active',
                'body' => '[{
                    "id": "",
                    "heading": "",
                    "data": [
                      {
                        "id": 1,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "judul_kontrak",
                        "title": "Judul Kontrak (jika proyek terdiri dari beberapa bagian, sebutkan bagian-bagian yang akan diasuransikan)",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 2,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "lokasi_proyek",
                        "title": "Lokasi proyek",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 3,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_prinsipal",
                        "title": "Nama prinsipal",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 4,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat_prinsipal",
                        "title": "Alamat prinsipal",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 5,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_kontraktor",
                        "title": "Nama kontraktor",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 6,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat_kontraktor",
                        "title": "Alamat kontraktor",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 7,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_subkontraktor",
                        "title": "Nama Subkontraktor",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 8,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat_subkontraktor",
                        "title": "Alamat Subkontraktor",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 9,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_pabrik",
                        "title": "Nama pabrik",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 10,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat_pabrik",
                        "title": "Alamat pabrik",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 11,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_perusahaan",
                        "title": "Nama perusahaan",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 12,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat_perusahaan",
                        "title": "Alamat perusahaan",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 13,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_insinyur",
                        "title": "Nama Insinyur",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 14,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat_insinyur",
                        "title": "Alamat Insinyur",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 15,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "no_pemohon",
                        "title": "No. Pemohon",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 16,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "no_tertanggung",
                        "title": "No. Tertanggung",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 17,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "keterangan",
                        "title": "Keterangan jelas mengenai properti yang akan didirikan",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Periode Asuransi",
                    "data": [
                      {
                        "id": 18,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "awal_periode_asuransi",
                        "title": "Awal periode asuransi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 19,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "lama_prapenyimpanan",
                        "title": "Lamanya pra-penyimpanan",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 20,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "awal_mulai_pekerjaan_pendirian",
                        "title": "Awal mulai pekerjaan pendirian",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 21,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "lama_pekerjaan_pendirian_konstruksi",
                        "title": "Lamanya pekerjaan pendirian/konstruksi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 22,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "lama_pengujian",
                        "title": "Lamanya pengujian",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 23,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "jenis_perlindungan",
                        "title": "Jenis perlindungan yang dibutuhkan",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 24,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "penghentian_asuransi",
                        "title": "Penghentian asuransi",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Apakah rencana, rancangan, dan bahan dengan jenis yang digunakan dalam proyek ini pernah digunakan dan/atau diuji dalam",
                    "data": [
                      {
                        "id": 25,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "pekerjaan_konstruksi_sebelumnya",
                        "title": "Pekerjaan Konstruksi sebelumnya?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 26,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "pekerjaan_konstruksi_kontraktor",
                        "title": "Pekerjaan Konstruksi sebelumnya oleh kontraktor?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 27,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "perluasan",
                        "title": "Apakah ini perluasan dari pabrik yang telah berdiri?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 28,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "status_operasi",
                        "title": "Jika demikian, apakah pengoperasian pabrik yang telah berdiri tetap berlangsung selama periode pendirian?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 29,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "pekerjaan_sipil",
                        "title": "Apakah bangunan dan pekerjaan teknik sipil telah selesai?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 30,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "pekerjaan_subkontraktor",
                        "title": "Pekerjaan apa yang akan dilaksanakan oleh subkontraktor?",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 31,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "resiko_kebakaran",
                        "title": "Apakah ada risiko yang dapat diperburuk oleh kebakaran?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 32,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "resiko_ledakan",
                        "title": "Apakah ada risiko yang dapat diperburuk oleh ledakan?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Tingkat air tanah",
                    "data": [
                      {
                        "id": 33,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_sungai_danau_laut_terdekat",
                        "title": "Nama Sungai, danau, laut terdekat",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 34,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "jarak_dari_lokasi",
                        "title": "Jarak dari lokasi",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Tingkat sungai, danau, laut, dsb",
                    "data": [
                      {
                        "id": 35,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "air_rendah",
                        "title": "Air Rendah",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 36,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "muka_air_rata_rata",
                        "title": "Muka air rata-rata",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 37,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "tingkat_tertinggi_air",
                        "title": "Tingkat tertinggi yang tercatat",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 38,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "muka_air_rata_rata_di_lokasi",
                        "title": "Muka air rata-rata di lokasi",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Kondisi Meteorologi",
                    "data": [
                      {
                        "id": 39,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "musim_hujan_mulai_dari",
                        "title": "Musim hujan mulai dari",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 40,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "musim_hujan_hingga",
                        "title": "Hingga",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": " Curah hujan maks",
                    "data": [
                      {
                        "id": 41,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "curah_hujan_perjam",
                        "title": "Per jam",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 42,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "curah_hujan_perhari",
                        "title": "Per hari",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 43,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "curah_hujan_perbulan",
                        "title": "Per bulan",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 44,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "bahaya_badai",
                        "title": "Bahaya badai",
                        "require": true,
                        "data": [
                          {
                            "value": "Kecil",
                            "label": "Kecil"
                          },
                          {
                            "value": "Sedang",
                            "label": "Sedang"
                          },
                          {
                            "value": "Tinggi",
                            "label": "Tinggi"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 45,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "bahaya_gempa",
                        "title": "Bahaya gempa bumi, gunung berapi, tsunami",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 46,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "riwayat_volkanik",
                        "title": "Apakah ada sejarah terjadinya reaksi gunung berapi, tsunami di lokasi?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 47,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "status_gempa",
                        "title": "Apakah gempa bumi, dsb. pernah teramati di lokasi?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 48,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "bangunan_gempa",
                        "title": "Apakah rancangan bangunan yang diasuransikan didasarkan pada peraturan terkait bangunan tahan gempa bumi?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 49,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "loss_tertinggi",
                        "title": "Jika mungkin, perkirakan kemungkinan kerugian maksimum, yang dinyatakan dalam persentase jumlah yang diasuransikan dalam satu kejadian",
                        "require": true,
                        "data": [
                          {
                            "value": "Karena_gempa_bumi",
                            "label": "Karena gempa bumi"
                          },
                          {
                            "value": "Karena_kebakaran",
                            "label": "Karena kebakaran"
                          },
                          {
                            "value": "Karena_sebab_sebab_lain_(harap_sebutkan)",
                            "label": "Karena sebab-sebab lain (harap sebutkan)"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 50,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "perlindungan_peralatan",
                        "title": "Apakah perlindungan peralatan konstruksi/pendirian (perancah, pemondokan, perkakas, dsb.) diperlukan?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 51,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "deskripsi_pernyataan",
                        "title": "Harap berikan keterangan singkat dan nyatakan nilai penggantian baru berdasarkan Peralatan konstruksi/pendirian",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 52,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "perlindungan_mesin",
                        "title": "Apakah perlindungan mesin konstruksi/pendirian (ekskavator, crane, dsb.) diperlukan?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 53,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "perlindungan_sekitaran",
                        "title": "Apakah bangunan yang sudah berdiri dan/atau struktur yang ada pada atau berdampingan dengan lokasi, dimiliki oleh atau berada dalam kuasa, pengawasan atau pengendalian Prinsipal atau Kontraktor yang akan diasuransikan terhadap kehilangan atau kerusakan yang diakibatkan dari atau yang terkait dengan pekerjaan Kontrak? Nyatakan batas berdasarkan Properti yang berada di tempat prinsipal atau di lokasi miliki prinsipal atau dibawah perawatan, pengawasan, pengendalian",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 54,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "deskripsi_sekitaran",
                        "title": "Jika demikian, berikan keterangan yang tepat mengenai bangunan-bangunan/struktur-struktur ini.",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 55,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "tanggung_jawab_pihak_ketiga",
                        "title": "Apakah tanggung jawab terhadap pihak ketiga yang akan disertakan?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 56,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "deskripsi_pihak_ketiga",
                        "title": "Jika demikian, berikan keterangan ringkas mengenai bangunan dan/atau konstruksi disekitar yang bukan merupakan milik prinsipal atau kontraktor (lampirkan peta, jika memungkinkan). Nyatakan batas pertanggungan pada KEWAJIBAN PIHAK KETIGA",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Apakah anda berkeinginan perlindungan termasuk biaya tambahan (dalam hal terjadinya kerugian) untuk",
                    "data": [
                      {
                        "id": 57,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "perlindungan_libur",
                        "title": "Pengiriman cepat, kerja lembur, kerja pada malam hari, kerja di hari libur nasional",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 58,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "perlindungan_udara",
                        "title": "Pengiriman lewat udara",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 59,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "deskripsi_perlindungan",
                        "title": "Berikan keterangan rinci mengenai setiap perluasan perlindungan khusus yang diperlukan",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 60,
                        "type": "money",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "jumlah_diasuransikan",
                        "title": "Nyatakan disini jumlah yang anda ingin asuransikan dan batas ganti rugi yang diperlukan",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  }]'
            ],
            [
                'title' => "Asuransi Pembuatan Kapal Laut",
                'api' => "asuransi-pembuatan-kapal-laut",
                'status' => 'active',
                'body' => '[{
                    "id": "",
                    "heading": "",
                    "data": [
                      {
                        "id": 1,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_lengkap",
                        "title": "Nama Lengkap Pemohon",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 2,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat",
                        "title": "Alamat",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 3,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_kreditur",
                        "title": "Nama Kreditur atau Pihak Berkepentingan lainnya",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 4,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat_kreditur",
                        "title": "Alamat Kreditur atau Pihak Berkepentingan lainnya",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 5,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "detail_kepentingan",
                        "title": "Sebutkan kepentingan mereka (Memberikan pinjaman, Penyewa, Penyedia Subsidi, dsb.)",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 6,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "lokasi_yard",
                        "title": "Lokasi Galangan Kapal",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 7,
                        "type": "money",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nilai_maks_yard",
                        "title": "Nilai Maksimum saat pembuatan di galangan, setiap satu waktu",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 8,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "konstruksi_bangunan",
                        "title": "Konstruksi Bangunan",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 9,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "deskripsi_keamanan",
                        "title": "Keterangan Keamanan/Alarm",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 10,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "deskripsi_kebakaran",
                        "title": "Keterangan Fasilitas Pemadam Kebakaran",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 11,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "jenis_kapal",
                        "title": "Jenis Kapal yang Normalnya Dibuat",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 12,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "keterangan_yard",
                        "title": "Keterangan Rinci Galangan termasuk tempat peluncuran kapal, cranes, Travel Lifts, dsb.",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 13,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "status_subkontraktor",
                        "title": "Apakah Subkontraktor Digunakan?",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 14,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "perlindungan_subkontraktor",
                        "title": "Apakah mereka memiliki perlindungan yang memadai?",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 15,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "jadwal_pembangunan",
                        "title": "Mohon berikan Bagan Kemajuan/Jadwal Pembangunan Kapal",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 16,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "cara_peluncuran",
                        "title": "Bagaimana cara Kapal Diluncurkan?",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 17,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "tempat_uji",
                        "title": "Tempat & Jenis uji coba laut yang akan dilakukan",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 18,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "detail_transportasi",
                        "title": "Rincian lengkap Transportasi, Pemuatan, Jarak dll. jika diluncurkan diluar dari lokasi galangan",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 19,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "ketersediaan_survey",
                        "title": "Ketersediaan survei galangan kapal, pencegahan kebakaran, jaminan mutu, biro klasifikasi",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Periode Konstruksi",
                    "data": [
                      {
                        "id": 20,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "tanggal_awal",
                        "title": "Periode Konstruksi -Tanggal Mulai:",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 21,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "tanggal_akhir",
                        "title": "Perkiraan Tanggal Penyelesaian (misal: tanggal penyerahan)",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 22,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "jenis_kapal_dibuat",
                        "title": "Jenis Kapal yang Dibuat",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 23,
                        "type": "money",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "perkiraan_nilai",
                        "title": "Perkiraan Nilai Kapal saat selesai dibangun",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 24,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "metode_konstruksi",
                        "title": "Metode Konstruksi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 25,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "material_konstruksi",
                        "title": "Bahan Konstruksi yang digunakan/Peralatan yang akan dipasang",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Dimensi",
                    "data": [
                      {
                        "id": 26,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "panjang",
                        "title": "Panjang",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 27,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "berat",
                        "title": "Berat",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 28,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "status_penerimaan",
                        "title": "Apakah kapal yang akan dibangun berdasarkan survei?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap pilih"
                      },
                      {
                        "id": 29,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "keterangan_penerimaan",
                        "title": "Jika “Ya”, sebutkan biro klasifikasi atau otoritas",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 30,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "lama_perusahaan",
                        "title": "Sudah berapa lama perusahaan didirikan?",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 31,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "tahun_pengalaman",
                        "title": "Berapa tahun pengalaman dalam pembuatan jenis kapal tertentu",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 32,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "kualifikasi_tim",
                        "title": "Kualifikasi tim teknis/operasional, dll",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 33,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "status_klaim",
                        "title": "Catatan klaim selama lima (5) tahun terakhir (termasuk insiden yang dilaporkan dan klaim yang tidak dibayar) Sertakan nama kapal",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 34,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "jatuh_tempo",
                        "title": "Tanggal jatuh tempo asuransi saat ini",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 35,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_perusahaan_asuransi",
                        "title": "Nama perusahaan asuransi sekarang",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 36,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "status_penolakan",
                        "title": "Apakah ada perusahaan asuransi yang menolak asuransi atau mengenakan syarat khusus untukpembuatan kapal Anda di masa lalu?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap pilih"
                      },
                      {
                        "id": 37,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "keterangan_penolakan",
                        "title": "Jika “Ya”, harap berikan keterangan rinci",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 38,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "deskripsi_survey",
                        "title": "Harap berikan keterangan rinci mengenai setiap informasi tambahan yang berkaitan dengan resiko yang diusulkan dan secara khusus semua survey",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  }]'
            ],
            [
                'title' => "Asuransi Kontraktor",
                'api' => "asuransi-kontraktor",
                'status' => 'active',
                'body' => '[{
                    "id": "",
                    "heading": "",
                    "data": [
                      {
                        "id": 1,
                        "type": "string",
                        "informationStatus": true,
                        "informationMsg": "Judul Kontrak (jika proyek terdiri dari beberapa bagian, sebutkan bagian-bagian yang akan diasuransikan)",
                        "key": "judul_kontrak",
                        "title": "Judul Kontrak (jika proyek terdiri dari beberapa bagian, sebutkan bagian-bagian yang akan diasuransikan)",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 2,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "lokasi_proyek",
                        "title": "Lokasi Proyek",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 3,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_prinsipal",
                        "title": "Nama prinsipal",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 4,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat_prinsipal",
                        "title": "Alamat Prinsipal",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 5,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_kontraktor",
                        "title": "Nama Kontraktor",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 6,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat_kontraktor",
                        "title": "Alamat Kontraktor",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 7,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_subkontraktor",
                        "title": "Nama Sub Kontraktor",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 8,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat_subkontraktor",
                        "title": "Alamat Sub Kontraktor",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 9,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "nama_insinyur",
                        "title": "Nama Insinyur",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 10,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "alamat_insinyur",
                        "title": "Alamat Insinyur",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Dimensi (panjang, tinggi, kedalaman, rentang, jumlah lantai)",
                    "data": [
                      {
                        "id": 11,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "lebar_dimensi",
                        "title": "Lebar Dimensi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 12,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "tinggi_dimensi",
                        "title": "Tinggi Dimensi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 13,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "kedalaman_dimensi",
                        "title": "Kedalaman Dimensi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 14,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "rentang_dimensi",
                        "title": "Rentang Dimensi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 15,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "jumlah_lantai",
                        "title": "Jumlah Lantai",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 16,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "metode_konstruksi",
                        "title": "Metode Konstruksi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 17,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "jenis_pondasi",
                        "title": "Jenis Pondasi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 18,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "bahan_konstruksi",
                        "title": "Bahan Konstruksi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 19,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "kontraktor_berpengalaman",
                        "title": "Kontraktor Berpengalaman?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 20,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "awal_periode",
                        "title": "Tanggal Mulai",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 21,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "lama_proses_konstruksi",
                        "title": "Lama Periode Kontruksi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 22,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "tanggal_penyelesaian",
                        "title": "Tanggal Penyelesaian",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 23,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "periode_pemeliharaan",
                        "title": "Periode Pemeliharaan",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 24,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "pekerjaan_subkontraktor",
                        "title": "Pekerjaan apa yang akan dilakukan oleh subkontraktor?",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Risiko khusus",
                    "data": [
                      {
                        "id": 25,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "fire_explosion",
                        "title": "Kebakaran, ledakan?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 26,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "flood_inundation",
                        "title": "Banjir, genangan?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 27,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "landslide_storm_cyclone",
                        "title": "Tanah longsor, badai, topan?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 28,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "blasting_work",
                        "title": "Pekerjaan peledakan?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Risiko khusus",
                    "data": [
                      {
                        "id": 29,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "volcanic_tsunami",
                        "title": "Letusan Gunung berapi, tsunami?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 30,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "skala_mercalli",
                        "title": "Jika demikian, harap sebutkan intensitasnya (skala mercalli)",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 31,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "observed_earthquake",
                        "title": "Apakah gempa bumi pernah diketahui di area ini?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 32,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "magnitude",
                        "title": "magnitude (Richter)",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 33,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "regulasi_struktur",
                        "title": "Apakah rancangan bangunan yang akan diasuransikan didasarkan pada peraturan terkait bangunan tahan gempa bumi",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 34,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "standar_rancangan",
                        "title": "Apakah standar rancangan lebih tinggi dari pada yang ditetapkan dalam peraturan terkait?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 35,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "detail_subsoil_id",
                        "title": "Keterangan rinci lapisan bawah tanah",
                        "require": true,
                        "data": [
                          {
                            "value": "Batuan",
                            "label": "Batuan"
                          },
                          {
                            "value": "Kerikil",
                            "label": "Kerikil"
                          },
                          {
                            "value": "Pasir",
                            "label": "Pasir"
                          },
                          {
                            "value": "Tanah_Liat",
                            "label": "Tanah Liat"
                          },
                          {
                            "value": "Lahan_Urukan",
                            "label": "Lahan Urukan"
                          },
                          {
                            "value": "Lainnya",
                            "label": "Lainnya"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 36,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "patahan_geologi",
                        "title": "Adakah patahan geologis di sekitar lokasi?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Sungai, danau, laut terdekat",
                    "data": [
                      {
                        "id": 37,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "perairan_terdekat",
                        "title": "Nama",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 38,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "jarak_perairan",
                        "title": "Jarak dari lokasi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 39,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "level_air",
                        "title": "Level Air",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 40,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "rata_rata_air",
                        "title": "Muka air rata-rata",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 41,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "tingkat_tertinggi_air",
                        "title": "Tingkat tertinggi yang tercatat",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 42,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "tanggal",
                        "title": "Tanggal",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  },
                  {
                    "id": "",
                    "heading": "Kondisi Meteorologi",
                    "data": [
                      {
                        "id": 43,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "musim_hujan_awal",
                        "title": "Musim hujan mulai dari",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 44,
                        "type": "date",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "musim_hujan_akhir",
                        "title": "Musim hujan hingga",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 45,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "curah_hujan_perjam",
                        "title": "Curah hujan maks Per jam",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 46,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "curah_hujan_perhari",
                        "title": "Curah hujan maks Per hari",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 47,
                        "type": "integer",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "curah_hujan_perbulan",
                        "title": "Curah hujan maks Per bulan",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 48,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "bahaya_badai",
                        "title": "Bahaya badai?",
                        "require": true,
                        "data": [
                          {
                            "value": "kecil",
                            "label": "Kecil"
                          },
                          {
                            "value": "sedang",
                            "label": "Sedang"
                          },
                          {
                            "value": "tinggi",
                            "label": "Tinggi"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 49,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "biaya_tambahan_lembur",
                        "title": "Apakah biaya tambahan untuk kerja lembur, kerja pada hari libur nasional dimasukkan?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 50,
                        "type": "money",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "batas_ganti_rugi_lembur",
                        "title": "Batas ganti rugi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 51,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "tanggung_jawab_pihak_ketiga",
                        "title": "Apakah tanggung jawab huhum terhadap pihak ketiga akan dimasukkan?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 52,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "asuransi_terpisah_tpl",
                        "title": "Apakah kontraktor telah meiliki polis Asuransi terpisah untuk TPL",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 53,
                        "type": "money",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "batas_ganti_rugi_pihak_ketiga",
                        "title": "Batas ganti rugi",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 54,
                        "type": "string",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "rincian_bangunan",
                        "title": "Keterangan rinci mengenai bangunan yang sudah berdiri atau harta benda di area sekitar yang mungkin terdampak oleh pekerjaan dalam kontrak (penggalian, penunjangan, pembuatan pancang, getaran, penurunan air tanah, dsb.)",
                        "require": true,
                        "error": "Harap isi"
                      },
                      {
                        "id": 55,
                        "type": "select",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "status_struktur_bangunan",
                        "title": "Apakah bangunan yang sudah berdiri dan/atau struktur yang ada pada atau berdampingan dengan lokasi, dimiliki oleh atau berada dalam kuasa, pengawasan atau pengendalian Prinsipal atau Kontraktor akan diasuransikan terhadap kehilangan atau kerususakan yang diakibatkan secara langsung atau tidak langsung dari pekerjaan dalam kontrak?",
                        "require": true,
                        "data": [
                          {
                            "value": "ya",
                            "label": "Ya"
                          },
                          {
                            "value": "tidak",
                            "label": "Tidak"
                          }
                        ],
                        "error": "Harap isi"
                      },
                      {
                        "id": 56,
                        "type": "money",
                        "informationStatus": false,
                        "informationMsg": "",
                        "key": "batas_ganti_rugi_struktur_bangunan",
                        "title": "Batas ganti rugi",
                        "require": true,
                        "error": "Harap isi"
                      }
                    ]
                  }]'
            ],

        ];

        foreach ($data as $val) {
            $record          = Module::firstOrNew(['title' => $val['title']]);
            $record->api = $val['api'] ?? null;
            $record->status = $val['status'] ?? 0;
            $record->save();

            $detail = $record->details()->firstOrNew([
                'module_id' => $record->id,
            ]);
            $detail->data = json_encode($val);;
            
            $detail->save();
        }
    }
}
