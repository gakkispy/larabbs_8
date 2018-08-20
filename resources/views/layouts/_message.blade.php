@if (Session::has('message'))
    <div class="alert alert-info">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('message') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session('success') }}
    </div>
@endif

@if (Session::has('danger'))
    <div class="alert alert-danger">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('danger') }}
    </div>
@endif