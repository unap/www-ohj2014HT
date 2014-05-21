<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



Route::get('/', array(
  'as' => '/',
  'uses' => 'HomeController@showHome'
));

Route::get('feed', array(
  'as' => 'feed',
  'uses' => 'FeedController@makeFeed'
));

Route::get('login', array(
  'before' => 'guest', // logged in users can't login
  'as' => 'login', 
  'uses' => 'UserController@showLogin'
));


Route::post('login', array(
  'before' => 'guest|csrf', // logged in users can't login
  'as' => 'login.post', 
  'uses' => 'UserController@doLogin'
));

Route::get('logout', array(
  'before' => 'auth', //  only logged in users can logout
  'as' => 'logout', 
  'uses' => 'UserController@logout'
));

Route::get('user/{id}', array(
  'as' => 'userprofile',
  'uses' => 'UserController@showProfile'
));

Route::post('user/{id}', array(
  'as' => 'edituser',
  'uses' => 'UserController@editUser'
));

Route::get('users', array(
  'as' => 'listusers',
  'uses' => 'UserController@listUsers'
));

Route::get('register', array(
  'before' => 'guest', // logged in users can't register
  'as' => 'register',
  'uses' => 'UserController@showRegistration'
));

Route::post('register', array(
  'before' => 'guest|csrf',
  'as' => 'register',
  'uses' => 'UserController@saveUser'
));

Route::get('deleteuser/{id}', array(
  'before' => 'auth',
  'as' => 'deleteuser',
  'uses' => 'UserController@deleteUser'
));

Route::get('deleteimage/{id}', array(
  'before' => 'auth',
  'as' => 'deleteimage',
  'uses' => 'PostController@deleteImage'
));

Route::get('upload', array(
  'before' => 'auth', // only logged in users can upload
  'as' => 'upload',
  'uses' => 'PostController@showUploadPage'
));

Route::post('upload', array(
  'before' => 'auth|csrf', // only logged in users can upload
  'as' => 'upload',
  'uses' => 'PostController@saveImage'
));

Route::get('image/{id}', array(
  'as' => 'image',
  'uses' => 'PostController@showImagePage'
));

/* Comment on image */
Route::post('image/{id}', array(
  'before' => 'auth|csrf', // only logged in users can comment
  'as' => 'comment',
  'uses' => 'CommentController@saveComment'
));

/* Vote on image */
Route::post('vote/{id}', array(
  'before' => 'auth', // only logged in users can vote
  'as' => 'imagevote',
  'uses' => 'PostController@vote'
));


Route::get('info', array(
  'as' => 'info',
  function()
  {
    return View::make('info');
  }
));