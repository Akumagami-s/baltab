
<form action="/baltab/datapok/update" method="POST">
    @csrf
    @foreach ($data as $key=>$item)
    <h4>{{$key}}</h4><input type="text" name="{{$key}}" value="{{$item}}"><br>
    @endforeach
    <button type="submit">kirim</button>
</form>
