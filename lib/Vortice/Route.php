<?php

namespace Vortice;

use Vortice\Request;

class Route 
{
    
    private static $routes = array();
    
    public function __construct(){
        
    }

    public static function add($regex, Request $target){
        self::$routes[$regex] = $target;
    }
    
    public function getRequest($uri){
        foreach (self::$routes as $r){
            
        }
        return $this->defaultRoute($uri);
    }
    
    private function defaultRoute($uri){
        $parts = $uri ? explode('/', $uri) : array();
        $controller = $action = 'index';
        $part = reset($parts);
        if ($part && !$this->isParameter($part)){
            $controller = array_shift($parts);
            $part = reset($parts);
            if ($part && !$this->isParameter($part))
                $action = array_shift($parts);
        }

        return new Request($controller, $action, 
                        $this->extractParameters(implode('/', $parts))
                   );
    }
    
    private function extractParameters($uri){
        $pars = array();
        preg_match_all('@([a-z0-9A-Z]+):([^/]+)@', $uri, $match, PREG_SET_ORDER);
        foreach ($match as $mat){
            list(, $name, $value) = $mat;
            $pars[$name] = $value;
        }
        return $pars;
    }
    
    private function isParameter($str)
    {
        return preg_match('@^([a-z0-9_-]+:[a-z0-9_-]*)$@', $str);
    }
    
}
