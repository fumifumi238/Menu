<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommentModel;
use App\MenuModel;
use App\User;
use Validator;
use Auth;

class CommentController extends Controller
{
  function create(Request $request,$id){
    $menu = MenuModel::find($id);
	  $input = $request->only('content');
    $validator = Validator::make($input, [
    'content' => 'required|string|max:2000',
]);

//バリデーション失敗
if($validator->fails()){
  return redirect('menu/' . $menu->id)
    ->withErrors($validator)
    ->withInput();
}

//バリデーション成功
$comment = new CommentModel();
$comment->content = $input["content"];
$comment->user_id = Auth::id();
$comment->menu_id = $menu->id;
$comment->save();

  return redirect('menu/'.$menu->id)->withStatus("コメントしました");
}

}
