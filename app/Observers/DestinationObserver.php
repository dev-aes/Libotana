<?php

namespace App\Observers;

use App\Models\Destination;

class DestinationObserver
{
    /**
     * Handle the Destination "created" event.
     *
     * @param  \App\Models\Destination  $destination
     * @return void
     */
    public function created(Destination $destination)
    {
        //
    }

    /**
     * Handle the Destination "updated" event.
     *
     * @param  \App\Models\Destination  $destination
     * @return void
     */
    public function updated(Destination $destination)
    {
        //
    }

    /**
     * Handle the Destination "deleted" event.
     *
     * @param  \App\Models\Destination  $destination
     * @return void
     */
    public function deleted(Destination $destination)
    {
        //
    }

    /**
     * Handle the Destination "restored" event.
     *
     * @param  \App\Models\Destination  $destination
     * @return void
     */
    public function restored(Destination $destination)
    {
        //
    }

    /**
     * Handle the Destination "force deleted" event.
     *
     * @param  \App\Models\Destination  $destination
     * @return void
     */
    public function forceDeleted(Destination $destination)
    {
        //
    }
}
