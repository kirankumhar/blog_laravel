<x-layout>
    <h1>Create New Post</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Title:</label><br>
        <input type="text" name="title"><br><br>

        <label>Content:</label><br>
        <textarea name="content"></textarea><br><br>

        <input type="file" name="image" id=""> <br><br>

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</x-layout>