<?php

namespace App\Http\Controllers\Asuransi\PolisMotor;

use Illuminate\Http\Request;
use App\Models\AsuransiMotor\PolisMotor;
use App\Http\Controllers\Controller;
use App\Http\Requests\AsuransiMotor\PolisMotorRequest;
use App\Http\Requests\AsuransiMotor\PolisMotorDetailRequest;

class PolisMotorController extends Controller
{
    protected $module = 'asuransi.polis-motor';
    protected $routes = 'asuransi.polis-motor';
    protected $views = 'asuransi.polis-motor';
    protected $perms = 'asuransi.polis-motor';

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
                    'Asuransi' => route($this->routes . '.index'),
                    'Asuransi Motor' => route($this->routes . '.index'),
                ],
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
                        $this->makeColumn('name:no_asuransi|label:No Asuransi|className:text-center'),
                        $this->makeColumn('name:tanggal|label:Tanggal|className:text-center'),
                        $this->makeColumn('name:asuransi_id|label:Asuransi|className:text-center'),
                        $this->makeColumn('name:name|label:Client|className:text-center'),
                        $this->makeColumn('name:status'),
                        $this->makeColumn('name:updated_by|label:Diperbarui|width:130px'),
                        $this->makeColumn('name:action'),
                    ]
                ]
            ]
        );

        return $this->render($this->views . '.index');
    }

    public function grid()
    {
        $user = auth()->user();
        $records = PolisMotor::grid()->filters()->dtGet();

        return \DataTables::of($records)
            ->addColumn(
                'num',
                function () {
                    return request()->start;
                }
            )
            ->addColumn(
                'no_asuransi',
                function ($records) use ($user) {
                    $agent = $records->agent_id ? $records->agent->name : 'By System';
                    return '<span class="badge badge-primary">' . $agent . '</span><br><span class="badge badge-danger">' . $records->no_asuransi . '</span>';
                }
            )
            ->addColumn(
                'tanggal',
                function ($records) use ($user) {
                    return '<span class="badge badge-info">' . $records->tanggal->format('d/m/Y') . '</span>';
                }
            )
            ->addColumn(
                'asuransi_id',
                function ($records) use ($user) {
                    return '<span class="badge badge-warning">' . $records->asuransi->name ?? '' . '</span>';
                }
            )
            ->addColumn(
                'name',
                function ($records) use ($user) {
                    return '<span class="badge badge-danger">' . $records->name . '</span><br><span class="badge badge-primary">' . $records->phone . '</span><br><span class="badge badge-info">' . $records->email . '</span>';
                }
            )
            ->addColumn(
                'status',
                function ($records) use ($user) {
                    return $records->labelStatus($records->status ?? 'new');
                }
            )
            ->editColumn(
                'updated_by',
                function ($records) use ($user) {
                    if ($records->status == 'new' || empty($records->status)) {
                        return '';
                    } else {
                        return $records->createdByRaw();
                    }
                }
            )
            ->addColumn(
                'action',
                function ($records) use ($user) {
                    $actions = [];
                    if ($records->checkAction('show', $this->perms)) {
                        $actions[] = [
                            'type' => 'show',
                            'label' => 'Lihat',
                            'page' => true,
                            'url' => route($this->routes . '.detail.show', $records->id),
                        ];
                    }
                    if ($records->checkAction('edit', $this->perms)) {
                        $actions[] = [
                            'type' => 'edit',
                            'label' => 'Detail',
                            'icon'  => 'fa fa-plus text-primary',
                            'page' => true,
                            'url' => route($this->routes . '.detail', $records->id),
                        ];
                        $actions[] = [
                            'type' => 'edit',
                        ];
                    }
                    if ($records->checkAction('delete', $this->perms)) {
                        $actions[] = 'type:delete';
                    }
                    if ($records->checkAction('approval', $this->perms)) {
                        $actions[] = 'type:approval|page:true';
                    }
                    if ($records->checkAction('tracking', $this->perms)) {
                        $actions[] = 'type:tracking';
                    }
                    if ($records->checkAction('history', $this->perms)) {
                        $actions[] = 'type:history';
                    }
                    if ($records->checkAction('print', $this->perms)) {
                        $actions[] = 'type:print';
                    }

                    return $this->makeButtonDropdown($actions, $records->id);
                }
            )
            ->rawColumns(
                [
                    'no_asuransi',
                    'tanggal',
                    'asuransi_id',
                    'name',
                    'status',
                    'updated_by',
                    'action',
                ]
            )
            ->make(true);
    }

    public function detail(PolisMotor $record)
    {
        return $this->render($this->views . '.detail.index', compact('record'));
    }

    public function detailShow(PolisMotor $record)
    {
        return $this->render($this->views . '.detail.index', compact('record'));
    }

    public function create()
    {
        $noAsuransi = PolisMotor::generateNoAsuransi();
        return $this->render($this->views . '.create', compact('noAsuransi'));
    }

    public function store(PolisMotorRequest $request, PolisMotor $detail)
    {
        return $detail->handleStoreOrUpdate($request);
    }

    public function show(PolisMotor $record)
    {
        return $this->render($this->views . '.show', compact('record'));
    }

    public function edit(PolisMotor $record)
    {
        return $this->render($this->views . '.edit', compact('record'));
    }

    public function update(PolisMotorRequest $request, PolisMotor $record)
    {
        return $record->handleStoreOrUpdate($request);
    }

    public function submit(PolisMotor $record)
    {
        $flowApproval = $record->getFlowApproval($this->module);
        return $this->render($this->views . '.submit', compact('record', 'flowApproval'));
    }

    public function submitSave(PolisMotor $record, PolisMotorDetailRequest $request)
    {
        return $record->handleSubmitSave($request);
    }

    public function reject(PolisMotor $record, Request $request)
    {
        $request->validate(['note' => 'required|string|max:65500']);
        return $record->handleReject($request);
    }

    public function approval(PolisMotor $record)
    {
        return $this->render($this->views . '.approval', compact('record'));
    }

    public function approve(PolisMotor $record, Request $request)
    {
        return $record->handleApprove($request);
    }

    public function history(PolisMotor $record)
    {
        $this->prepare(['title' => 'History Aktivitas']);
        return $this->render('globals.history', compact('record'));
    }

    public function tracking(PolisMotor $record)
    {
        $this->prepare(['title' => 'Tracking Approval']);
        return $this->render('globals.tracking', compact('record'));
    }

    public function print(PolisMotor $record)
    {
        $title = $this->prepared('title') . ' ' . date_format(date_create($record->created_at), 'Y');
        $module = $this->prepared('module');
        $pdf = \PDF::loadView($this->views . '.print', compact('title', 'module', 'record'))
            ->setPaper('a4', 'portrait');
        return $pdf->stream(date('Y-m-d') . ' ' . $title . '.pdf');
    }

    public function destroy(PolisMotor $record)
    {
        return $record->handleDestroy();
    }
}
