<?php

namespace App\Listners;

use App\Events\EventNovoRegistro;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListnerConfirmacaoEmail
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
     * @param  EventNovoRegistro  $event
     * @return void
     */
    public function handle(EventNovoRegistro $event)
    {
        //
    }
}
