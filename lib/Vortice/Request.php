<?php

namespace Vortice;

use Vortice\Environment;

class Request
{
    
    public function __construct($controller, $action, Environment $env){
        
        $this->controller = $controller;
        $this->action = $action;
        
    }
    
}