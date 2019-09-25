@extends('layouts.layout',['title'=>'List of users'])


@section('content')

    @foreach($users as $user)
    <form action="{{route('address.newLogin',[$user->id])}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="col">
                <div class="col-6">
        <input class="btn btn-outline-secondary" type="submit" value="{{$user->name}}">
            </div>
            </div>

    </form>
    @endforeach

@endsection
