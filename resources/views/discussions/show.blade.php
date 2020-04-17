@extends('layouts.app')

@section('content')

<div class="card">
    @include('partials.discussion-header')

    <div class="card-body">

        <div class="text-center">
            <h1>{{ $discussion->title }}</h1>
        </div>

        <hr>

        {!! $discussion->content !!}
    </div>
</div>

@foreach ($discussion->replies()->paginate(3) as $reply)
    <div class="card my-5">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <img width="40px" height="40x" style="border-radius:50%" src="{{Gravatar::src($reply->owner->email)}}" alt="">
                    <span class="ml-2">{{$reply->owner->name}}</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            {!!$reply->content!!}
        </div>
    </div>

@endforeach

{{$discussion->replies()->paginate(3)->links()}}

<div class="card my-5">
    <div class="card-header">Add a reply</div>
    <div class="card-body">
        @auth
        <form action="{{route('replies.store', $discussion->slug)}}" method="POST">
            @csrf
            <input type="hidden" name="content" id="content">
            <trix-editor input="content"></trix-editor>

            <button class="btn btn-success mt-3 btn-sm" type="submit">Add Reply</button>
        </form>
        @else
        <a href="{{route('login')}}" class="btn btn-info w-100 text-white">Sign in to add a reply</a>
        @endauth
    </div>
</div>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection
