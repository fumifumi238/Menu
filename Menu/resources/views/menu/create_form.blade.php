@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">記事の作成</div>
		<div class="card-body">
			@if ($errors->any())
			<div style="color:red;">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			</div>
			@endif
      <form method="post" action="{{ url('/menu/create') }}"
               enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label>メニュー名: </label><br />
				<input class="form-control" type="text" name="name" value="{{old('name')}}" />
			</div>

			<div class="form-group">
				<label>画像: </label><br />
				<!-- アップロードした画像を保存したい -->
					<input type="file" name="image" accept="image/png, image/jpeg" value="{{old('image')}}"/>
			</div>
			<br />

      <div class="form-group">
        <label>値段: </label><br />
        <input class="form-control" type="text" name="price" value="{{old('price')}}" />
      </div>
			<div class="mt-3">
				<input class="btn btn-primary" name="draft" type="submit" value="下書きに保存" />
				<input class="btn btn-primary" name="send" type="submit" value="投稿する" />
			</div>

			</form>
			<a href="{{ url('menu/draft') }}">
				<p>下書き一覧<p>
			</a>
		</div>
	</div>
</div>
@endsection
