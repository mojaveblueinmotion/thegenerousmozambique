@extends('layouts.lists')
@section('filters')
	{{-- <div class="row">
        @include('globals.filters')
	</div> --}}
@endsection

@section('buttons-right')
    @if (auth()->user()->checkPerms($perms.'.create'))
    <a href="{{ $urlAdd ?? (\Route::has($routes.'.create') ? route($routes.'.create') : 'javascript:;') }}"
        class="btn btn-info base-content--replace }}"
        data-modal-size="{{ $modalSize ?? 'modal-lg' }}"
        data-modal-backdrop="false"
        data-modal-v-middle="false">
        <i class="fa fa-plus"></i> Data
    </a>
	@endif
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.content-page').on('change', 'select.filter-control.filter-type-id', function(e) {
                var me = $(this);
                if (me.val()) {
                    var objectId = $('select.filter-object');
                    var urlOrigin = objectId.data('url-origin');
                    var urlParam = $.param({
                        category: 'by_type',
                        type_id: me.val()
                    });
                    objectId.data('url', decodeURIComponent(decodeURIComponent(urlOrigin + '?' +
                        urlParam)));
                    objectId.val(null).prop('disabled', false);
                }
                BasePlugin.initSelect2();
            });


            $('.content-page').on('click', '.reset-filter .reset.button', function(e) {
                var objectId = $('select.filter-object');
                var urlOrigin = objectId.data('url-origin');
                var urlParam = $.param({
                    category: ''
                });
                objectId.data('url', decodeURIComponent(decodeURIComponent(urlOrigin + '?' + urlParam)));
                objectId.val(null).prop('disabled', false);
                BasePlugin.initSelect2();
            });
        });
    </script>
@endpush

