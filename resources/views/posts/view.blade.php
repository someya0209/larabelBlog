@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading">{{ $post->title }}</div>
                <div class="panel-body">

                    <div class="col-md-8">
                        <div class="box">
                            <!-- タイトル部分 -->
                                <small class="label-info" style="font-size: medium;">カテゴリ：{{ $post->category->title }}
                                    作成時：{{ $post->created_at }}
                                    変更時：{{ $post->modified_at }}
                                </small><br>
                                <small>
                                    タグ：
                                    @foreach($post->tags as $tag)
                                        {{ $tag->title }}
                                    @endforeach
                                </small>
                            <!-- 本文とタグとアクション -->
                            <p>{{ $post->body }}</p>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection
