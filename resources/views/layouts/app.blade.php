<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Test Task Website')</title>
    <meta charset="utf-8">
    @vite([
        'resources/css/base.css',
        'resources/css/comments.css',
        'resources/css/footer.css',
        'resources/css/header.css',
        'resources/css/menu.css',
        'resources/css/popup.css',
        'resources/css/profile.css'
    ])
</head>
<body data-auth="{{ auth()->check() ? 1 : null }}">
    @include('partials.header')
    @include('partials.menu')
    @include('reviews.add-comment')

    <div class="content">
        @yield('content')
    </div>

    @include('partials.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @vite([
        'resources/js/base.js',
        'resources/js/comments.js',
        'resources/js/authentication.js',
    ])
</body>
</html>
