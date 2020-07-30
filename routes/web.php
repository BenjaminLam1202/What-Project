<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => 'langugue'], function() {

    Route::get('change-language/{language}', 'UserController@changeLanguage')->name('user.change-language');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/auth/redirect/{provider}', 'SocialController@redirect');

    Route::get('/callback/{provider}', 'SocialController@callback');

    Route::get('/complete-registration', 'Auth\RegisterController@completeRegistration');

    Route::post('/resend', 'SocialController@remakeOTP');

    Route::get('/confirm-email', 'SocialController@confirmRemake');



    Route::post('/2fa', function () {
        return redirect(URL()->previous());
    })->name('2fa')->middleware('2fa'); 

    //prefit admin
    Route::group( [ 'prefix' => 'admin',  'middleware' => 'CheckRole'], function()
    {
        Route::get('/manager/{num?}', 'UserController@index')       ->name('admin.manager');

        Route::get('export', 'CSVController@export')                ->name('admin.export');

        Route::post('/adduser', 'UserController@create')            ->name('admin.addUser');

        Route::get('/delete/{user}', 'UserController@delete')       ->name('admin.deleteuser');

        Route::post('/update', 'UserController@update')             ->name('admin.updateuser');

        Route::get('/noti/{id}', 'UserController@markRead')         ->name('demo.markread');

        Route::get('/all', 'UserController@markReadAll')            ->name('demo.xoahet');

        Route::get('/dispatch', 'UserController@queueAddUser')      ->name('demo.queueadduser');
        //post route
        Route::get('/p/create', 'PostController@create') -> name('admin.post.create');

        Route::post('/p', 'PostController@store') -> name('admin.post.store');

        Route::get('/p/{post}', 'PostController@show')-> name('admin.post.show');

        Route::get('/d/{post}', 'PostController@delete')-> name('admin.post.delete');

        Route::get('/po/{post}/edit', 'PostController@edit')-> name('admin.post.edit');

        Route::post('/po/{post}', 'PostController@update')-> name('admin.post.update');

        Route::get('/post', 'PostController@index')-> name('admin.post.index');

        Route::get('/category', 'CategoryController@index')-> name('admin.category.index');


    });
});