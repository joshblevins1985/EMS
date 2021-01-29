<?php

namespace Vanguard\Providers;

use Vanguard\Events\User\Banned;
use Vanguard\Events\User\LoggedIn;
use Vanguard\Events\User\Registered;
use Vanguard\Events\UnitSignOn;
use Vanguard\Events\UnitDispatched;
use Vanguard\Listeners\SendSmsToCrew;
use Vanguard\Listeners\UpdateUnitLog;
use Vanguard\Listeners\DispatchUnit;
use Vanguard\Listeners\Users\InvalidateSessionsAndTokens;
use Vanguard\Listeners\Login\UpdateLastLoginTimestamp;
use Vanguard\Listeners\PermissionEventsSubscriber;
use Vanguard\Listeners\Registration\SendConfirmationEmail;
use Vanguard\Listeners\Registration\SendSignUpNotification;
use Vanguard\Listeners\RoleEventsSubscriber;
use Vanguard\Listeners\UserEventsSubscriber;
use Vanguard\Listeners\ClassRoomSectionViewedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendConfirmationEmail::class,
            SendSignUpNotification::class,
        ],
        LoggedIn::class => [
            UpdateLastLoginTimestamp::class
        ],
        Banned::class => [
            InvalidateSessionsAndTokens::class
        ],
        [
            'App\Events\ClockIn'=>[
                'App\Listeners\AddOccurance',
                ]
            ],
        UnitSignOn::class=> [
            SendSmsToCrew::class,
            UpdateUnitLog::class,
            ],
        UnitDispatched::class=> [
            DispatchUnit::class,
            UpdateUnitLog::class,
            ],
            'Vanguard\Events\StudentHasViewedSectionEvent'=> [
            'Vanguard\Listeners\ClassRoomSectionViewedListener',
            'Vanguard\Listeners\CheckCourseCompleteListener',
            
            ]
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        UserEventsSubscriber::class,
        RoleEventsSubscriber::class,
        PermissionEventsSubscriber::class
    ];

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
