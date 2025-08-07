<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('posts.index') }}">My Blog</a>
        </div>
    </nav>

    <div class="container">
        {{ $slot }}
    </div>

    <footer class="text-center mt-5 mb-3">
        <small>&copy; {{ date('Y') }} My Blog</small>
    </footer>
</body>
</html>