<?php

namespace App\Http\Controllers\Master\AsuransiMotor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AsuransiMotor\AsuransiMotor;
use App\Models\Master\AsuransiMotor\AsuransiRiderMotor;
use App\Models\Master\AsuransiMotor\AsuransiPersentasiMotor;
use App\Http\Requests\Master\AsuransiMotor\AsuransiMotorRequest;
use App\Http\Requests\Master\AsuransiMotor\AsuransiRiderMotorRequest;
use App\Http\Requests\Master\AsuransiMotor\AsuransiPersentasiMotorRequest;

class AsuransiMotorController extends Controller
{
    protected $module   = 'master.asuransi-motor.asuransi-motor';
    protected $routes   = 'master.asuransi-motor.asuransi-motor';
    protected $views    = 'master.asuransi-motor.asuransi-motor';
    protected $perms    = 'master';

    public function __construct()
    {
        $this->prepare(
            [
                'module' => $this->module,
                'routes' => $this->routes,
                'views' => $this->views,
                'perms' => $this->perms,
                'permission' => $this->perms . '.view',
                'title' => 'Asuransi Motor',
                'breadcrumb' => [
                    'Data Master' => route($this->routes . '.index'),
                    'Asuransi Motor' => route($this->routes . '.index'),
                    'Asuransi Motor' => route($this->routes . '.index'),
                ]
            ]
        );
    }

    public function index()
    {
        $this->prepare(
            [
                'tableStruct' => [
                    'datatable_1' => [
                        $this->makeColumn('name:num'),
                        $this->makeColumn('name:perusahaan_asuransi_id|label:Perusahaan Asuransi|className:text-center'),
                        $this->makeColumn('name:name|label:Nama Asuransi|className:text-center'),
                        $this->makeColumn('name:pembayaran_persentasi|label:Pembayaran|className:text-center'),
                        $this->makeColumn('name:call_center|label:Call Center|className:text-center'),
                        $this->makeColumn('name:updated_by'),
                        $this->makeColumn('name:action'),
                    ],
                ],
            ]
        );
        return $this->render($this->views . '.index');
    }

    public function grid()
    {
        $user = auth()->user();
        $records = AsuransiMotor::grid()->filters()->dtGet();

        return \DataTables::of($records)
            ->addColumn(
                'num',
                function ($record) {
                    return request()->start;
                }
            )
            ->addColumn(
                'perusahaan_asuransi_id',
                function ($record) {
                    return "<span class='badge badge-danger'>" . $record->perusahaanAsuransi->name . "</span>";
                }
            )
            ->addColumn(
                'name',
                function ($record) {
                    return "<span class='badge badge-primary'>" . $record->name . "</span>";
                }
            )
            ->addColumn(
                'pembayaran_persentasi',
                function ($record) {
                    return "<span class='badge badge-info'>". $record->intervalPembayaran->name."</span>";
                }
            )
            ->addColumn('call_center', function ($record) {
                return  "<span class='badge badge-primary'>" . $record->call_center . "</span>";
            })
            ->addColumn(
                'updated_by',
                function ($record) {
                    return $record->createdByRaw();
                }
            )
            ->addColumn(
                'action',
                function ($record) use ($user) {
                    $actions = [
                        'type:show|label:Rider|page:true|id:' . $record->id,
                        'type:edit|id:' . $record->id,
                    ];
                    if ($record->canDeleted()) {
                        $actions[] = [
                            'type' => 'delete',
                            'id' => $record->id,
                            'attrs' => 'data-confirm-text="' . __('Hapus') . ' ' . $record->name . '?"',
                        ];
                    }
                    return $this->makeButtonDropdown($actions);
                }
            )
            ->rawColumns(['action', 'updated_by', 'name', 'perusahaan_asuransi_id', 'pembayaran_persentasi', 'call_center'])
            ->make(true);
    }

    public function create()
    {
        return $this->render($this->views . '.create');
    }

    public function store(AsuransiMotorRequest $request)
    {
        $record = new AsuransiMotor;
        return $record->handleStoreOrUpdate($request);
    }

    public function show(AsuransiMotor $record)
    {
        return redirect()->route($this->routes . '.rider', $record->id);
    }

    public function edit(AsuransiMotor $record)
    {
        return $this->render($this->views . '.edit', compact('record'));
    }

    public function update(AsuransiMotorRequest $request, AsuransiMotor $record)
    {
        return $record->handleStoreOrUpdate($request);
    }

    public function destroy(AsuransiMotor $record)
    {
        return $record->handleDestroy();
    }

    public function import()
    {
        if (request()->get('download') == 'template') {
            return $this->template();
        }
        return $this->render($this->views . '.import');
    }

    public function template()
    {
        $fileName = date('Y-m-d') . ' Template Import Data ' . $this->prepared('title') . '.xlsx';
        $view = $this->views . '.template';
        $data = [];
        return \Excel::download(new GenerateExport($view, $data), $fileName);
    }

    // RIDER ASURANSI

    public function rider(AsuransiMotor $record)
    {
        $this->prepare(
            [
                'title' => 'Rider Asuransi',
                'tableStruct' => [
                    'url' => route($this->routes . '.riderGrid', $record->id),
                    'datatable_1' => [
                        $this->makeColumn('name:num'),
                        $this->makeColumn('name:rider_kendaraan_id|label:Rider|className:text-left|width:500px'),
                        $this->makeColumn('name:pembayaran_persentasi|label:Persentasi|className:text-left'),
                        $this->makeColumn('name:pembayaran_persentasi_komersial|label:Persentasi Komersial|className:text-left'),
                        $this->makeColumn('name:updated_by'),
                        $this->makeColumn('name:action'),
                    ],
                    'url_2' => route($this->routes . '.persentasiGrid', $record->id),
                    'datatable_2' => [
                        $this->makeColumn('name:num'),
                        $this->makeColumn('name:kategori|label:Kategori|className:text-left'),
                        $this->makeColumn('name:uang_pertanggungan|label:Uang Pertanggungan|className:text-center'),
                        $this->makeColumn('name:wilayah_satu|label:Wilayah Satu|className:text-center'),
                        $this->makeColumn('name:wilayah_dua|label:Wilayah Dua|className:text-center'),
                        $this->makeColumn('name:wilayah_tiga|label:Wilayah Tiga|className:text-center'),
                        $this->makeColumn('name:updated_by'),
                        $this->makeColumn('name:action'),
                    ],
                ],
                
            ]
        );

        return $this->render($this->views . '.rider.index', compact('record'));
    }

    public function riderGrid(AsuransiMotor $record)
    {
        $user = auth()->user();
        $records = AsuransiRiderMotor::where('asuransi_id', $record->id)->filters()->dtGet();

        return \DataTables::of($records)
            ->addColumn(
                'num',
                function ($records) {
                    return request()->start;
                }
            )
            ->addColumn(
                'rider_kendaraan_id',
                function ($records) {
                    return $records->riderKendaraan->name;
                }
            )
            ->addColumn(
                'pembayaran_persentasi',
                function ($records) {
                    return $records->pembayaran_persentasi. '%';
                }
            )
            ->addColumn(
                'pembayaran_persentasi_komersial',
                function ($records) {
                    return $records->pembayaran_persentasi_komersial. '%';
                }
            )
            ->addColumn(
                'updated_by',
                function ($records) {
                    return $records->createdByRaw();
                }
            )
            ->addColumn(
                'action',
                function ($records) use ($user) {
                    $actions = [];
                    $actions[] = [
                        'type' => 'show',
                        'url' => route($this->routes . '.riderShow', $records->id),
                    ];

                    $actions[] = [
                        'type' => 'edit',
                        'url' => route($this->routes . '.riderEdit', $records->id),
                    ];
                    $actions[] = [
                        'type' => 'delete',
                        'url' => route($this->routes . '.riderDestroy', $records->id),
                        'text' => 'pernyataan ini',
                    ];
                    return $this->makeButtonDropdown($actions, $records->id);
                }
            )
            ->rawColumns(['action', 'updated_by', 'pembayaran_persentasi', 'rider_kendaraan_id', 'pembayaran_persentasi_komersial'])
            ->make(true);
    }

    public function riderCreate(AsuransiMotor $record)
    {
        $this->prepare(['title' => 'Rider Asuransi Motor']);
        return $this->render($this->views . '.rider.create', compact('record'));
    }

    public function riderStore(AsuransiMotor $record, AsuransiRiderMotorRequest $request)
    {
        $rider = new AsuransiRiderMotor;
        return $record->handleRiderStoreOrUpdate($request, $rider);
    }

    public function riderShow(AsuransiRiderMotor $rider)
    {
        $this->prepare(['title' => 'Rider Asuransi Motor']);
        $record = $rider->asuransiMotor;
        return $this->render($this->views . '.rider.show', compact('record', 'rider'));
    }

    public function riderEdit(AsuransiRiderMotor $rider)
    {
        $this->prepare(['title' => 'Rider Asuransi Motor']);
        $record = $rider->asuransiMotor;
        return $this->render($this->views . '.rider.edit', compact('record', 'rider'));
    }

    public function riderUpdate(AsuransiRiderMotor $rider, AsuransiRiderMotorRequest $request)
    {
        $record = $rider->asuransiMotor;
        return $record->handleRiderStoreOrUpdate($request, $rider);
    }

    public function riderDestroy(AsuransiRiderMotor $rider)
    {
        $record = $rider->asuransiMotor;
        return $record->handleRiderDestroy($rider);
    }

    // PERSENTASI ASURANSI
    // PERSENTASI ASURANSI
    // PERSENTASI ASURANSI
    public function persentasiGrid(AsuransiMotor $record)
    {
        $user = auth()->user();
        $records = AsuransiPersentasiMotor::where('asuransi_id', $record->id)->filters()->dtGet();

        return \DataTables::of($records)
            ->addColumn(
                'num',
                function ($records) {
                    return request()->start;
                }
            )
            ->addColumn(
                'kategori',
                function ($records) {
                    return $records->kategori;
                }
            )
            ->addColumn(
                'uang_pertanggungan',
                function ($records) {
                    return "Rp. ". number_format($records->uang_pertanggungan_bawah , 0, ',', '.'). ' s/d ' . "Rp. ". number_format($records->uang_pertanggungan_atas , 0, ',', '.');
                }
            )
            ->addColumn(
                'wilayah_satu',
                function ($records) {
                    return $records->wilayah_satu_bawah. '% - ' . $records->wilayah_satu_atas . "%";
                }
            )
            ->addColumn(
                'wilayah_dua',
                function ($records) {
                    return $records->wilayah_dua_bawah. '% - ' . $records->wilayah_dua_atas . "%";
                }
            )
            ->addColumn(
                'wilayah_tiga',
                function ($records) {
                    return $records->wilayah_tiga_bawah. '% - ' . $records->wilayah_tiga_atas. "%";
                }
            )
            ->addColumn(
                'updated_by',
                function ($records) {
                    return $records->createdByRaw();
                }
            )
            ->addColumn(
                'action',
                function ($records) use ($user) {
                    $actions = [];
                    $actions[] = [
                        'type' => 'show',
                        'url' => route($this->routes . '.persentasiShow', $records->id),
                    ];

                    $actions[] = [
                        'type' => 'edit',
                        'url' => route($this->routes . '.persentasiEdit', $records->id),
                    ];
                    $actions[] = [
                        'type' => 'delete',
                        'url' => route($this->routes . '.persentasiDestroy', $records->id),
                        'text' => 'Hapus Data Ini',
                    ];
                    return $this->makeButtonDropdown($actions, $records->id);
                }
            )
            ->rawColumns([
                'action', 
                'updated_by', 
                'kategori',
                'uang_pertanggungan',
                'wilayah_satu',
                'wilayah_dua',
                'wilayah_tiga',
                ])
            ->make(true);
    }

    public function persentasiCreate(AsuransiMotor $record)
    {
        $this->prepare(['title' => 'Persentasi Asuransi Motor']);
        return $this->render($this->views . '.persentasi.create', compact('record'));
    }

    public function persentasiStore(AsuransiMotor $record, AsuransiPersentasiMotorRequest $request)
    {
        $persentasi = new AsuransiPersentasiMotor;
        return $record->handlePersentasiStoreOrUpdate($request, $persentasi);
    }

    public function persentasiShow(AsuransiPersentasiMotor $persentasi)
    {
        $this->prepare(['title' => 'Persentasi Asuransi Motor']);
        $record = $persentasi->asuransiMotor;
        return $this->render($this->views . '.persentasi.show', compact('record', 'persentasi'));
    }

    public function persentasiEdit(AsuransiPersentasiMotor $persentasi)
    {
        $this->prepare(['title' => 'Persentasi Asuransi Motor']);
        $record = $persentasi->asuransiMotor;
        return $this->render($this->views . '.persentasi.edit', compact('record', 'persentasi'));
    }

    public function persentasiUpdate(AsuransiPersentasiMotor $persentasi, AsuransiPersentasiMotorRequest $request)
    {
        $record = $persentasi->asuransiMotor;
        return $record->handlePersentasiStoreOrUpdate($request, $persentasi);
    }

    public function persentasiDestroy(AsuransiPersentasiMotor $persentasi)
    {
        $record = $persentasi->asuransiMotor;
        return $record->handlePersentasiDestroy($persentasi);
    } 

}
