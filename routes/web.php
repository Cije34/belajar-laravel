<?php

use Dom\Comment;
use App\Models\Article;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Jobs\NotifEmailMassal;

Route::get('/', function () {
return view('welcome');
});

route::middleware(['auth'])->group(function () {


    route::get('/article', [ArticleController::class,'index'])->name('article');
    route::get('/article/{id}/full',[ArticleController::class,'show']);
    route::get('/logout',[AuthController::class,'logout']);
    route::get('/article/write', [ArticleController::class, 'write']);
    route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
    route::get('/article/edit/{id}', [ArticleController::class, 'edit']);
    route::post('/article/update/{id}', [ArticleController::class, 'update'])->name('article.update');
    route::get('/article/delete/{id}', [ArticleController::class, 'delete']);
    route::post('/article/comment/{id}', [CommentController::class, 'store']);
    route::get('/video',[VideoController::class, 'index'])->name('video');
    route::get('/video/show/{id}', [VideoController::class, 'show']);
    route::post('/article/commentVideo/{id}',[CommentController::class, 'storeVideo']);
});


route::get('/login', [ AuthController::class, 'login'])->name('login');
route::post('/login/postlogin', [ AuthController::class, 'auth']);
route::get('/login/session', [ AuthController::class, 'sesion']);

route::get('/email', function () {
    $users = \App\Models\User::all();

    foreach ($users as $user) {
        NotifEmailMassal::dispatch($user)->afterCommit()->onQueue('MassEmail');
    }
});
