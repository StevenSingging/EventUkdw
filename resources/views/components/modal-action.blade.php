@props(['action', 'data'])
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal-dialog">
    <form id="form-action" action="{{ $action }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
                
        </div>
    </form>
</div>
