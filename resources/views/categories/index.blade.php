@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">カテゴリ</div>
          <div class="panel-body">
            <a href="{{ route('categories.create') }}" class="btn btn-default btn-block">
              カテゴリを追加する
            </a>
          </div>
          <div class="list-group">
            @foreach($categories as $category)
              <a href="{{ route('categories.index') }}" class="list-group-item">
                {{ $category->title }}
              </a>
            @endforeach
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
        <!-- ここにタスクが表示される -->
      </div>
    </div>
  </div>
@endsection
