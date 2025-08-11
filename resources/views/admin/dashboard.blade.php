<x-layout>
    <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-3 gap-6">
        <div class="bg-blue-500 text-white p-4 rounded-lg">
            <h2 class="text-lg">Total Blogs</h2>
            <p class="text-2xl font-bold">{{ $totalBlogs }}</p>
        </div>
        <div class="bg-green-500 text-white p-4 rounded-lg">
            <h2 class="text-lg">Total Categories</h2>
            <p class="text-2xl font-bold">{{ $totalCategories }}</p>
        </div>
        <div class="bg-purple-500 text-white p-4 rounded-lg">
            <h2 class="text-lg">Total Users</h2>
            <p class="text-2xl font-bold">{{ $totalUsers }}</p>
        </div>
    </div>

    {{-- Recent Blogs --}}
    <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">Recent Blogs</h2>
        <table class="min-w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Title</th>
                    <th class="border p-2">Category</th>
                    <th class="border p-2">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentBlogs as $blog)
                <tr>
                    <td class="border p-2">{{ $blog->title }}</td>
                    <td class="border p-2">{{ $blog->category->name ?? 'Uncategorized' }}</td>
                    <td class="border p-2">{{ $blog->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-layout>