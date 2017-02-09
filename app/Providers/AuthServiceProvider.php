<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Status;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\ImagePolicy;
use App\Policies\StatusPolicy;
use App\Policies\UserPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Status::class => StatusPolicy::class,
        Image::class => ImagePolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);
    }
}
