<x-layout>
    <h1>Edit Blog Post</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Title</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" required><br><br>

        <label>Content</label>
        <textarea name="content" required>{{ old('content', $post->content) }}</textarea><br><br>

        <label>Image</label>
        <input type="file" name="image">

        @if($post->image)
            <p>Current Image:</p>
            <img src="{{ asset('storage/' . $post->image) }}" width="150"><br><br>
        @endif

        <button type="submit">Update Post</button>
    </form>
</x-layout>