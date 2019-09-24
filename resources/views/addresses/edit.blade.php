@extends('layouts.layout',['title'=>'Edit address'])


@section('content')

    <form action="{{route('address.update',['id'=>$address->address_id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <h3>Edit address</h3>
        <div class="form-group">
            <h4>Edit IP</h4>
            <input type="text" class="form-control" name="ip" autofocus value="{{$address->ip}}">
        </div>
        <div class="form-group">
            <h4>Edit Port</h4>
            <input type="text" class="form-control" name="port" value="{{$address->port}}">
        </div>
        <input type="submit" value="Edit address" class="btn btn-outline-success">
    </form>

@endsection
