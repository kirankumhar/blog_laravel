<x-layout>
    <h1>Edit Blog Post</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Title:</label><br>
        <input type="text" name="title" value="{{ old('title', $post->title) }}"><br><br>

        <label>Content:</label><br>
        <textarea name="content" rows="5">{{ old('content', $post->content) }}</textarea><br><br>

        <button type="submit">Update Post</button>
    </form>
</x-layout>