<?php

namespace Whippet;

use Whippet\Dispatcher,
    Whippet\Application;

class Whippet
{

    protected $startTime;
    public $application;

    public function __construct(Application $app)
    {
        if (!headers_sent()) {
            header('Content-Type: text/plain; charset=utf-8');
        }
        $this->application = $app;
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

    public function getExecutionTime()
    {
        return microtime(true) - $this->startTime;
    }
}
