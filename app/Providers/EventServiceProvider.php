<?php

namespace App\Providers;

use App\Events\AuthLoggedIn;
use Illuminate\Auth\Events\Logout;
use App\Events\AuthLoggedOut;
use App\Events\SendMessage;
use App\Listeners\UserActiveStatus;
use App\Listeners\UserPassiveStatus;
use App\Models\Avatar;
use App\Models\Message;
use App\Models\User;
use App\Observers\AvatarObserver;
use App\Observers\MessageObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AuthLoggedIn::class => [
            UserActiveStatus::class,
        ],
        AuthLoggedOut::class => [
            UserPassiveStatus::class,
        ],
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        User::class => [UserObserver::class],
        Message::class => [MessageObserver::class],
        Avatar::class => [AvatarObserver::class],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
