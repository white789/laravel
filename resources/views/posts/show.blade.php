@extends('layouts.app')

@section('title', $posts['title'])

@section('content')
    @if($posts['is_new'])
        <div>
            A new blog post using if
        </div>
    @else
        <div>
            An old post
        </div>

    @endif
    <h1>{{ $posts['title'] }}</h1>

    <p>{{ $posts['content'] }}</p>


    @isset($posts['has_comments'])
        <div>The post has some comments</div>
    @endisset
@endsection
