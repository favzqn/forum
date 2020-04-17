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
@endsection
