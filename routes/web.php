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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function () {
    return view('layouts.master');
});

Route::get('/questions/create', 'QuestionController@create');
Route::post('/questions', 'QuestionController@store');
Route::get('/questions/index', 'QuestionController@index');
Route::put('/questions/{id}', 'QuestionController@update');
Route::get('/questions/{id}/edit', 'QuestionController@edit');
Route::delete('/questions/{id}', 'QuestionController@destroy');
Route::get('/questions/{id}', 'QuestionController@show');
Route::post('/questions/{id}', 'AnswerController@store');
Route::get('/questions/{id}/voteup', 'VoteController@voteup');
Route::get('/questions/{id}/votedown', 'VoteController@votedown');

Route::post('/comment/answer/{id}', 'CommentAnswerController@store');
Route::post('/comment/question/{id}', 'CommentQuestionController@store');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});