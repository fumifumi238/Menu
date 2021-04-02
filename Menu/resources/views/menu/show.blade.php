@extends('layouts.app')

@section('content')
@if ($errors->any())
<div style="color:red;">
<ul>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
</div>
@endif
<div style="width: 18rem; float:left; margin: 16px;">
  <p>メニュー名: {{ $menu->name }}</p>
	<img src="{{ Storage::url($menu->image) }}" style="width:100%;"/>
  	<p>値段:　{{ $menu->price }} 円</p>
    @auth
    @if($menu->user_id == Auth::user()->id )
    <a href="{{ url('menu/edit/'.$menu->id) }}">
      <p>編集する<p>
    </a>
    @endif
    <form method="post" action="{{ url('/comment/'.$menu->id.'/create') }}">
    @csrf
    <div class="form-group">
      <label>コメント</label><br />
      <input class="form-control" type="text" name="content" value="{{old('content')}}" />
    </div>
    <div class="mt-3">
      <input class="btn btn-primary" type="submit" value="コメントする" />
    </div>
    </form>
    @endauth
    <h1>コメント一覧</h1>
    @foreach($comments as $comment)
    <div>
      <p>投稿者: {{$comment->user->name}}</p>
        <p>{{ $comment->content }}</p>
    </div>
    @endforeach

</div>
@endsection
