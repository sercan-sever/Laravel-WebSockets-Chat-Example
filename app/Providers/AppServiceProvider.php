<?php

namespace App\Providers;

// INTERFACES
use App\Services\Interfaces\AuthenticateInterface;
use App\Services\Interfaces\AvatarInterface;
use App\Services\Interfaces\MessageInterface;
use App\Services\Interfaces\UserInterface;

// REPOSITORIES
use App\Services\Repositories\AuthenticateRepository;
use App\Services\Repositories\AvatarRepository;
use App\Services\Repositories\MessageRepository;
use App\Services\Repositories\UserRepository;

// OTHERS
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(AuthenticateInterface::class, AuthenticateRepository::class);
        app()->bind(UserInterface::class, UserRepository::class);
        app()->bind(AvatarInterface::class, AvatarRepository::class);
        app()->bind(MessageInterface::class, MessageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
