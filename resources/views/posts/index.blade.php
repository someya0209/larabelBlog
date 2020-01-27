@extends('layout')

@section('content')
<div class="container">
    <!-- 検索フォーム -->
    <div class="col-sm-4" style="padding:20px 0; padding-left:0px;">
    <form class="form-inline" action="{{ route('posts.search') }}">
      <div class="form-group">
      <input type="text" name="keyword" value="{{ old('keyword')}}" class="form-control" placeholder="タイトルを入力してください">
      </div>
      <input type="submit" value="検索" class="btn btn-info">
    </form>
    </div>
    <!-- 検索フォーム -->

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
            <nav class="panel panel-default">

                <div class="panel-heading"><h3>{{ $post->title }}</h3></div>
                <div class="panel-body">
                    <ul class="list-unstyled" style="font-size: medium;">
                        <li>作成時：{{ $post->created_at }}</li>
                        <li>変更時：{{ $post->modified_at }}</li><br>
                        <li>カテゴリ：{{ $post->category->title }}</li>
                        <li>タグ：
                        @foreach($post->tags as $tag)
                        {{ $tag->title }}
                        @endforeach
                        </li>
                    </ul>
                </h2>
                <!-- 本文とタグとアクション -->
                <p>{!! nl2br($post->body) !!}</p>
                <div class="list-unstyled" style="font-size: medium;">
                    <a href="{{ route('posts.view', ['post' => $post]) }}" class="btn btn-default ">
                        閲覧
                    </a>
                    <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-default ">
                        変更
                    </a>
                    <form id="delete-form" action="{{ route('posts.delete', ['post' => $post]) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-default check">削除</button>
                    </form>
                </div>
            </div>
        </nav>

        @endforeach
        {{$posts->links()}}
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

@section('script')
  <script>
  $(function(){
      $(".check").click(function(){
          if(confirm("本当に削除しますか？")){
              //そのままsubmit（削除）
          }else{
              //cancel
              return false;
          }
      });
  });
  </script>
@endsection
