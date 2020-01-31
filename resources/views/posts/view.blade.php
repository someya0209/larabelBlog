@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading">
                    <h2>{{ $post->title }}</h2>
                </div>
                <div class="panel-body">

                    <div class="col-md-8">
                        <div class="box">
                            <!-- タイトル部分 -->
                            <ul style="font-size: medium;">
                                <li>作成時：{{ $post->created_at }}</li>
                                <li>変更時：{{ $post->modified_at }}</li>
                                <li>カテゴリ：{{ $post->category->title }}</li>
                                <li>タグ：
                                @foreach($post->tags as $tag)
                                {{ $tag->title }}
                                @endforeach
                                </li>
                            </ul>
                            <!-- 本文とタグとアクション -->
                            <p>{!! nl2br($post->body) !!}</p>
                            @if($post->images)
                            @foreach($post->images as $image)
                            <img src="{{ asset('storage/images/' . $post->id . '/' . $image->filename) }}" width="40" height="40" alt="no_goods_image" />
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection
