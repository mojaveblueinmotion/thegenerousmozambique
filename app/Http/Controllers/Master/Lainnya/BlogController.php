<?php

namespace App\Http\Controllers\Master\Lainnya;

use Illuminate\Http\Request;
use App\Exports\GenerateExport;
use App\Http\Controllers\Controller;
use App\Models\Master\Lainnya\Blog;
use App\Http\Requests\Master\Lainnya\BlogRequest;

class BlogController extends Controller
{
    protected $module   = 'master.lainnya.blog';
    protected $routes   = 'master.lainnya.blog';
    protected $views    = 'master.lainnya.blog';
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
                'title' => 'Blog',
                'breadcrumb' => [
                    'Data Master' => route($this->routes . '.index'),
                    'Lainnya' => route($this->routes . '.index'),
                    'Blog' => route($this->routes . '.index'),
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
                        $this->makeColumn('name:link|label:Link|className:text-center'),
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
        $records = Blog::grid()->filters()->dtGet();

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
            ->addColumn(
                'link',
                function ($record) {
                    return "<span class='badge badge-warning'>" . $record->link . "</span>";
                }
            )
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
            ->rawColumns(['action', 'updated_by', 'title', 'link', 'status', 'description'])
            ->make(true);
    }

    public function create()
    {
        return $this->render($this->views . '.create');
    }

    public function store(BlogRequest $request)
    {
        $record = new Blog;
        return $record->handleStoreOrUpdate($request);
    }

    public function show(Blog $record)
    {
        return $this->render($this->views . '.show', compact('record'));
    }

    public function edit(Blog $record)
    {
        return $this->render($this->views . '.edit', compact('record'));
    }

    public function update(BlogRequest $request, Blog $record)
    {
        return $record->handleStoreOrUpdate($request);
    }

    public function destroy(Blog $record)
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
        $record = new Blog;
        return $record->handleImport($request);
    }
}
