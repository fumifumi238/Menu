@extends('layouts.app')

@section('content')
<h1>下書き一覧</h1>
@if(count($menus) < 1 )
<p>下書きはありません</p>
@endif
@foreach($menus as $menu)
<div style="width: 18rem; float:left; margin: 16px;">
  <p>メニュー名: {{ $menu->name }}</p>
  <a href="{{ url('menu/edit/'.$menu->id) }}">
	<img src="{{ Storage::url($menu->image) }}" style="width:100%;"/>
    </a>
    <p>値段:　{{ $menu->price }} 円</p>
</div>
@endforeach

@endsection
