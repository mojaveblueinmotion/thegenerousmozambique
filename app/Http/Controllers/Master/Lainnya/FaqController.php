<?php

namespace App\Http\Controllers\Master\Lainnya;

use Illuminate\Http\Request;
use App\Exports\GenerateExport;
use App\Http\Controllers\Controller;
use App\Models\Master\Lainnya\Faq;
use App\Http\Requests\Master\Lainnya\FaqRequest;

class FaqController extends Controller
{
    protected $module   = 'master.lainnya.faq';
    protected $routes   = 'master.lainnya.faq';
    protected $views    = 'master.lainnya.faq';
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
                'title' => 'FAQ',
                'breadcrumb' => [
                    'Data Master' => route($this->routes . '.index'),
                    'Lainnya' => route($this->routes . '.index'),
                    'FAQ' => route($this->routes . '.index'),
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
                        $this->makeColumn('name:title|label:Judul|className:text-center'),
                        $this->makeColumn('name:description|label:Isi|className:text-center'),
                        // $this->makeColumn('name:link|label:Link|className:text-center'),
                        $this->makeColumn('name:status|label:Status|className:text-center'),
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
        $records = Faq::grid()->filters()->dtGet();

        return \DataTables::of($records)
            ->addColumn(
                'num',
                function ($record) {
                    return request()->start;
                }
            )
            ->addColumn(
                'title',
                function ($record) {
                    return "<span class='badge badge-danger'>" . $record->title . "</span>";
                }
            )
            ->addColumn('description', function ($record) {
                return  "<span class='badge badge-primary'>" . str_word_count($record->description) . " Words</span>";
            })
            // ->addColumn(
            //     'link',
            //     function ($record) {
            //         return "<span class='badge badge-warning'>" . $record->link . "</span>";
            //     }
            // )
            ->addColumn(
                'status',
                function ($record) {
                    if($record->status == 'active'){
                        return "<span class='badge badge-success'>" . ucfirst($record->status) . "</span>";
                    }
                    return "<span class='badge badge-danger'>" . ucfirst($record->status) . "</span>";
                }
            )
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
            ->rawColumns(['action', 'updated_by', 'title', 'status', 'description'])
            ->make(true);
    }

    public function create()
    {
        return $this->render($this->views . '.create');
    }

    public function store(FaqRequest $request)
    {
        $record = new Faq;
        return $record->handleStoreOrUpdate($request);
    }

    public function show(Faq $record)
    {
        return $this->render($this->views . '.show', compact('record'));
    }

    public function edit(Faq $record)
    {
        return $this->render($this->views . '.edit', compact('record'));
    }

    public function update(FaqRequest $request, Faq $record)
    {
        return $record->handleStoreOrUpdate($request);
    }

    public function destroy(Faq $record)
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
        $record = new Faq;
        return $record->handleImport($request);
    }
}
