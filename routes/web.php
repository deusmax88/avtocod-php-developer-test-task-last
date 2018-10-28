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

Route::get('/', 'MessageController@index');

Route::post('/', 'MessageController@publishNew')->middleware('auth');

Route::get('/delete-message/{messageId}', 'MessageController@deleteMessage')
    ->name('delete-message')->middleware('auth');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('/login', 'Auth\LoginController@login')->name('do-login');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::get('/register-success', 'Auth\RegisterController@successfulRegistration')->name('register-success');

Route::post('/register', 'Auth\RegisterController@register')->name('do-register');

