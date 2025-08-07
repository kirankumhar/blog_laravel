<x-layout>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <a href="{{ route('posts.index') }}"><- Back to Posts</a>
</x-layout>