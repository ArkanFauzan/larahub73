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
    return redirect('/questions/index');
});

Auth::routes();

Route::get('/questions/index', 'QuestionController@index');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/questions/create', 'QuestionController@create');
    Route::post('/questions', 'QuestionController@store');
    Route::put('/questions/{id}', 'QuestionController@update');
    Route::get('/questions/{id}/edit', 'QuestionController@edit');
    Route::delete('/questions/{id}', 'QuestionController@destroy');
    Route::get('/questions/{id}', 'QuestionController@show');
    Route::post('/questions/{id}', 'AnswerController@store');
    Route::get('/questions/{id}/voteup', 'VoteController@voteup');
    Route::get('/questions/{id}/votedown', 'VoteController@votedown');

    // route untuk comment
    Route::post('/comment/answer/{id}', 'CommentAnswerController@store');
    Route::post('/comment/question/{id}', 'CommentQuestionController@store');

    // route untuk votes
    Route::post('/upvote/question/{id}','VoteController@upvote_question');
    Route::post('/downvote/question/{id}','VoteController@downvote_question');
});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});