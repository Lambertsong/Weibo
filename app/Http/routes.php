<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

get('/', 'StaticPagesController@home')->name('home');
get('/help', 'StaticPagesController@help')->name('help');
get('/about', 'StaticPagesController@about')->name('about');

get('signup', 'UsersController@create')->name('signup');
resource('users', 'UsersController');

get('login', 'SessionsController@create')->name('login');
post('login', 'SessionsController@store')->name('login');
delete('logout', 'SessionsController@destroy')->name('logout');

get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

get('password/email', 'Auth\PasswordController@getEmail')->name('password.reset');
post('password/email', 'Auth\PasswordController@postEmail')->name('password.reset');
get('password/reset/{token}', 'Auth\PasswordController@getReset')->name('password.edit');
post('password/reset', 'Auth\PasswordController@postReset')->name('password.update');

resource('status', 'StatusesController');

get('/users/{id}/followings', 'UsersController@followings')->name('users.followings');
get('/users/{id}/followers', 'UsersController@followers')->name('users.followers');

post('/users/followers/{id}', 'FollowersController@store')->name('followers.store');
delete('/users/followers/{id}', 'FollowersController@destroy')->name('followers.destroy');

get('images/all', 'ImagesController@all')->name('images.all');
resource('images', 'ImagesController');
get('images/{id}/download', 'ImagesController@download');
post('images/upload', 'ImagesController@upload')->name('images.upload');

get('/users/{id}/avatar', 'UsersController@getAvatar')->name('avatar.get');
post('/users/{id}/avatar', 'UsersController@postAvatar')->name('avatar.post');

resource('comment', 'CommentsController', ['only' => ['store', 'destroy']]);

post('getuserinfo', 'UsersController@getUserInfo')->name('user.getuserinfo');
