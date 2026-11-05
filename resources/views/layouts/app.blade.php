<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Blog con Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <header class="blog-header lh-1 py-3"></header>

        <nav class="nav-scroller py-1 mb-2 border-bottom"></nav>
    </div>

    <main class="container">
        @yield('content')
    </main>

    <footer class="blog-footer text-center py-4 bg-body-tertiary">
        <p>Blog template built for Bootstrap by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>