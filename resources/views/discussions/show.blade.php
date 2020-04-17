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
        
        @if ($discussion->bestReply)
            <div class="card my-5 ">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img width="40px" height="40px" style="border-radius:50%" src="{{Gravatar::src($discussion->bestReply->owner->email)}}" alt="">
                            <strong class="ml-2">
                                {{$discussion->bestReply->owner->name}}
                            </strong>
                        </div>
                        <div>
                            <strong>BEST REPLY</strong>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!!$discussion->bestReply->content!!}
                </div>
            </div>
        @endif
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

                <div>
                    @if (auth()->user()->id == $discussion->user_id)
                        <form action="{{ route('discussions.best-reply', ['discussion' => $discussion->slug,
                        'reply' => $reply->id])}}" method="POST">
                            @csrf
                            <button class="btn btn-info text-white btn-sm" type="submit">Mark as best reply</button>
                        </form>
                    @endif
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
