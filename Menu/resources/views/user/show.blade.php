@extends('layouts.app')

@section('content')
<div>
<div style="width: 18rem; float:left; margin: 16px;">
  <p>ユーザー名: {{ $user->name }}</p>
  <p>メールアドレス:　{{ $user->email }} </p>
  <a href="{{ url('user/edit/'.$user->id) }}">
    <p>編集する<p>
  </a>
  <a href="{{ url('menu/draft') }}">
    <p>下書き一覧<p>
  </a>
</div>
<h1>これまでの投稿</h1>
@if(count($menus) < 1)
<p>投稿がありません</p>
@endif
@foreach($menus as $menu)
<div style="width: 18rem; float:left; margin: 16px;">
  <p>メニュー名: {{ $menu->name }}</p>
  <a href="{{ url('menu/' . $menu->id) }}">
  <img src="{{ Storage::url($menu->image) }}" style="width:100%;"/>
    </a>
    <p>値段:　{{ $menu->price }} 円</p>
</div>
@endforeach
</div>
@endsection
