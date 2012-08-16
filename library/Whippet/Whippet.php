<?php

namespace Whippet;

use Whippet\Dispatcher;

class Whippet
{

    protected $startTime;

    public function __construct(){
        header('Content-Type: text/plain;');
        $this->startTime = microtime(true);

        $exception = new Exception();
        $exception->register();
    }

    public function execute(Dispatcher $dispatcher)
    {
        ob_start();
        $response = $dispatcher->dispatch($this);
        ob_end_clean();
        echo $response->render();
    }

    public function getExecutionTime(){
        return microtime(true) - $this->startTime;
    }
}