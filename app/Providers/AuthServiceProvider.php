<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use App\Policies\BlogPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CommentPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ServicePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        User::class => UserPolicy::class,
        Service::class => ServicePolicy::class,
        Order::class => OrderPolicy::class,
        Comment::class => CommentPolicy::class,
        Category::class => CategoryPolicy::class,
        Blog::class => BlogPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
