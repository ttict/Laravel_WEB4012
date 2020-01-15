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

/*use Illuminate\Routing\Route;*/
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('index');
});

Route::get('index', ['as'=>'home-page','uses'=>'PageController@getIndex']);
Route::get('admin', ['as'=>'master','middleware'=>'adminLogin','uses'=>'PageController@adminPage']);
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function() {
    Route::group(['prefix'=>'user'],function() {
        Route::get('index',['as'=>'admin.user.index','uses'=>'UserController@index']);
        Route::get('create',['as'=>'admin.user.create','uses'=>'UserController@create']);
        Route::post('store',['as'=>'admin.user.store','uses'=>'UserController@store']);
        Route::get('show/{id}',['as'=>'admin.user.show','uses'=>'UserController@show']);
        Route::get('edit/{id}',['as'=>'admin.user.edit','uses'=>'UserController@edit']);
        Route::post('update/{id}',['as'=>'admin.user.update','uses'=>'UserController@update']);
        Route::post('delete/{id}',['as'=>'admin.user.destroy','uses'=>'UserController@destroy']);
        Route::get('active/update',['as'=>'admin.user.active.update','uses'=>'UserController@updateActive']);
    });
    Route::group(['prefix'=>'category'],function() {
        Route::get('index',['as'=>'admin.category.index','uses'=>'CategoryController@index']);
        Route::get('create',['as'=>'admin.category.create','uses'=>'CategoryController@create']);
        Route::post('store',['as'=>'admin.category.store','uses'=>'CategoryController@store']);
        Route::get('show/{id}',['as'=>'admin.category.show','uses'=>'CategoryController@show']);
        Route::get('edit/{id}',['as'=>'admin.category.edit','uses'=>'CategoryController@edit']);
        Route::post('update/{id}',['as'=>'admin.category.update','uses'=>'CategoryController@update']);
        Route::post('delete/{id}',['as'=>'admin.category.destroy','uses'=>'CategoryController@destroy']);
    });
    Route::group(['prefix'=>'post'],function() {
        Route::get('index',['as'=>'admin.post.index','uses'=>'PostController@index']);
        Route::get('create',['as'=>'admin.post.create','uses'=>'PostController@create']);
        Route::post('store',['as'=>'admin.post.store','uses'=>'PostController@store']);
        Route::get('show/{id}',['as'=>'admin.post.show','uses'=>'PostController@show']);
        Route::get('edit/{id}',['as'=>'admin.post.edit','uses'=>'PostController@edit']);
        Route::post('update/{id}',['as'=>'admin.post.update','uses'=>'PostController@update']);
        Route::post('delete/{id}',['as'=>'admin.post.destroy','uses'=>'PostController@destroy']);
    });
    Route::group(['prefix'=>'comment'],function() {
        Route::get('index',['as'=>'admin.comment.index','uses'=>'CommentController@index']);
        Route::post('delete/{id}',['as'=>'admin.comment.destroy','uses'=>'CommentController@destroy']);
        Route::get('active/update',['as'=>'admin.comment.active.update','uses'=>'CommentController@updateActive']);
    });
});

Route::get('post-category/{id}/{alias}',['as'=>'postCategory','uses'=>'PageController@postCategory']);

Route::get('categories',['as'=>'categories','uses'=>'PageController@categories']);
Route::get('category/{id}',['as'=>'categoryDetail','uses'=>'PageController@categoryDetail']);
Route::get('post/{id}',['as'=>'postDetail','uses'=>'PageController@postDetail']);
Route::post('comment/{id}',['as'=>'comment.store','uses'=>'CommentController@store']);


Route::get('myaccount',['as'=>'myaccount','uses'=>'PageController@myAccount']);
Route::post('myaccount/update/{id}',['as'=>'postEditAccount','uses'=>'PageController@postEditAccount']);
Route::get('myaccount/post/create',['as'=>'post.create','uses'=>'PageController@postCreate']);
Route::post('myaccount/post/create',['as'=>'post.store','uses'=>'PageController@postStore']);
Route::get('myaccount/post/edit/{id}',['as'=>'post.edit','uses'=>'PageController@postEdit']);
Route::post('myaccount/post/update/{id}',['as'=>'post.update','uses'=>'PageController@postUpdate']);

Route::get('edit-account',['as'=>'editaccount','uses'=>'PageController@getEditAccount']);
Route::post('edit-account',['as'=>'editaccount','uses'=>'PageController@postEditAccount']);

Route::get('user/{id}',['as' => 'userDetail', 'uses' => 'PageController@userDetail']);

Route::get('search',['as'=>'search','uses'=>'SearchController@searchResult']);

Route::get('login',['as'=>'login','uses'=>'Auth\LoginController@getLogin']);
Route::post('login',['as'=>'login','uses'=>'Auth\LoginController@postLogin']);
Route::get('logout', 'Auth\LoginController@logout');
Route::get('register', 'Auth\RegisterController@getRegister');
Route::post('register', 'Auth\RegisterController@postRegister');
