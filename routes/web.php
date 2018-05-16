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
	Route::resource('/person', 'UserController');
	//文章相关
	Route::resource('/article', 'ArticleController');
	//翻译相关
	Route::resource('/translate', 'TranslateController');
	//审核翻译
	Route::get('/accept/{id}/{status}', 'TranslateController@accept')->name('accept')->where('status', '-1|1');
	//点赞(踩)翻译
	Route::get('/translate/like/{id}/{status}', 'TranslateController@like')->name('tLike')->where('status', '-1|1');
	//消息相关
	Route::resource('/message', 'MessageController');
	//邀请翻译
	Route::post('/invite', 'InviteController@index')->name('invite');
});

/*主页路由组*/
Route::prefix('')->group(function () {
	//用户信息
	Route::get('/users/{id}', function ($id) {
		return redirect()->route('person.show', ['id' => $id]);
	})->name('users');

	Route::get('topic/{id}', function ($id) {
		return redirect()->route('article.show', ['id' => $id]);
	})->name('topic');
});


//搜索
Route::post('/search', function () {
	return view('index.index');
})->name('search');

//主页面
Route::get('/home', function () {
	$article = \App\Article::where('t_id',1)->paginate(15);
	return view('welcome', compact('article'));
})->name('home');

//用户权限控制路由
Auth::routes();

