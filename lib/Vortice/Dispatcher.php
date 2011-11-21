<?php

namespace Vortice;

use Vortice\Request,
    Vortice\Environment;

class Dispatcher
{
    
    public function dispatch(Environment $env)
    {
        $controllerClass = camelize($env->controller) . 'Controller';
        $controllerMethod = $env->action;
        
        $class = "Application\\Controller\\{$controllerClass}";
        
        $c = new $class();
        $c->$controllerMethod();
        
    }
    
    
    
}