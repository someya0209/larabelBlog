<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>練習ブログ</title>
    @yield('styles')
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <header>
        <nav class="my-navbar">
            <a class="my-navbar-brand" href="/">ToDo App</a>
            <a class="my-navbar-brand" href="{{ route('posts.index') }}">記事一覧</a>
            <a class="my-navbar-brand" href="{{ route('posts.create') }}">記事作成</a>
            <a class="my-navbar-brand" href="{{ route('categories.index') }}">カテゴリ一覧</a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    @yield('scripts')
</body>
</html>
