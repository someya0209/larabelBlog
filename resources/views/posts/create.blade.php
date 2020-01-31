@extends('layout')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col col-md-offset-3 col-md-6">
                    <nav class="panel panel-default">
                        <div class="panel-heading">記事を追加する</div>
                        <div class="panel-body">
                            @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $message)
                                <p>{{ $message }}</p>
                                @endforeach
                            </div>
                            @endif
                            <form action="{{ route('posts.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">タイトル</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                                </div>
                                <div class="form-group">
                                    <label for="body">内容</label>
                                    {{Form::textarea('body', null, ['class' => 'form-control', 'id' => 'body', 'value' => old('body')])}}
                                </div>
                                <div class="form-group">
                                    <label for="category">カテゴリ</label>
                                    <select name="category_id" id="category_id">
                                        <option value="">選択してください </option>
                                        @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                        >
                                            {{$category->title}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tag">タグ</label>
                                    @foreach ($tags as $tag)
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->title }}
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="image">画像ファイル</label>
                                    <input type="file" name="images[]">
                                    <input type="file" name="images[]">
                                    <input type="file" name="images[]">
                                    <input type="file" name="images[]">
                                    <input type="file" name="images[]">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">送信</button>
                                </div>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
@endsection
