<?php

namespace App\Http\Controllers\Master\AsuransiKontraktor;

use Illuminate\Http\Request;
use App\Exports\GenerateExport;
use App\Http\Controllers\Controller;
use App\Models\Master\AsuransiKontraktor\Subsoil;
use App\Http\Requests\Master\AsuransiKontraktor\SubsoilRequest;

class SubsoilController extends Controller
{
    protected $module   = 'master.asuransi-kontraktor.subsoil';
    protected $routes   = 'master.asuransi-kontraktor.subsoil';
    protected $views    = 'master.asuransi-kontraktor.subsoil';
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
                'title' => 'Subsoil',
                'breadcrumb' => [
                    'Data Master' => route($this->routes . '.index'),
                    'Asuransi Kontraktor' => route($this->routes . '.index'),
                    'Subsoil' => route($this->routes . '.index'),
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
                        $this->makeColumn('name:name|label:Nama|className:text-center'),
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
        $records = Subsoil::grid()->filters()->dtGet();

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
            ->rawColumns(['action', 'updated_by', 'name', 'description'])
            ->make(true);
    }

    public function create()
    {
        return $this->render($this->views . '.create');
    }

    public function store(SubsoilRequest $request)
    {
        $record = new Subsoil;
        return $record->handleStoreOrUpdate($request);
    }

    public function show(Subsoil $record)
    {
        return $this->render($this->views . '.show', compact('record'));
    }

    public function edit(Subsoil $record)
    {
        return $this->render($this->views . '.edit', compact('record'));
    }

    public function update(SubsoilRequest $request, Subsoil $record)
    {
        return $record->handleStoreOrUpdate($request);
    }

    public function destroy(Subsoil $record)
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
        $record = new Subsoil;
        return $record->handleImport($request);
    }
}
