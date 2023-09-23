<?php

use App\Models\Auth\User;
use App\Models\Master\RoleGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/home');
Auth::routes();

Route::get(
    'dev/json',
    function (Request $request) {
        $user = auth()->user()->load('position.location');
        return RoleGroup::with(
            [
                'types'
            ]
        )
            ->withCount(
                [
                    'incidents',
                    'problems',
                    'changes',
                ]
            )
            ->where('role_id', RoleGroup::HELPDESK)
            ->whereRelation('types', 'asset_type_id', 1)
            ->get()
            // ->min('changes_count');
            ->random() ?? 1;
    }
);

Route::get(
    'dev/reset',
    function (Request $request) {
        Artisan::call('migrate:fresh --seed');
        return 'Ok';
    }
);

Route::middleware('auth')
    ->group(
        function () {
            // Ajax
            Route::prefix('ajax')
                ->name('ajax.')
                ->group(
                    function () {
                        Route::post('saveTempFiles', 'AjaxController@saveTempFiles')->name('saveTempFiles');
                        Route::get('testNotification/{emails}', 'AjaxController@testNotification')->name('testNotification');
                        Route::post('userNotification', 'AjaxController@userNotification')->name('userNotification');
                        Route::get('userNotification/{notification}/read', 'AjaxController@userNotificationRead')->name('userNotificationRead');
                        // Ajax Modules
                        Route::post('{search}/select-asset', 'AjaxController@selectAsset')->name('select-asset');
                        Route::post('{search}/select-asset-detail', 'AjaxController@selectAssetdetail')->name('select-asset-detail');
                        Route::post('{search}/select-asset-type', 'AjaxController@selectAssetType')->name('select-asset-type');
                        Route::post('{search}/select-change', 'AjaxController@selectChange')->name('select-change');
                        Route::post('{search}/select-city', 'AjaxController@selectCity')->name('select-city');
                        Route::post('{search}/select-incident', 'AjaxController@selectIncident')->name('select-incident');
                        Route::post('{search}/select-knowledge', 'AjaxController@selectKnowledge')->name('select-knowledge');
                        Route::post('{search}/select-problem', 'AjaxController@selectProblem')->name('select-problem');
                        Route::post('{search}/select-priority', 'AjaxController@selectPriority')->name('select-priority');
                        Route::post('{search}/select-role', 'AjaxController@selectRole')->name('select-role');
                        Route::post('{search}/select-severity', 'AjaxController@selectSeverity')->name('select-severity');
                        Route::post('{search}/select-struct', 'AjaxController@selectStruct')->name('select-struct');
                        Route::post('{search}/select-position', 'AjaxController@selectPosition')->name('select-position');
                        Route::post('{search}/select-province', 'AjaxController@selectProvince')->name('select-province');
                        Route::post('{search}/select-technician', 'AjaxController@selectTechnician')->name('select-technician');
                        Route::post('{search}/select-user', 'AjaxController@selectUser')->name('select-user');
                        Route::post('{search}/select-nip', 'AjaxController@selectNip')->name('select-nip');

                        // For Province -> City
                        Route::post('{search}/selectProvinceForCity', 'AjaxController@selectProvinceForCity')->name('selectProvinceForCity');
                        Route::post('city-options', 'AjaxController@cityOptions')->name('cityOptions');
                        Route::post('district-options', 'AjaxController@districtOptions')->name('districtOptions');
                        Route::post('{search}/selectIntervalPembayaran', 'AjaxController@selectIntervalPembayaran')->name('selectIntervalPembayaran');
                        Route::post('{search}/selectPerusahaanAsuransi', 'AjaxController@selectPerusahaanAsuransi')->name('selectPerusahaanAsuransi');
                        Route::post('{search}/selectFiturAsuransi', 'AjaxController@selectFiturAsuransi')->name('selectFiturAsuransi');

                        // For Database Mobil
                        Route::post('{search}/selectMerk', 'AjaxController@selectMerk')->name('selectMerk');
                        Route::post('{search}/selectTahun', 'AjaxController@selectTahun')->name('selectTahun');
                        Route::post('tahunOptions', 'AjaxController@tahunOptions')->name('tahunOptions');
                        Route::post('{search}/selectSeri', 'AjaxController@selectSeri')->name('selectSeri');
                        Route::post('seriOptions', 'AjaxController@seriOptions')->name('seriOptions');
                        Route::post('{search}/selectTipeMobil', 'AjaxController@selectTipeMobil')->name('selectTipeMobil');
                        Route::post('{search}/selectTipeKendaraan', 'AjaxController@selectTipeKendaraan')->name('selectTipeKendaraan');
                        Route::post('{search}/selectKodePlat', 'AjaxController@selectKodePlat')->name('selectKodePlat');
                        Route::post('{search}/selectTipePemakaian', 'AjaxController@selectTipePemakaian')->name('selectTipePemakaian');
                        Route::post('{search}/selectLuasPertanggungan', 'AjaxController@selectLuasPertanggungan')->name('selectLuasPertanggungan');
                        Route::post('{search}/selectKondisiKendaraan', 'AjaxController@selectKondisiKendaraan')->name('selectKondisiKendaraan');

                        // For Polis Mobil
                        Route::post('{search}/selectAgent', 'AjaxController@selectAgent')->name('selectAgent');
                        Route::post('{search}/selectAsuransiMobil', 'AjaxController@selectAsuransiMobil')->name('selectAsuransiMobil');

                        // For Asuransi Motor
                        Route::post('{search}/selectMerkMotor', 'AjaxMotorController@selectMerkMotor')->name('selectMerkMotor');
                        Route::post('{search}/selectTahunMotor', 'AjaxMotorController@selectTahunMotor')->name('selectTahunMotor');
                        Route::post('tahunMotorOptions', 'AjaxMotorController@tahunMotorOptions')->name('tahunMotorOptions');
                        Route::post('{search}/selectSeriMotor', 'AjaxMotorController@selectSeriMotor')->name('selectSeriMotor');
                        Route::post('seriMotorOptions', 'AjaxMotorController@seriMotorOptions')->name('seriMotorOptions');
                        Route::post('{search}/selectAsuransiMotor', 'AjaxMotorController@selectAsuransiMotor')->name('selectAsuransiMotor');
                        Route::post('{search}/selectTipeMotor', 'AjaxMotorController@selectTipeMotor')->name('selectTipeMotor');

                        // For Asuransi Perjalanan
                        Route::post('{search}/selectAsuransiPerjalanan', 'AjaxController@selectAsuransiPerjalanan')->name('selectAsuransiPerjalanan');

                        // For Asuransi Properti
                        Route::post('{search}/selectAsuransiProperti', 'AjaxController@selectAsuransiProperti')->name('selectAsuransiProperti');
                        Route::post('{search}/selectOkupasi', 'AjaxController@selectOkupasi')->name('selectOkupasi');
                        Route::post('{search}/selectKonstruksiProperti', 'AjaxController@selectKonstruksiProperti')->name('selectKonstruksiProperti');
                        Route::post('{search}/selectPerlindunganProperti', 'AjaxController@selectPerlindunganProperti')->name('selectPerlindunganProperti');
                    }
                );

            Route::namespace('Dashboard')
                ->group(
                    function () {
                        Route::get('home', 'DashboardController@index')->name('home');
                        Route::post('progress', 'DashboardController@progress')->name('dashboard.progress');
                        Route::post('chart-insiden-per-aset', 'DashboardController@chartInsidenPerAset')->name('dashboard.chart-insiden-per-aset');
                        Route::post('chart-insiden-tahunan', 'DashboardController@chartInsidenTahunan')->name('dashboard.chart-insiden-tahunan');
                        Route::post('chart-problem-per-aset', 'DashboardController@chartProblemPerAset')->name('dashboard.chart-problem-per-aset');
                        Route::post('chart-problem-tahunan', 'DashboardController@chartProblemTahunan')->name('dashboard.chart-problem-tahunan');
                        Route::post('chart-user', 'DashboardController@chartUser')->name('dashboard.chart-user');
                        Route::get('language/{lang}/set-lang', 'DashboardController@setLang')->name('set-lang');
                    }
                );

            // ASURANSI
            Route::namespace('Asuransi')->prefix('asuransi')->name('asuransi.')->group(function () {
                // Polis MOBIL
                Route::namespace('PolisMobil')->group(function () {
                    Route::get('polis-mobil/{record}/detail', 'PolisMobilController@detail')->name('polis-mobil.detail');
                    Route::get('polis-mobil/{record}/detailShow', 'PolisMobilController@detailShow')->name('polis-mobil.detail.show');
                    Route::post('polis-mobil/{record}/detailGrid', 'PolisMobilController@detailGrid')->name('polis-mobil.detailGrid');
            
                    // Grid
                    Route::post('polis-mobil/{record}/detailPolisGrid', 'PolisMobilController@detailPolisGrid')->name('polis-mobil.detailPolisGrid');
                    Route::post('polis-mobil/{record}/detailPolisGridShow', 'PolisMobilController@detailPolisGridShow')->name('polis-mobil.detailPolisGridShow');
            
                    // Detail 
                    Route::get('polis-mobil/{detail}/detailPolis', 'PolisMobilController@detailPolis')->name('polis-mobil.detailPolis');
                    Route::get('polis-mobil/{detail}/detailPolisEdit', 'PolisMobilController@detailPolisEdit')->name('polis-mobil.detailPolisEdit');
                    Route::get('polis-mobil/{detail}/detailPolisShow', 'PolisMobilController@detailPolisShow')->name('polis-mobil.detailPolisShow');
                    Route::patch('polis-mobil/detailPolisStore', 'PolisMobilController@detailPolisStore')->name('polis-mobil.detailPolisStore');
                    Route::patch('polis-mobil/{detail}/detailPolisUpdate', 'PolisMobilController@detailPolisUpdate')->name('polis-mobil.detailPolisUpdate');
                    Route::delete('polis-mobil/{detail}/detailPolisDestroy', 'PolisMobilController@detailPolisDestroy')->name('polis-mobil.detailPolisDestroy');
            
                    Route::grid('polis-mobil', 'PolisMobilController', [
                        'with' => ['submit', 'approval', 'print', 'history', 'tracking']
                    ]);
                });

                // Polis Motor
                Route::namespace('PolisMotor')->group(function () {
                    Route::get('polis-motor/{record}/detail', 'PolisMotorController@detail')->name('polis-motor.detail');
                    Route::get('polis-motor/{record}/detailShow', 'PolisMotorController@detailShow')->name('polis-motor.detail.show');
                    Route::post('polis-motor/{record}/detailGrid', 'PolisMotorController@detailGrid')->name('polis-motor.detailGrid');
            
                    // Grid
                    Route::post('polis-motor/{record}/detailPolisGrid', 'PolisMotorController@detailPolisGrid')->name('polis-motor.detailPolisGrid');
                    Route::post('polis-motor/{record}/detailPolisGridShow', 'PolisMotorController@detailPolisGridShow')->name('polis-motor.detailPolisGridShow');
            
                    // Detail 
                    Route::get('polis-motor/{detail}/detailPolis', 'PolisMotorController@detailPolis')->name('polis-motor.detailPolis');
                    Route::get('polis-motor/{detail}/detailPolisEdit', 'PolisMotorController@detailPolisEdit')->name('polis-motor.detailPolisEdit');
                    Route::get('polis-motor/{detail}/detailPolisShow', 'PolisMotorController@detailPolisShow')->name('polis-motor.detailPolisShow');
                    Route::patch('polis-motor/detailPolisStore', 'PolisMotorController@detailPolisStore')->name('polis-motor.detailPolisStore');
                    Route::patch('polis-motor/{detail}/detailPolisUpdate', 'PolisMotorController@detailPolisUpdate')->name('polis-motor.detailPolisUpdate');
                    Route::delete('polis-motor/{detail}/detailPolisDestroy', 'PolisMotorController@detailPolisDestroy')->name('polis-motor.detailPolisDestroy');
            
                    Route::grid('polis-motor', 'PolisMotorController', [
                        'with' => ['submit', 'approval', 'print', 'history', 'tracking']
                    ]);
                });

                // Polis Properti
                Route::namespace('PolisProperti')->group(function () {
                    Route::get('polis-properti/{record}/detail', 'PolisPropertiController@detail')->name('polis-properti.detail');
                    Route::get('polis-properti/{record}/detailShow', 'PolisPropertiController@detailShow')->name('polis-properti.detail.show');
                    Route::post('polis-properti/{record}/detailGrid', 'PolisPropertiController@detailGrid')->name('polis-properti.detailGrid');
            
                    // Grid
                    Route::post('polis-properti/{record}/detailPolisGrid', 'PolisPropertiController@detailPolisGrid')->name('polis-properti.detailPolisGrid');
                    Route::post('polis-properti/{record}/detailPolisGridShow', 'PolisPropertiController@detailPolisGridShow')->name('polis-properti.detailPolisGridShow');
            
                    // Detail 
                    Route::get('polis-properti/{detail}/detailPolis', 'PolisPropertiController@detailPolis')->name('polis-properti.detailPolis');
                    Route::get('polis-properti/{detail}/detailPolisEdit', 'PolisPropertiController@detailPolisEdit')->name('polis-properti.detailPolisEdit');
                    Route::get('polis-properti/{detail}/detailPolisShow', 'PolisPropertiController@detailPolisShow')->name('polis-properti.detailPolisShow');
                    Route::patch('polis-properti/detailPolisStore', 'PolisPropertiController@detailPolisStore')->name('polis-properti.detailPolisStore');
                    Route::patch('polis-properti/{detail}/detailPolisUpdate', 'PolisPropertiController@detailPolisUpdate')->name('polis-properti.detailPolisUpdate');
                    Route::delete('polis-properti/{detail}/detailPolisDestroy', 'PolisPropertiController@detailPolisDestroy')->name('polis-properti.detailPolisDestroy');
            
                    Route::grid('polis-properti', 'PolisPropertiController', [
                        'with' => ['submit', 'approval', 'print', 'history', 'tracking']
                    ]);
                });

                // Polis Perjalanan
                Route::namespace('PolisPerjalanan')->group(function () {
                    Route::get('polis-perjalanan/{record}/detail', 'PolisPerjalananController@detail')->name('polis-perjalanan.detail');
                    Route::get('polis-perjalanan/{record}/detailShow', 'PolisPerjalananController@detailShow')->name('polis-perjalanan.detail.show');
                    Route::post('polis-perjalanan/{record}/detailGrid', 'PolisPerjalananController@detailGrid')->name('polis-perjalanan.detailGrid');
            
                    // Grid
                    Route::post('polis-perjalanan/{record}/detailPolisGrid', 'PolisPerjalananController@detailPolisGrid')->name('polis-perjalanan.detailPolisGrid');
                    Route::post('polis-perjalanan/{record}/detailPolisGridShow', 'PolisPerjalananController@detailPolisGridShow')->name('polis-perjalanan.detailPolisGridShow');
            
                    // Detail 
                    Route::get('polis-perjalanan/{detail}/detailPolis', 'PolisPerjalananController@detailPolis')->name('polis-perjalanan.detailPolis');
                    Route::get('polis-perjalanan/{detail}/detailPolisEdit', 'PolisPerjalananController@detailPolisEdit')->name('polis-perjalanan.detailPolisEdit');
                    Route::get('polis-perjalanan/{detail}/detailPolisShow', 'PolisPerjalananController@detailPolisShow')->name('polis-perjalanan.detailPolisShow');
                    Route::patch('polis-perjalanan/detailPolisStore', 'PolisPerjalananController@detailPolisStore')->name('polis-perjalanan.detailPolisStore');
                    Route::patch('polis-perjalanan/{detail}/detailPolisUpdate', 'PolisPerjalananController@detailPolisUpdate')->name('polis-perjalanan.detailPolisUpdate');
                    Route::delete('polis-perjalanan/{detail}/detailPolisDestroy', 'PolisPerjalananController@detailPolisDestroy')->name('polis-perjalanan.detailPolisDestroy');
            
                    Route::grid('polis-perjalanan', 'PolisPerjalananController', [
                        'with' => ['submit', 'approval', 'print', 'history', 'tracking']
                    ]);
                });
            });

            // Master
            Route::namespace('Master')
                ->prefix('master')
                ->name('master.')
                ->group(
                    function () {
                        Route::namespace('Org')
                            ->prefix('org')
                            ->name('org.')
                            ->group(
                                function () {
                                    Route::grid('root', 'RootController');
                                    // Route::grid('boc', 'BocController');

                                    Route::get('bod/import', 'BodController@import')->name('bod.import');
                                    Route::post('bod/import-save', 'BodController@import-save')->name('bod.import-save');
                                    Route::grid('bod', 'BodController');

                                    Route::get('division/import', 'DivisionController@import')->name('division.import');
                                    Route::post('division/import-save', 'DivisionController@import-save')->name('division.import-save');
                                    Route::grid('division', 'DivisionController');

                                    Route::get('department/import', 'DepartmentController@import')->name('department.import');
                                    Route::post('department/import-save', 'DepartmentController@import-save')->name('department.import-save');
                                    Route::grid('department', 'DepartmentController');

                                    Route::get('unit-bisnis/import', 'UnitBisnisController@import')->name('unit-bisnis.import');
                                    Route::post('unit-bisnis/import-save', 'UnitBisnisController@import-save')->name('unit-bisnis.import-save');
                                    Route::grid('unit-bisnis', 'UnitBisnisController');

                                    Route::get('position/import', 'PositionController@import')->name('position.import');
                                    Route::post('position/import-save', 'PositionController@import-save')->name('position.import-save');
                                    Route::grid('position', 'PositionController');
                                }
                            );

                        Route::namespace('Geo')
                            ->name('geo.')
                            ->prefix('geo')
                            ->group(
                                function () {
                                    Route::get('province/import', 'ProvinceController@import')->name('province.import');
                                    Route::post('province/import-save', 'ProvinceController@import-save')->name('province.import-save');
                                    Route::grid('province', 'ProvinceController');

                                    Route::get('city/import', 'CityController@import')->name('city.import');
                                    Route::post('city/import-save', 'CityController@import-save')->name('city.import-save');
                                    Route::grid('city', 'CityController');

                                    Route::get('district/import', 'DistrictController@import')->name('district.import');
                                    Route::post('district/import-save', 'DistrictController@import-save')->name('district.import-save');
                                    Route::grid('district', 'DistrictController');

                                    Route::get('village/import', 'VillageController@import')->name('village.import');
                                    Route::post('village/import-save', 'VillageController@import-save')->name('village.import-save');
                                    Route::grid('village', 'VillageController');
                                }
                            );

                        Route::get('asset-type/import', 'AssetTypeController@import')->name('asset-type.import');
                        Route::post('asset-type/import-save', 'AssetTypeController@import-save')->name('asset-type.import-save');
                        Route::grid('asset-type', 'AssetTypeController');

                        Route::get('asset/import', 'AssetController@import')->name('asset.import');
                        Route::post('asset/import-save', 'AssetController@import-save')->name('asset.import-save');
                        Route::get('asset/{record}/detail', 'AssetController@detail')->name('asset.detail');
                        Route::post('asset/{record}/detail-grid', 'AssetController@detailGrid')->name('asset.detail.grid');
                        Route::get('asset/{record}/detail-create', 'AssetController@detailCreate')->name('asset.detail.create');
                        Route::post('asset/{record}/detail-store', 'AssetController@detailStore')->name('asset.detail.store');
                        Route::get('asset/{detail}/detail-show', 'AssetController@detailShow')->name('asset.detail.show');
                        Route::get('asset/{detail}/detail-edit', 'AssetController@detailEdit')->name('asset.detail.edit');
                        Route::patch('asset/{detail}/detail-update', 'AssetController@detailUpdate')->name('asset.detail.update');
                        Route::delete('asset/{detail}/detail-destroy', 'AssetController@detailDestroy')->name('asset.detail.destroy');
                        Route::grid('asset', 'AssetController');

                        Route::get('role-group/import', 'RoleGroupController@import')->name('role-group.import');
                        Route::post('role-group/import-save', 'RoleGroupController@import-save')->name('role-group.import-save');
                        Route::grid('role-group', 'RoleGroupController');

                        Route::get('priority/import', 'PriorityController@import')->name('priority.import');
                        Route::post('priority/import-save', 'PriorityController@import-save')->name('priority.import-save');
                        Route::grid('priority', 'PriorityController');

                        Route::get('severity/import', 'SeverityController@import')->name('severity.import');
                        Route::post('severity/import-save', 'SeverityController@import-save')->name('severity.import-save');
                        Route::grid('severity', 'SeverityController');

                        // ASURANSI Properti
                        Route::namespace('AsuransiProperti')
                            ->prefix('asuransi-properti')
                            ->name('asuransi-properti.')
                            ->group(
                                function () {
                                    Route::grid('okupasi', 'OkupasiController');
                                    Route::grid('perlindungan-properti', 'PerlindunganPropertiController');
                                    Route::grid('konstruksi-properti', 'KonstruksiPropertiController');

                                    Route::grid('asuransi-properti', 'AsuransiPropertiController');
                                }
                            );

                        // ASURANSI Mobil
                        Route::namespace('AsuransiMotor')
                            ->prefix('asuransi-motor')
                            ->name('asuransi-motor.')
                            ->group(
                                function () {
                                    Route::grid('asuransi-motor', 'AsuransiMotorController');

                                    Route::grid('merk', 'MerkController');

                                    Route::grid('tahun', 'TahunController');

                                    Route::grid('tipe', 'TipeController');

                                    Route::grid('seri', 'SeriController');

                                    Route::grid('tipe-motor', 'TipeMotorController');
                                }
                            );

                        // ASURANSI Mobil
                        Route::namespace('AsuransiMobil')
                            ->prefix('asuransi-mobil')
                            ->name('asuransi-mobil.')
                            ->group(
                                function () {
                                    Route::grid('mobil', 'MobilController');

                                    Route::grid('tipe-pemakaian', 'TipePemakaianController');

                                    Route::grid('luas-pertanggungan', 'LuasPertanggunganController');

                                    Route::grid('kondisi-kendaraan', 'KondisiKendaraanController');

                                    Route::grid('workshop', 'WorkshopController');

                                    Route::grid('asuransi-mobil', 'AsuransiMobilController');

                                    // Route::get('bod/import', 'BodController@import')->name('bod.import');
                                    // Route::post('bod/import-save', 'BodController@import-save')->name('bod.import-save');
                                    // Route::grid('bod', 'BodController');

                                    // Route::get('division/import', 'DivisionController@import')->name('division.import');
                                    // Route::post('division/import-save', 'DivisionController@import-save')->name('division.import-save');
                                    // Route::grid('division', 'DivisionController');

                                    // Route::get('department/import', 'DepartmentController@import')->name('department.import');
                                    // Route::post('department/import-save', 'DepartmentController@import-save')->name('department.import-save');
                                    // Route::grid('department', 'DepartmentController');
                                }
                            );

                        // DATABASE MOBIL
                        Route::namespace('DatabaseMobil')
                            ->prefix('database-mobil')
                            ->name('database-mobil.')
                            ->group(
                                function () {
                                    Route::grid('merk', 'MerkController');

                                    Route::grid('tahun', 'TahunController');

                                    Route::grid('tipe', 'TipeController');

                                    Route::grid('seri', 'SeriController');

                                    Route::grid('tipe-mobil', 'TipeMobilController');

                                    Route::grid('tipe-kendaraan', 'TipeKendaraanController');

                                    Route::grid('kode-plat', 'KodePlatController');

                                }
                            );

                        Route::namespace('AsuransiPerjalanan')
                            ->prefix('asuransi-perjalanan')
                            ->name('asuransi-perjalanan.')
                            ->group(
                                function () {
                                    Route::grid('jenis-perjalanan', 'JenisPerjalananController');

                                    Route::grid('tipe-perlindungan', 'TipePerlindunganController');

                                    Route::grid('asuransi-perjalanan', 'AsuransiPerjalananController');
                                }
                            );

                        // DATA ASURANSI
                        Route::namespace('DataAsuransi')
                            ->prefix('data-asuransi')
                            ->name('data-asuransi.')
                            ->group(
                                function () {
                                    Route::grid('kategori-asuransi', 'KategoriAsuransiController');

                                    Route::grid('perusahaan-asuransi', 'PerusahaanAsuransiController');

                                    Route::grid('interval-pembayaran', 'IntervalPembayaranController');

                                    Route::grid('fitur-asuransi', 'FiturAsuransiController');
                                }
                            );
                            
                    }
                );

            // Setting
            Route::namespace('Setting')
                ->prefix('setting')
                ->name('setting.')
                ->group(
                    function () {
                        Route::namespace('Role')
                            ->group(
                                function () {
                                    Route::get('role/import', 'RoleController@import')->name('role.import');
                                    Route::post('role/import-save', 'RoleController@import-save')->name('role.import-save');
                                    Route::get('role/{record}/permit', 'RoleController@permit')->name('role.permit');
                                    Route::patch('role/{record}/grant', 'RoleController@grant')->name('role.grant');
                                    Route::grid('role', 'RoleController');
                                }
                            );
                        Route::namespace('Flow')
                            ->group(
                                function () {
                                    Route::get('flow/import', 'FlowController@import')->name('flow.import');
                                    Route::post('flow/import-save', 'FlowController@import-save')->name('flow.import-save');
                                    Route::grid('flow', 'FlowController');
                                }
                            );
                        Route::namespace('User')
                            ->group(
                                function () {
                                    Route::get('user/import', 'UserController@import')->name('user.import');
                                    Route::post('user/import-save', 'UserController@import-save')->name('user.import-save');
                                    Route::grid('user', 'UserController');

                                    Route::get('profile', 'ProfileController@index')->name('profile.index');
                                    Route::post('profile', 'ProfileController@updateProfile')->name('profile.update-profile');
                                    Route::get('profile/notification', 'ProfileController@notification')->name('profile.notification');
                                    Route::post('profile/grid-notification', 'ProfileController@gridNotification')->name('profile.grid-notification');
                                    Route::get('profile/activity', 'ProfileController@activity')->name('profile.activity');
                                    Route::post('profile/grid-activity', 'ProfileController@gridActivity')->name('profile.grid-activity');
                                    Route::get('profile/change-password', 'ProfileController@changePassword')->name('profile.change-password');
                                    Route::post('profile/change-password', 'ProfileController@updatePassword')->name('profile.update-password');
                                }
                            );
                        Route::namespace('Activity')
                            ->group(
                                function () {
                                    Route::get('activity/export', 'ActivityController@export')->name('activity.export');
                                    Route::grid('activity', 'ActivityController');
                                }
                            );
                    }
                );

            // Web Transaction Modules
            foreach (\File::allFiles(__DIR__ . '/webs') as $file) {
                require $file->getPathname();
            }
        }
    );
