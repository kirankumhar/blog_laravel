<x-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>All Blogs</h2>
            <a href="{{ route('blogs.create') }}" class="btn btn-primary">+ Add Blog</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <form method="GET" action="{{ route('blogs.index') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search blogs..." />
                <button type="submit">Search</button>
            </form>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'title',
                            'sort_order' => ($sortBy === 'title' && $sortOrder === 'asc') ? 'desc' : 'asc'
                        ]) }}">
                            Title
                            @if($sortBy === 'title')
                                {{ $sortOrder === 'asc' ? '↑' : '↓' }}
                            @endif
                        </a>
                    </th>
                    <th>category</th>
                    <th>Image</th>
                    <th width="180">Actions</th>
                    <th>Status</th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'created_at',
                            'sort_order' => ($sortBy === 'created_at' && $sortOrder === 'asc') ? 'desc' : 'asc'
                        ]) }}">
                            Date
                            @if($sortBy === 'created_at')
                                {{ $sortOrder === 'asc' ? '↑' : '↓' }}
                            @endif
                        </a>
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                    <tr>
                        <td>{{ $loop->iteration + ($blogs->currentPage() - 1) * $blogs->perPage() }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->category->title ?? 'No Category' }}</td>
                        <td>
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" width="150">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                            </form>
                        </td>
                        <td>
                            @if($blog->status === 'published')
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>{{ $blog->created_at }}</td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $blogs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</x-layout>