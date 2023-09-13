@extends('layouts.page')

@section('content-body')
<div class=" flex-column-fluid">
	<form action="{{ route($routes.'.submitSave', $record->id)}}" method="POST" autocomplete="off">
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="container-fluid">
			<div class="card card-custom">
				<div class="card-header">
					<h3 class="card-title">Asuransi Motor</h3>
					<div class="card-toolbar">
						@section('card-toolbar')
						@include('layouts.forms.btnBackTop')
						@show
					</div>
				</div>
				<div class="card-body">
					@include($views.'.includes.notes')
					@include($views.'.includes.header')
					<hr>
				</div>
			</div>
		</div>
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-custom">
						<div class="card-header">
							<h3 class="card-title">Pengecekan Motor</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-cek')
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-custom">
						<div class="card-header">
							<h3 class="card-title">Nilai Motor</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-nilai')
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-custom">
						<div class="card-header">
							<h3 class="card-title">Foto Motor</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-file')
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-custom">
						<div class="card-header">
							<h3 class="card-title">Detail Client</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-client')
						</div>
					</div>
				</div>
			</div>
		</div>
		@if(!empty($record->status) && ($record->status == 'pending' || $record->status == 'waiting.approval' || $record->status == 'completed'))
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-custom">
						<div class="card-header">
							<h3 class="card-title">Pembayaran</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							@include($views.'.detail.detail-payment')
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		@if(request()->route()->getName() != $routes.'.detail.show')
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-6">
					<div class="card card-custom">
						<div class="card-header">
							<h3 class="card-title">Alur Persetujuan</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body text-center">
							@php
							$colors = [
							1 => 'primary',
							2 => 'info',
							];
							@endphp
							@if ($menu = \App\Models\Setting\Globals\Menu::where('module',
							'asuransi.polis-motor')->first())
							@if ($menu->flows()->get()->groupBy('order')->count() == null)
							<span class="label label-light-info font-weight-bold label-inline" data-toggle="tooltip">Belum
								memiliki Alur Persetujuan.</span>
							@else
							@foreach ($orders = $menu->flows()->get()->groupBy('order') as $i => $flows)
							@foreach ($flows as $j => $flow)
							<span class="label label-light-{{ $colors[$flow->type] }} font-weight-bold label-inline"
								data-toggle="tooltip" title="{{ $flow->show_type }}">{{ $flow->role->name }}</span>
							@if (!($i === $orders->keys()->last() && $j === $flows->keys()->last()))
							<i class="mx-2 fas fa-angle-double-right text-muted"></i>
							@endif
							@endforeach
							@endforeach
							@endif
							@endif
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card card-custom">
						<div class="card-header">
							<h3 class="card-title">Aksi</h3>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-end">
								Sebelum submit, pastikan isian data sudah lengkap dan alur persetujuan sudah benar.
								@include('layouts.forms.btnDropdownSubmit')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
@endsection

@section('buttons')
@endsection