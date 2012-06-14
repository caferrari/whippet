<?php

namespace Vortice;

class Vortice
{

    private static $startTime;

    public function __construct($environment){
        header('Content-Type: text/plain;');
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
        $response = $dispatcher($this->environment);
        ob_end_clean();
        echo $response->render();
    }

    public static function getExecutionTime(){
        return microtime(true) - self::$startTime;
    }
}