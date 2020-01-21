<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo App</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <header>
        <nav class="my-navbar">
          <a class="my-navbar-brand" href="/">ToDo App</a>
          <a class="my-navbar-brand" href="{{ route('posts.index') }}">記事一覧</a>
          <a class="my-navbar-brand" href="{{ route('categories.index') }}">カテゴリ一覧</a>
        </nav>
    </header>
    <main>
        <div class="container">

            <!-- 各ブログの内容表示とインフォメーション　-->
            <div class="row">
                <div class="col-md-12" id="title">
                    <div class="box">
                        <h1>
                            Posts<br>
                        </h1>
                    </div>
                </div>

            </div>
            <div class="row">
                <!-- 各ブログの内容表示 -->
                <div class="col-md-8">
                    @foreach($posts as $post)
                    <div class="box">
                        <!-- タイトル部分 -->
                        <h2>{{ $post->title }}<br>
                            <small class="label-info" style="font-size: medium;">カテゴリ：{{ $post->category->title }}
                                作成時：{{ $post->created_at }}
                                変更時：{{ $post->modified_at }}
                            </small>
                        </h2>
                        <!-- 本文とタグとアクション -->
                        <p>{{ $post->body }}</p>
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="col-md-4">
                <div class="box">
                    <div class="well">
                        <h3>About</h3>
                        <p>Bootstrapの練習のためのブログぺージ</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
