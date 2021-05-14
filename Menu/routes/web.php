<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'MenuController@index');

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
  //記事の作成
Route::get('/menu/create', 'MenuController@showCreateForm');
Route::post('/menu/create', 'MenuController@create');

Route::get('/menu/edit/{id}', 'MenuController@showEditForm');
Route::post('/menu/edit/{id}', 'MenuController@update');

Route::post('/menu/delete/{id}', 'MenuController@delete');

Route::get('/user/edit/{id}','UserController@showEditForm');
Route::post('/user/edit/{id}','UserController@update');
Route::get('/user/{id}', 'UserController@show');
Route::post('/comment/{id}/create', 'CommentController@create');

Route::get('/menu/draft', 'MenuController@draft');

});

Route::get('/menu/index', 'MenuController@index');
Route::get('/menu/vue', 'MenuController@vue');

Route::get('/menu/{id}','MenuController@show');


//管理側
Route::group(['middleware' => ['auth.admin']], function () {

	//管理側トップ
	Route::get('/admin', 'admin\AdminTopController@show');
	//ログアウト実行
	Route::post('/admin/logout', 'admin\AdminLogoutController@logout');
	//ユーザー一覧
	Route::get('/admin/user_list', 'admin\ManageUserController@showUserList');
	//ユーザー詳細
	Route::get('/admin/user/{id}', 'admin\ManageUserController@showUserDetail');

});



//管理側ログイン
Route::get('/admin/login', 'admin\AdminLoginController@showLoginform');
Route::post('/admin/login', 'admin\AdminLoginController@login');
