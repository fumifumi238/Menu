<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MenuModel;
use Validator;
use Auth;

class UserController extends Controller
{
    function show($id){
      $user = User::find($id);
      $menus = Auth::user()->MenuModel()->get();
      if($user == Auth::user()){
      return view("user.show", [
    "user" => $user,
    "menus"=> $menus
     ]);
     }else{
      return redirect("/menu/index")->withStatus("アクセス権限がありません");
     }
    }

    function showEditForm ($id){
       $user = User::find($id);
       if($user == Auth::user()){
         return view("user.edit_form",[
         "user" => $user]);
      }else{
         return redirect("/menu/index")->withStatus("そのページにはアクセスできません。");
     }
   }

   function update(Request $request, $id){

   $user = User::find($id);

   $input = $request->only('name');

   $validator = Validator::make($input, [
     'name' => 'required|string|max:30',
   ]);

   //バリデーション失敗
   if($validator->fails()){
     return redirect('/user/edit/' . $user->id)
       ->withErrors($validator)
       ->withInput();
   }

   //バリデーション成功
   $user->name = $input["name"];
   $user->save();

   return redirect('/user/' . $user->id)->withStatus("ユーザー情報を更新しました");

 }
}
