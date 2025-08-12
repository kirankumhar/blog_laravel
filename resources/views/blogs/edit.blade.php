<x-layout>
    <div class="container mt-4">
        <h2>Edit Blog</h2>
            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select"  required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" rows="5" class="form-control" required>{{ $blog->content }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label><br>
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" width="200">
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload New Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="draft" {{ old('status', $blog->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $blog->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <button type="submit">Update</button>

            </form>
    </div>
</x-layout>