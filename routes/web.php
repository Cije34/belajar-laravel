<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/article', [ArticleController::class,'index']);
route::get('/article/{id}/full',[ArticleController::class,'show']);
