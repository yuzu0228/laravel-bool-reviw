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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ReviewController@index')->name('index');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/review', 'ReviewController@create')->name('create');
    Route::post('/review/store', 'ReviewController@store')->name('store');
    
    Route::get('/admin/{user_id}', 'ReviewController@admin')->name('admin');
    Route::get('/admin/delete/{id}', 'ReviewController@delete')->name('delete');
    
    Route::get('/edit/{id}', 'ReviewController@edit')->name('edit');
    Route::post('/edit/update/{id}', 'ReviewController@update')->name('update');


    Route::group(['prefix'=>'/{id}'],function(){
        Route::post('favorite','FavoriteController@store')->name('favorites.favorite');
        Route::delete('unfavorite','FavoriteController@destroy')->name('favorites.unfavorite');
    });
    
    Route::post('/comment/store/{id}', 'CommentsController@store')->name('comment');
    Route::get('/comment/delete/{id}', 'CommentsController@delete')->name('comment.delete');

});

Route::get('/show/{id}', 'ReviewController@show')->name('show');
Route::get('/sort/{kind}', 'ReviewController@sort')->name('sort');

Route::get('/bach', 'ReviewController@back')->name('back');