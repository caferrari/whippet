<?php

namespace Vortice;

class Vortice
{
    
    public function __construct($environment){
        $this->environment = $environment;
    }
    
    public function execute()
    {
        $dispatcher = new Dispatcher();
        $dispatcher->dispatch($this->environment);
    }
    
}