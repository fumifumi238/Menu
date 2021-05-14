@extends('layouts.app')

@section('content')
<div class="container" id="app">
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
				<div v-if="url">
              <img :src="url"  width="300" height="200">
             </div>
					<input type="file"  ref="preview" @change="uploadFile" 
					name="image" accept="image/png, image/jpeg" value="{{old('image')}}"/>
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
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
	<script>
     new Vue({
        el: "#app",
        data() {
  return {
    url:""
  }
},
methods:{
  uploadFile(){
      const file = this.$refs.preview.files[0];
      this.url = URL.createObjectURL(file)
  }
}
      })
    </script>
</div>
@endsection
