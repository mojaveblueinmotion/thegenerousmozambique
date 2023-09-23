<?php

namespace App\Http\Controllers\Master\AsuransiProperti;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\AsuransiProperti\PerlindunganPropertiRequest;
use App\Models\Master\AsuransiProperti\PerlindunganProperti;
use Illuminate\Http\Request;

class PerlindunganPropertiController extends Controller
{
    protected $module   = 'master.asuransi-properti.perlindungan-properti';
    protected $routes   = 'master.asuransi-properti.perlindungan-properti';
    protected $views    = 'master.asuransi-properti.perlindungan-properti';
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
                'title' => 'Perlindungan Properti',
                'breadcrumb' => [
                    'Data Master' => route($this->routes . '.index'),
                    'Asuransi Mobil' => route($this->routes . '.index'),
                    'Perlindungan Properti' => route($this->routes . '.index'),
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
        $records = PerlindunganProperti::grid()->filters()->dtGet();

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

    public function store(PerlindunganPropertiRequest $request)
    {
        $record = new PerlindunganProperti;
        return $record->handleStoreOrUpdate($request);
    }

    public function show(PerlindunganProperti $record)
    {
        return $this->render($this->views . '.show', compact('record'));
    }

    public function edit(PerlindunganProperti $record)
    {
        return $this->render($this->views . '.edit', compact('record'));
    }

    public function update(PerlindunganPropertiRequest $request, PerlindunganProperti $record)
    {
        return $record->handleStoreOrUpdate($request);
    }

    public function destroy(PerlindunganProperti $record)
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
        $record = new PerlindunganProperti;
        return $record->handleImport($request);
    }
}
