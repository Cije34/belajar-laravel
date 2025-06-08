<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
return view('welcome');
});

route::middleware(['auth'])->group(function () {


    route::get('/article', [ArticleController::class,'index'])->name('article');
    route::get('/article/{id}/full',[ArticleController::class,'show']);
    route::get('/logout',[AuthController::class,'logout']);


});


route::get('/login', [ AuthController::class, 'login'])->name('login');
route::post('/login/postlogin', [ AuthController::class, 'auth']);
route::get('/login/session', [ AuthController::class, 'sesion']);
