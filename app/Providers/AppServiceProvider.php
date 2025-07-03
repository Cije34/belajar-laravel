<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Gate::define('update-post', function (User $user, Article $article) {

        return $user->id === $article->author_id
            ? Response::allow()
            : Response::deny('You do not own this post.');

    });

        Paginator::useBootstrapFive();
    }
}
