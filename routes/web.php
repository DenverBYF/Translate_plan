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
//主页面
Route::get('/', function () {
    return redirect('home');
});

/*用户功能路由组*/
Route::middleware(['auth'])->prefix('user')->group( function () {
	//个人中心
	Route::get('/person', function () {
		return view('index.person');
	})->name('person');
	//文章相关
});

//搜索
Route::post('/search', function () {
	return view('index.index');
})->name('search');

//主页面
Route::get('/home', function () {
	return view('welcome');
})->name('home');

//用户权限控制路由
Auth::routes();

