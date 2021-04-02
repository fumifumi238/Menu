@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">記事の編集</div>
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

			<form method="post" action="{{ url('user/edit/' . $user->id ) }}" enctype="multipart/form-data">
			@csrf

			<div class="form-group">
				<label>名前: </label><br />
				<input class="form-control" type="text" name="name" value="{{old('name', $user->name)}}" />
			</div>

			<div class="mt-3">
				<input class="btn btn-primary" type="submit" value="保存" />
			</div>
			</form>
		</div>
	</div>
</div>
@endsection
