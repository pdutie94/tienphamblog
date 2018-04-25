@if(Session::has('success'))
<div class="row">
<div class="col">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Thành công:</strong> {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
</div>
@endif

@if(count($errors)  > 0 || Session::has('error'))
<div class="row">
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Lỗi:</strong>
    <ul>
    <li>{{ Session::get('error') }}</li>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
</div>
@endif