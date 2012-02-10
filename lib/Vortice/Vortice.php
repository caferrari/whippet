<?php

namespace Vortice;

class Vortice
{

    private static $startTime;
    
    public function __construct($environment){
        self::$startTime = microtime(true);
        
        if (!defined('root')) define('root', $environment->root);
        if (!defined('virtualroot')) define('virtualroot', $environment->root);
        if (!defined('uri')) define('uri', $environment->uri);
        
        $exception = new Exception();
        $exception->register();
        $this->environment = $environment;
    }
    
    public function execute()
    {
        ob_start();
        $dispatcher = new Dispatcher();
        $request = $dispatcher->dispatch($this->environment);
        ob_get_clean();
        echo $request->render();
    }
    
    public static function getExecutionTime(){
        return microtime(true) - self::$startTime;
    }
}