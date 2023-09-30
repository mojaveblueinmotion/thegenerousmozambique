<?php

namespace App\Http\Controllers\Master\AsuransiMobil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AsuransiMobil\AsuransiMobil;
use App\Models\Master\AsuransiMobil\AsuransiRiderMobil;
use App\Http\Requests\Master\AsuransiMobil\AsuransiMobilRequest;
use App\Http\Requests\Master\AsuransiMobil\AsuransiRiderMobilRequest;

class AsuransiMobilController extends Controller
{
    protected $module   = 'master.asuransi-mobil.asuransi-mobil';
    protected $routes   = 'master.asuransi-mobil.asuransi-mobil';
    protected $views    = 'master.asuransi-mobil.asuransi-mobil';
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
                'title' => 'Asuransi Mobil',
                'breadcrumb' => [
                    'Data Master' => route($this->routes . '.index'),
                    'Asuransi Mobil' => route($this->routes . '.index'),
                    'Asuransi Mobil' => route($this->routes . '.index'),
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
        $records = AsuransiMobil::grid()->filters()->dtGet();

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
                        'type:show|page:true|id:' . $record->id,
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

    public function store(AsuransiMobilRequest $request)
    {
        $record = new AsuransiMobil;
        return $record->handleStoreOrUpdate($request);
    }

    public function show(AsuransiMobil $record)
    {
        return redirect()->route($this->routes . '.rider', $record->id);
    }

    public function edit(AsuransiMobil $record)
    {
        return $this->render($this->views . '.edit', compact('record'));
    }

    public function update(AsuransiMobilRequest $request, AsuransiMobil $record)
    {
        return $record->handleStoreOrUpdate($request);
    }

    public function destroy(AsuransiMobil $record)
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

    public function importSave(Request $request)
    {
        $record = new KondisiKendaraan;
        return $record->handleImport($request);
    }

    public function rider(AsuransiMobil $record)
    {
        $this->prepare(
            [
                'title' => 'Rider Asuransi',
                'tableStruct' => [
                    'url' => route($this->routes . '.riderGrid', $record->id),
                    'datatable_1' => [
                        $this->makeColumn('name:num'),
                        $this->makeColumn('name:rider_kendaraan_id|label:Rider|className:text-left'),
                        $this->makeColumn('name:pembayaran_persentasi|label:Persentasi|className:text-left'),
                        $this->makeColumn('name:action'),
                    ],
                ],
            ]
        );

        return $this->render($this->views . '.rider.index', compact('record'));
    }

    public function riderGrid(AsuransiMobil $record)
    {
        $user = auth()->user();
        $records = AsuransiRiderMobil::where('asuransi_id', $record->id)->filters()->dtGet();

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
            ->rawColumns(['action', 'updated_by', 'pembayaran_persentasi', 'rider_kendaraan_id'])
            ->make(true);
    }

    public function riderCreate(AsuransiMobil $record)
    {
        $this->prepare(['title' => 'Rider Asuransi Mobil']);
        return $this->render($this->views . '.rider.create', compact('record'));
    }

    public function riderStore(AsuransiMobil $record, AsuransiRiderMobilRequest $request)
    {
        $rider = new AsuransiRiderMobil;
        return $record->handleRiderStoreOrUpdate($request, $rider);
    }

    public function riderShow(AsuransiRiderMobil $rider)
    {
        $this->prepare(['title' => 'Rider Asuransi Mobil']);
        $record = $rider->asuransiMobil;
        return $this->render($this->views . '.rider.show', compact('record', 'rider'));
    }

    public function riderEdit(AsuransiRiderMobil $rider)
    {
        $this->prepare(['title' => 'Rider Asuransi Mobil']);
        $record = $rider->asuransiMobil;
        return $this->render($this->views . '.rider.edit', compact('record', 'rider'));
    }

    public function riderUpdate(AsuransiRiderMobil $rider, AsuransiRiderMobilRequest $request)
    {
        $record = $rider->asuransiMobil;
        return $record->handleRiderStoreOrUpdate($request, $rider);
    }

    public function riderDestroy(AsuransiRiderMobil $rider)
    {
        $record = $rider->asuransiMobil;
        return $record->handleRiderDestroy($rider);
    }
}
