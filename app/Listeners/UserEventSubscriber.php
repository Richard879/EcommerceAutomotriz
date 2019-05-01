<?php

namespace App\Listeners;

use App\Events\LogoutFromEveryWhere;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {}

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
    {
        app('db')->table('sessions')
                ->where('user_id', $event->user->id)
                ->delete();

        event(new LogoutFromEveryWhere($event->user));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );
    }
}
