@extends('layouts.layout',['title'=>'Home page'])


@section('content')

    <div class="row">
        @foreach($addresses as $address)
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        {{$address->ip}}:{{$address->port}}
                    </div>
                </div>
                    @auth
                    @if( Auth::user()->id == $address->owner || Auth::user()->role == 1)
                    <div class="card-btn">
                        <a href="{{route('address.edit',['id'=>$address->address_id])}}"
                           class=" btn btn-outline-secondary">Edit address </a>
                        <form action="{{route('address.destroy',['id'=>$address->address_id])}}"
                              method="post" onsubmit="if (confirm('Are you sure?')) {return true } else {return false}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-outline-danger" value="Delete">
                        </form>
                    </div>
                        @endif
                    @endauth
            </div>

        @endforeach
    </div>
        {{$addresses->links()}}

@endsection
