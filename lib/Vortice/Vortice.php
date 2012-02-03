<?php

namespace Vortice;

class Vortice
{

    private static $startTime;
    
    public function __construct($environment){
        self::$startTime = microtime(true);
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
    
    public static function getExecutionTime(){
        return microtime(true) - self::$startTime;
    }
}