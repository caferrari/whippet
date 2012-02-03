<?php

namespace Vortice;

class Vortice
{

    public function __construct($environment){
        $exception = new Exception();
        $exception->register();
        $this->environment = $environment;
    }
    
    public function execute()
    {
        ob_start();
        $dispatcher = new Dispatcher();
        $request = $dispatcher->dispatch($this->environment);
        ob_end_clean();
        $request->render();
    }
    
}