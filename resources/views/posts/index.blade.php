@extends('layout')

@section('content')
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
@endsection
