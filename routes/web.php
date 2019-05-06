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

Route::view('/','welcome');

Route::get('/index', function () {
    return view('welcome');
});
Route::prefix('admin')->group(function (){
    Route::get('/{id}/profile', 'UserProfileController@show')->name('profile');
});

//重新導向
Route::redirect('/main', '/public/index');

//重新導向，並回傳301
Route::permanentRedirect('/here','/public/');

//設定變數，加入條件式
Route::get('user/{id}', function ($id) {
    //重新導向並傳至
    return redirect()->route('profile',['id'=>$id]);
})->where('id', '[0-9]+');

//設定變數，如果為空，則使用預設值
Route::get('name/{name?}/{id}', function ($name = 'John') {
    return $name;
});

//單向controller
Route::get('invoke','invokeController');

//資源controller
//except是除掉資源controller中的index
//only是只要資源controller中的部分內容
//name是可以覆蓋資源controller中route的name
//parameters是可以覆蓋資源controller中route的參數
Route::resource('photo','photoController',["except"=>["index"]]);
Route::resource('photo', 'PhotoController', ['except' => [
    'create','show', 'store', 'update', 'destroy'
]]);
Route::resource('photo','photoController',["names"=>['create'=>'leelo']]);
Route::resource('photo','photoController',["parameters"=>['show'=>'pid']]);



