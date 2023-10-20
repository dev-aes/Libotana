<?php

namespace App\Observers;

use App\Models\Arrival;

class ArrivalObserver
{
    /**
     * Handle the Arrival "created" event.
     *
     * @param  \App\Models\Arrival  $arrival
     * @return void
     */
    public function created(Arrival $arrival)
    {
        //
    }

    /**
     * Handle the Arrival "updated" event.
     *
     * @param  \App\Models\Arrival  $arrival
     * @return void
     */
    public function updated(Arrival $arrival)
    {
        //
    }

    /**
     * Handle the Arrival "deleted" event.
     *
     * @param  \App\Models\Arrival  $arrival
     * @return void
     */
    public function deleted(Arrival $arrival)
    {
        //
    }

    /**
     * Handle the Arrival "restored" event.
     *
     * @param  \App\Models\Arrival  $arrival
     * @return void
     */
    public function restored(Arrival $arrival)
    {
        //
    }

    /**
     * Handle the Arrival "force deleted" event.
     *
     * @param  \App\Models\Arrival  $arrival
     * @return void
     */
    public function forceDeleted(Arrival $arrival)
    {
        //
    }
}
