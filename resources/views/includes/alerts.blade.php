@if (session('success'))
<div class="alert bg-success text-white shadow mb-3 alert-dismissible fade show" role="alert">
    <strong><i class="icon fa fa-fw fa-check mr-2"></i></strong>{{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('error'))
<div class="alert bg-danger text-white shadow mb-3 alert-dismissible fade show" role="alert">
    <strong><i class="icon fa fa-fw fa-exclamation-circle mr-2"></i></strong>{{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif