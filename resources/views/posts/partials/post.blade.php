{{--        @break($key == 2)--}}
{{--    @continue($key == 1)--}}
@if($loop->even)
    <h1>{{ $key }}.{{ $post->title }}</h1>
@else
    <h1 style="background-color: silver">{{ $key }}.{{ $post->title }}</h1>
@endif

<div>
    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>
</div>
