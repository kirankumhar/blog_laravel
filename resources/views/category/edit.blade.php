<x-layout>
    <div class="container mt-4">
        <h2 class="mb-4">Edit Category</h2>

        <!-- Show validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Category Create Form -->
        <form action="{{ route('category.update', $categories->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Category Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $categories->title }}" required>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ $categories->slug }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-layout>
