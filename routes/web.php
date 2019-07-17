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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'UserController@home')->name('home');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('matches.')->group(function () {
            Route::get('matches', 'MatchController@index')->name('index');
            Route::get('matches/{match}', 'MatchController@show')->name('show')->where(['match' => '[0-9]+']);
            Route::get('matches/public', 'MatchController@public')->name('public');
            Route::get('matches/create', 'MatchController@showAddMatchForm')->name('create');
            Route::post('matches', 'MatchController@store')->name('store');
            Route::post('matches/delete', 'MatchController@delete')->name('delete');
            Route::get('matches/{match}/edit', 'MatchController@showEditForm')->name('edit')->where(['match' => '[0-9]+']);
            Route::put('matches/{match}', 'MatchController@update')->name('update')->where(['match' => '[0-9]+']);
            Route::put('matches/{match}/update_result', 'MatchController@updateResult')->name('update_result')->where(['match' => '[0-9]+']);
        });
    });
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::name('betting.')->group(function () {
        Route::get('betting/bets-list', 'UserController@index')->name('index');
        Route::get('betting/{match}', 'UserController@show')->name('show')->where(['bet' => '[0-9]+']);
        Route::post('betting/{match}', 'UserController@store')->name('store')->where(['bet' => '[0-9]+']);
    });
    Route::middleware(['identity'])->group(function () {
        Route::name('profile.')->group(function () {
            Route::get('user/{user}', 'ProfileController@index')->name('index')->where(['user' => '[0-9]+']);
            Route::put('user/{user}', 'ProfileController@edit')->name('edit')->where(['user' => '[0-9]+']);
        });
    });
});

Auth::routes();
