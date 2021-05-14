@extends('layouts.app')

@section('script')
  <script>
  $(function(){
  $(".btn-dell").click(function(){
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

@section('content')
<div class="container" id="app">
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

			<form method="post" action="{{ url('menu/edit/' . $menu->id ) }}" enctype="multipart/form-data">
			@csrf

			<div class="form-group">
				<label>メニュー名: </label><br />
				<input class="form-control" type="text" name="name" value="{{old('name', $menu->name)}}" />
			</div>
      		<div class="form-group">
				<label>画像: </label><br />
				<div v-if="url">
              <img :src="url"  width="300" height="200">
			    </div>
                <div v-else>
				<img src="{{ Storage::url($menu->image)  }}"  width="300" height="200"/><br />
				</div>
				<input type="file" ref="preview" @change="uploadFile"  class="form-control" name="image">
        <div class="form-group">
          <label>値段: </label><br />
          <input class="form-control" type="text" name="price" value="{{old('price', $menu->price)}}" />
        </div>
			</div>


			<div class="mt-3">
        <input class="btn btn-primary" name="draft" type="submit" value="下書きに保存" />
				<input class="btn btn-primary" name="send" type="submit" value="投稿する" />
			</div>
			</form>

<hr />
<form method="post" action="{{ url('menu/delete/' . $menu->id ) }}">
@csrf
<input class="btn btn-primary btn-dell" type="submit" value="記事の削除" />
</form>


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
