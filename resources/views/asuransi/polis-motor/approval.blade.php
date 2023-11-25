@extends('layouts.page', ['container' => 'container'])

@section('content-body')
@method('POST')
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
		@if(!empty($record->status) && $record->status == 'pending')
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
	</div>
</div>

<div class="container-fluid">
    <div class="card-footer">
        <div class="d-flex justify-content-between">
            @include('layouts.forms.btnBack')
            @include('layouts.forms.btnDropdownApproval')
            @include('layouts.forms.modalReject')
        </div>
    </div>
</div>
@endsection