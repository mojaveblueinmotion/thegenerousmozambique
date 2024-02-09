<?php

return [
    [
        'section'   => 'NAVIGASI',
        'name'      => 'navigasi',
        'perms'     => 'dashboard',
    ],
    // Dashboard
    [
        'name'  => 'dashboard',
        'perms' => 'dashboard',
        'title' => 'Dashboard',
        'icon'  => 'fa fa-th-large',
        'url'   => '/home',
    ],
    // Asuransi Mobil
    [
        'name' => 'asuransi',
        'title' => 'Asuransi',
        'icon' => 'fa fa-tags',
        'submenu' => [
                [
                    'name'  => 'asuransi.polis-mobil',
                    'perms' => 'asuransi.polis-mobil',
                    'title' => 'Asuransi Mobil',
                    'url'   => '/asuransi/polis-mobil',
                ],
                [
                    'name'  => 'asuransi.polis-motor',
                    'perms' => 'asuransi.polis-motor',
                    'title' => 'Asuransi Motor',
                    'url'   => '/asuransi/polis-motor',
                ],
                [
                    'name'  => 'asuransi.polis-properti',
                    'perms' => 'asuransi.polis-properti',
                    'title' => 'Asuransi Properti',
                    'url'   => '/asuransi/polis-properti',
                ],
                [
                    'name'  => 'asuransi.polis-perjalanan',
                    'perms' => 'asuransi.polis-perjalanan',
                    'title' => 'Asuransi Perjalanan',
                    'url'   => '/asuransi/polis-perjalanan',
                ],
        ],
    ],
    [
        'name' => 'custom-module',
        'title' => 'Custom Asuransi',
        'icon' => 'fa fa-plus',
        'submenu' => [
                [
                    'name'  => 'custom-module.module',
                    'perms' => 'custom-module.module',
                    'title' => 'Custom Module',
                    'url'   => '/custom-module/module',
                ],
        ],
    ],
    // Admin Console
    [
        'section' => 'ADMIN KONSOL & MASTER',
        'name' => 'console.admin',
    ],
    [
        'name' => 'master',
        'perms' => 'master',
        'title' => 'Data Umum Asuransi',
        'icon' => 'fa fa-book',
        'submenu' => [
            [
                'name' => 'kategori-asuransi',
                'title' => 'Kategori Asuransi',
                'url' => '/master/data-asuransi/kategori-asuransi',
            ],
            [
                'name' => 'perusahaan-asuransi',
                'title' => 'Perusahaan Asuransi',
                'url' => '/master/data-asuransi/perusahaan-asuransi',
            ],
            [
                'name' => 'interval-pembayaran',
                'title' => 'Interval Pembayaran',
                'url' => '/master/data-asuransi/interval-pembayaran',
            ],
            [
                'name' => 'fitur-asuransi',
                'title' => 'Fitur Asuransi',
                'url' => '/master/data-asuransi/fitur-asuransi',
            ],
            [
                'name' => 'pertanggungan-tambahan',
                'title' => 'Pertanggungan Tambahan',
                'url' => '/master/data-asuransi/pertanggungan-tambahan',
            ],
            [
                'name' => 'rider-kendaraan-lainnya',
                'title' => 'Rider Kendaraan Lainnya',
                'url' => '/master/data-asuransi/rider-kendaraan-lainnya',
            ],
        ],
    ],
    [
        'name' => 'master',
        'perms' => 'master',
        'title' => 'Data Kendaraan',
        'icon' => 'fa fa-car',
        'submenu' => [
            [
                'name' => 'database-mobil',
                'title' => 'Database Mobil',
                'url' => '',
                'submenu' => [
                    [
                        'name' => 'merk',
                        'title' => 'Merk Mobil',
                        'url' => '/master/database-mobil/merk'
                    ],
                    [
                        'name' => 'seri',
                        'title' => 'Seri Mobil',
                        'url' => '/master/database-mobil/seri'
                    ],
                    [
                        'name' => 'tahun',
                        'title' => 'Tahun Mobil',
                        'url' => '/master/database-mobil/tahun'
                    ],
                    [
                        'name' => 'tipe-mobil',
                        'title' => 'Tipe Mobil',
                        'url' => '/master/database-mobil/tipe-mobil'
                    ],
                ]
            ],
            [
                'name' => 'database-motor',
                'title' => 'Database Motor',
                'url' => '',
                'submenu' => [
                    [
                        'name' => 'merk',
                        'title' => 'Merk Motor',
                        'url' => '/master/asuransi-motor/merk'
                    ],
                    [
                        'name' => 'seri',
                        'title' => 'Seri Motor',
                        'url' => '/master/asuransi-motor/seri'
                    ],
                    [
                        'name' => 'tahun',
                        'title' => 'Tahun Motor',
                        'url' => '/master/asuransi-motor/tahun'
                    ],
                    [
                        'name' => 'tipe-motor',
                        'title' => 'Tipe Motor',
                        'url' => '/master/asuransi-motor/tipe-motor'
                    ],
                ]
            ],
            [
                'name' => 'database-kendaraan-umum',
                'title' => 'Database Kendaraan Umum',
                'url' => '',
                'submenu' => [
                    [
                        'name' => 'kode-plat',
                        'title' => 'Kode Plat',
                        'url' => '/master/database-mobil/kode-plat'
                    ],
                    [
                        'name' => 'tipe-kendaraan',
                        'title' => 'Tipe Kendaraan',
                        'url' => '/master/database-mobil/tipe-kendaraan'
                    ],
                    [
                        'name' => 'tipe-pemakaian',
                        'title' => 'Tipe Pemakaian',
                        'url' => '/master/asuransi-mobil/tipe-pemakaian'
                    ],
                    [
                        'name' => 'luas-pertanggungan',
                        'title' => 'Luas Pertanggungan',
                        'url' => '/master/asuransi-mobil/luas-pertanggungan'
                    ],
                    [
                        'name' => 'kondisi-kendaraan',
                        'title' => 'Kondisi Kendaraan',
                        'url' => '/master/asuransi-mobil/kondisi-kendaraan'
                    ],
                    [
                        'name' => 'workshop',
                        'title' => 'Workshop',
                        'url' => '/master/asuransi-mobil/workshop'
                    ],
                ]
            ],
        ],
    ],
    [
        'name' => 'master',
        'perms' => 'master',
        'title' => 'Data Master',
        'icon' => 'fa fa-database',
        'submenu' => [
            [
                'name' => 'org',
                'title' => 'Struktur Organisasi',
                'url' => '',
                'submenu' => [
                    [
                        'name' => 'root',
                        'title' => 'Root',
                        'url' => '/master/org/root'
                    ],
                    // [
                    //     'name' => 'boc',
                    //     'title' => 'Pengawas',
                    //     'url' => '/master/org/boc',
                    // ],
                    [
                        'name' => 'bod',
                        'title' => 'Direksi',
                        'url' => '/master/org/bod',
                    ],
                    [
                        'name' => 'division',
                        'title' => 'Divisi',
                        'url' => '/master/org/division',
                    ],
                    [
                        'name' => 'department',
                        'title' => 'Departemen',
                        'url' => '/master/org/department',
                    ],
                    [
                        'name' => 'unit-bisnis',
                        'title' => 'Unit Bisnis',
                        'url' => '/master/org/unit-bisnis',
                    ],
                    [
                        'name' => 'position',
                        'title' => 'Jabatan',
                        'url' => '/master/org/position',
                    ],
                ]
            ],
            [
                'name' => 'geography',
                'title' => 'Geografis',
                'url' => '',
                'submenu' => [
                    [
                        'name' => 'province',
                        'title' => 'Provinsi',
                        'url' => '/master/geo/province'
                    ],
                    [
                        'name' => 'city',
                        'title' => 'Kota / Kabupaten',
                        'url' => '/master/geo/city'
                    ],
                    // [
                    //     'name' => 'district',
                    //     'title' => 'Kecamatan',
                    //     'url' => '/master/geo/district'
                    // ],
                    // [
                    //     'name' => 'village',
                    //     'title' => 'Desa',
                    //     'url' => '/master/geo/village'
                    // ],
                ]
            ],
            [
                'name' => 'asuransi-properti',
                'title' => 'Asuransi Properti',
                'url' => '',
                'submenu' => [
                    [
                        'name' => 'perlindungan-properti',
                        'title' => 'Perlindungan Properti',
                        'url' => '/master/asuransi-properti/perlindungan-properti'
                    ],
                    [
                        'name' => 'konstruksi-properti',
                        'title' => 'Konstruksi Properti',
                        'url' => '/master/asuransi-properti/konstruksi-properti'
                    ],
                    [
                        'name' => 'kelas-bangunan',
                        'title' => 'Kelas Bangunan',
                        'url' => '/master/asuransi-properti/kelas-bangunan'
                    ],
                    [
                        'name' => 'surrounding-risk',
                        'title' => 'Surrounding Risk',
                        'url' => '/master/asuransi-properti/surrounding-risk'
                    ],
                    [
                        'name' => 'okupasi',
                        'title' => 'Okupasi',
                        'url' => '/master/asuransi-properti/okupasi'
                    ],
                    [
                        'name' => 'asuransi-properti',
                        'title' => 'Asuransi Properti',
                        'url' => '/master/asuransi-properti/asuransi-properti'
                    ],
                ]
            ],
            [
                'name' => 'asuransi-kontraktor',
                'title' => 'Asuransi Kontraktor',
                'url' => '',
                'submenu' => [
                    [
                        'name' => 'subsoil',
                        'title' => 'Subsoil',
                        'url' => '/master/asuransi-kontraktor/subsoil'
                    ],
                    [
                        'name' => 'item-kontraktor',
                        'title' => 'Item Kontraktor',
                        'url' => '/master/asuransi-kontraktor/item-kontraktor'
                    ],
                ]
            ],
            [
                'name' => 'asuransi-erection',
                'title' => 'Asuransi Erection',
                'url' => '',
                'submenu' => [
                    [
                        'name' => 'item-erection',
                        'title' => 'Item Erection',
                        'url' => '/master/asuransi-erection/item-erection'
                    ],
                ]
            ],

            [
                'name' => 'asuransi-mobil',
                'title' => 'Asuransi Mobil',
                'url' => '',
                'submenu' => [
                    // [
                    //     'name' => 'mobil',
                    //     'title' => 'Mobil',
                    //     'url' => '/master/asuransi-mobil/mobil'
                    // ],
                    // [
                    //     'name' => 'tipe-kendaraan',
                    //     'title' => 'Tipe Kendaraan',
                    //     'url' => '/master/asuransi-mobil/tipe-kendaraan'
                    // ],
                    [
                        'name' => 'rider-kendaraan',
                        'title' => 'Rider Mobil',
                        'url' => '/master/data-asuransi/rider-kendaraan',
                    ],
                    [
                        'name' => 'asuransi-mobil',
                        'title' => 'Asuransi Mobil',
                        'url' => '/master/asuransi-mobil/asuransi-mobil'
                    ],
                ]
            ],
            
            [
                'name' => 'asuransi-motor',
                'title' => 'Asuransi Motor',
                'url' => '',
                'submenu' => [
                    [
                        'name' => 'rider-motor',
                        'title' => 'Rider Motor',
                        'url' => '/master/asuransi-motor/rider-motor',
                    ],
                    [
                        'name' => 'asuransi-motor',
                        'title' => 'Asuransi Motor',
                        'url' => '/master/asuransi-motor/asuransi-motor'
                    ],
                ]
            ],
            [
                'name' => 'asuransi-perjalanan',
                'title' => 'Asuransi Perjalanan',
                'url' => '',
                'submenu' => [
                    [
                        'name' => 'asuransi-perjalanan',
                        'title' => 'Asuransi Perjalanan',
                        'url' => '/master/asuransi-perjalanan/asuransi-perjalanan'
                    ],
                    [
                        'name' => 'jenis-perjalanan',
                        'title' => 'Jenis Perjalanan',
                        'url' => '/master/asuransi-perjalanan/jenis-perjalanan'
                    ],
                    [
                        'name' => 'tipe-perlindungan',
                        'title' => 'Tipe Perlindungan',
                        'url' => '/master/asuransi-perjalanan/tipe-perlindungan'
                    ],
                ]
            ],
            
        ]
    ],
    [
        'name' => 'master',
        'perms' => 'master',
        'title' => 'Lainnya',
        'icon' => 'fa fa-globe',
        'submenu' => [
            [
                'name' => 'blog',
                'title' => 'Blog',
                'url' => '/master/lainnya/blog',
            ],
            [
                'name' => 'faq',
                'title' => 'Faq',
                'url' => '/master/lainnya/faq',
            ],
        ],
    ],
    [
        'name' => 'setting',
        'perms' => 'setting',
        'title' => 'Pengaturan Umum',
        'icon' => 'fa fa-cogs',
        'submenu' => [
            [
                'name' => 'role',
                'title' => 'Hak Akses',
                'url' => '/setting/role',
            ],
            [
                'name' => 'flow',
                'title' => 'Sistem Approval',
                'url' => '/setting/flow',
            ],
            [
                'name' => 'user',
                'title' => 'Manajemen User',
                'url' => '/setting/user',
            ],
            [
                'name' => 'activity',
                'title' => 'History Aktivitas',
                'url' => '/setting/activity',
            ],
        ]
    ],
];
