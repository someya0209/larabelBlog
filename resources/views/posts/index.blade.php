<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
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
			<!-- チェック用 -->
			<div class="box">
				<!-- タイトル部分 -->
				<h2>{{ $post->title }}<br>
					<small style="font-size: medium;">{{ $post->category->title }}
						{{ $post->created_at }}
						{{ $post->modified_at }}</small></h2>
				<!-- 本文とタグとアクション -->
				<p>{{ $post->body }}</p>
				<p>
			</div>
			@endforeach
		<div class="col-md-4">
			<div class="box">
				<div class="well">
					<h3>About</h3>
					<p>Bootstrapの練習のためのブログぺージ</p>
				</div>
			</div>
		</div>

	</div>
</div>
</div>
