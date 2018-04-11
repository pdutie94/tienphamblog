@if(Session::has('success'))
<div class="span12">
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Thành công:</strong> {{ Session::get('success') }}
</div>
</div>
@endif

@if(count($errors)  > 0 || Session::has('error'))
<div class="span12">
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Lỗi:</strong>
    <ul>
    <li>{{ Session::get('error') }}</li>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
</div>
@endif