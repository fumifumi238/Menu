<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\MenuModel;
use App\CommentModel;
use Validator;
use Auth;

class MenuController extends Controller
{

  function showCreateForm(){
		return view("menu.create_form");
	}

  function vue(){
    return view("menu.vue");
  }

	function create(Request $request){

	  $input = $request->only('name', 'image', 'price');
    $validator = Validator::make($input, [
    'name' => 'required|string|max:50',
    'image' => 'required|file|image|mimes:png,jpeg',
    'price' => 'required|integer|digits_between:1,6'
]);

if($validator->fails()){
  return redirect('/menu/create')
    ->withErrors($validator)
    ->withInput();
}


    $menu = new MenuModel();
    $menu->name = $input["name"];
    $menu->image = $input["image"]->store('uploads',"public");
    $menu->price = $input["price"];
    $menu->user_id = Auth::id();
    if($request->has('draft')){
      $menu->draft = true;
      $menu->save();
       return redirect("/menu/index")->withStatus("下書きに保存しました");
 }
 if($request->has('send')){
   $menu->draft = false;
   $menu->save();
		return redirect("/menu/index")->withStatus("投稿しました");
  }

	}

  function index(){
   //アップロードした画像を取得

   $uploads = MenuModel::orderBy("id", "desc")->get();

   return view("menu.index",[
     "menus" => $uploads
   ]);

 }


 function show($id){
   $menu = MenuModel::find($id);
   $comments = $menu->CommentModel()->get();
   return view("menu.show", [
 "menu" => $menu,
 "comments"=>$comments
]);

 }

 function showEditForm ($id){
    $menu = MenuModel::find($id);
    if($menu->user_id == Auth::user()->id){
      return view("menu.edit_form",[
      "menu" => $menu]);
   }else{
      return redirect("/menu/index")->withStatus("そのページにはアクセスできません。");
  }
 }



 function update (Request $request, $id){
   $menu = MenuModel::find($id);
   if(!$menu){
     return redirect("/menu/index")->withStatus("投稿がありません");
   }
   /* 入力値の受け取り */
   $input = $request->only('name', 'price');
    $validator = Validator::make($input, [
    'name' => 'required|string|max:50',
    'price' => 'required|integer|digits_between:1,6'
]);


   //バリデーション失敗
   if($validator->fails()){
     return redirect('menu/edit/' . $menu->id)
       ->withErrors($validator)
       ->withInput();
   }

   //バリデーション成功
   $menu->name = $input["name"];
   $menu->price = $input["price"];
   $menu->user_id = Auth::id();

  if($request->has('draft')){
     $menu->draft = true;
     $menu->save();
}
if($request->has('send')){
  $menu->draft = false;
  $menu->save();
 }

   /* 画像のアップロード */
   $uploadInput = $request->only("image");

   $uploadValidator = Validator::make($uploadInput, [
     'image' => 'file|image|mimes:png,jpeg',
   ]);

   //アップロード失敗
   if($uploadValidator->fails()){
     return redirect('menu/edit/' . $menu->id)
       ->withErrors($uploadValidator)
       ->withInput();
   }

   //画像が更新されたかどうか
   $is_change_image = false;

   //イメージのアップロード
   if(isset($uploadInput["image"])){
     $path = $uploadInput["image"]->store("public/uploads/");
     if($path){
       $menu->image = $path;
       $is_change_image = true;
     }
   }


   //保存する
   if($is_change_image){
     $menu->save();
   }

if($menu->draft == 1){
  return redirect("menu/index")->withStatus("下書きを保存しました");
}
   return redirect("menu/index")->withStatus("投稿を更新しました");
 }


function delete($id){
  $menu = MenuModel::find($id);

  if(!$menu){
    return redirect("home")->withStatus("投稿がありません");
  }

  $menu->delete();
return redirect("menu/index")->withStatus("投稿を削除しました");
}

function draft(){
   $user = Auth::user()->id;
   $menus = MenuModel::where('draft','=','1')->where('user_id','=',$user)->orderBy("id", "desc")->get();
   return view("menu.draft",[
     "menus" => $menus
   ]);

}

}
