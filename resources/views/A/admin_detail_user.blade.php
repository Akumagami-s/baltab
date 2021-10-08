@extends('welcome')
@section('View')
<form src="datapok/update" method="get">
    <input type="number" name="NRP">
    <button type="submit">kirim data</button>
</form>
@if(!empty($data))
<form action="/datapok/update" method="POST">
    @csrf
    @foreach ($data as $key=>$item)
    <h4>{{$key}}</h4><input type="text" name="{{$key}}" value="{{$item}}"><br>
    @endforeach
    <button type="submit">kirim</button>
</form>
@endif
{{-- untuk update data  --}}
@endsection
