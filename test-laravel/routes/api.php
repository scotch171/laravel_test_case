<?php

use App\Http\Controllers\Api\v1\ArticlesController;
use App\Http\Controllers\Api\v1\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('articles', ArticlesController::class);
Route::resource('tags', TagController::class);

Route::get('/tags/getAllForArticle/{id}', [TagController::class, 'getAllForArticle']);
Route::post('/articles/{id}/act', [ArticlesController::class, 'action']);
