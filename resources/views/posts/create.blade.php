<x-layout>
    <h1>Create New Post</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <label>Title:</label><br>
        <input type="text" name="title"><br><br>

        <label>Content:</label><br>
        <textarea name="content"></textarea><br><br>

        <button type="submit">Create Post</button>
    </form>
</x-layout>