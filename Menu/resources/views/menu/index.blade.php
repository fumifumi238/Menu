@extends('layouts.app')

@section('content')
<h1>メニュー一覧</h1>
@foreach($menus as $menu)
@if($menu->draft == false)
<div style="width: 18rem; float:left; margin: 16px;">
  <p>投稿者: {{$menu->user->name}}</p>
  <p>メニュー名: {{ $menu->name }}</p>
  <a href="{{ url('menu/' . $menu->id) }}">
	<img src="{{ Storage::url($menu->image) }}" style="width:100%;"/>
    </a>
    <p>値段:　{{ $menu->price }} 円</p>
</div>
@endif
@endforeach

@endsection
