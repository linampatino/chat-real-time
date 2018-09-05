<?php

namespace App\Listeners;

use App\Events\BoardEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BoardEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BoardEvent  $event
     * @return void
     */
    public function handle(BoardEvent $event)
    {
        //
    }
}
