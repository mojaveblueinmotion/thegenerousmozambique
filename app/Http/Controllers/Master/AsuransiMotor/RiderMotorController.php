<?php

namespace App\Http\Controllers\Master\AsuransiMotor;

use Illuminate\Http\Request;
use App\Exports\GenerateExport;
use App\Http\Controllers\Controller;
use App\Models\Master\AsuransiMotor\RiderMotor;
use App\Http\Requests\Master\AsuransiMotor\RiderMotorRequest;

class RiderMotorController extends Controller
{
    protected $module   = 'master.asuransi-motor.rider-motor';
    protected $routes   = 'master.asuransi-motor.rider-motor';
    protected $views    = 'master.asuransi-motor.rider-motor';
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
                'title' => 'Rider Motor',
                'breadcrumb' => [
                    'Data Master' => route($this->routes . '.index'),
                    'Asuransi Motor' => route($this->routes . '.index'),
                    'Rider Motor' => route($this->routes . '.index'),
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
                        $this->makeColumn('name:name|label:Fitur Asuransi|className:text-center'),
                        $this->makeColumn('name:pertanggungan|label:Pertanggungan Yang Dikalikan|className:text-center'),
                        $this->makeColumn('name:description|label:Deskripsi|className:text-center'),
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
        $records = RiderMotor::grid()->filters()->dtGet();

        return \DataTables::of($records)
            ->addColumn(
                'num',
                function ($record) {
                    return request()->start;
                }
            )
            ->addColumn(
                'name',
                function ($record) {
                    return "<span class='badge badge-danger'>" . $record->name . "</span>";
                }
            )
            ->addColumn(
                'pertanggungan',
                function ($record) {
                    if($record->pertanggungan_id){
                        return "<span class='badge badge-primary'>" . $record->pertanggungan->name ."</span>";
                    }
                    return "<span class='badge badge-danger'>Default</span>";
                }
            )
            ->addColumn('description', function ($record) {
                return  "<span class='badge badge-primary'>" . str_word_count($record->description) . " Words</span>";
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
                        'type:show|id:' . $record->id,
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
            ->rawColumns(['action', 'updated_by', 'name', 'description', 'pertanggungan'])
            ->make(true);
    }

    public function create()
    {
        return $this->render($this->views . '.create');
    }

    public function store(RiderMotorRequest $request)
    {
        $record = new RiderMotor;
        return $record->handleStoreOrUpdate($request);
    }

    public function show(RiderMotor $record)
    {
        return $this->render($this->views . '.show', compact('record'));
    }

    public function edit(RiderMotor $record)
    {
        return $this->render($this->views . '.edit', compact('record'));
    }

    public function update(RiderMotorRequest $request, RiderMotor $record)
    {
        return $record->handleStoreOrUpdate($request);
    }

    public function destroy(RiderMotor $record)
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
        $record = new RiderMotor;
        return $record->handleImport($request);
    }
}
