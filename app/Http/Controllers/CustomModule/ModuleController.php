<?php

namespace App\Http\Controllers\CustomModule;

use Illuminate\Http\Request;
use App\Models\Master\Lainnya\Faq;
use Illuminate\Support\Collection;
use App\Models\CustomModule\Module;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\Lainnya\FaqRequest;
use App\Http\Requests\CustomModule\ModuleRequest;

class ModuleController extends Controller
{
    protected $module   = 'custom-module.module';
    protected $routes   = 'custom-module.module';
    protected $views    = 'custom-module.module';
    protected $perms    = 'custom-module.module';

    public function __construct()
    {
        $this->prepare(
            [
                'module' => $this->module,
                'routes' => $this->routes,
                'views' => $this->views,
                'perms' => $this->perms,
                'permission' => $this->perms . '.view',
                'title' => 'Module',
                'breadcrumb' => [
                    'Custom Module' => route($this->routes . '.index'),
                    'Module' => route($this->routes . '.index'),
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
        $records = Module::grid()->filters()->dtGet();

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
            ->addColumn(
                'description', 
                function ($record) {
                    return  "<span class='badge badge-primary'>" . str_word_count($record->description) . " Words</span>";
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
                        if ($record->checkAction('show', $this->perms)) {
                            $actions[] = 'type:show|page:true';
                        }
                        if ($record->checkAction('edit', $this->perms)) {
                            $actions[] = 'type:edit|page:true';
                        }
                        if ($record->checkAction('approval', $this->perms)) {
                            $actions[] = 'type:approval|page:true';
                        }
                        if ($record->checkAction('revisi', $this->perms)) {
                            $actions[] = [
                                'icon' => 'fa fa-sync text-warning',
                                'label' => 'Revisi',
                                'url' => route($this->routes . '.revisi', $record->id),
                                'class' => 'base-form--postByUrl',
                                'attrs' => 'data-swal-ok="Revisi" data-swal-text="Revisi akan melalui proses approval terlebih dahulu. Data yang telah di-revisi akan dikembalikan ke status draft untuk dapat diperbarui!"',
                            ];
                        }
                        if ($record->checkAction('print', $this->perms)) {
                            $actions[] = 'type:print';
                        }
                        if ($record->checkAction('tracking', $this->perms)) {
                            $actions[] = 'type:tracking';
                        }
                        if ($record->checkAction('history', $this->perms)) {
                            $actions[] = 'type:history';
                        }
                        
                        if ($record->checkAction('delete', $this->perms)) {
                            $actions[] = 'type:delete';
                        }
                    return $this->makeButtonDropdown($actions, $record->id);
                }
            )
            ->rawColumns(['action', 'updated_by', 'title', 'status', 'description'])
            ->make(true);
    }

    public function create()
    {
        return $this->render($this->views . '.create');
    }

    public function store(ModuleRequest $request)
    {
        // dd($request->details);
        $record = new Module;
        return $record->handleStoreOrUpdate($request);
    }

    public function show(Module $record)
    {
        $decode =json_decode($record->details->data, true); 
        $data = collect($decode);

        return $this->render($this->views . '.show', compact('record', 'data'));
    }

    public function edit(Module $record)
    {
        $decode =json_decode($record->details->data, true); 
        $data = collect($decode);
        return $this->render($this->views . '.edit', compact('record', 'data'));
    }

    public function update(ModuleRequest $request, Module $record)
    {
        return $record->handleStoreOrUpdate($request);
    }

    public function destroy(Module $record)
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
        $record = new Module;
        return $record->handleImport($request);
    }
}
