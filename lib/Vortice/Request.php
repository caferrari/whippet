<?php

namespace Vortice;

use Vortice\Environment;

class Request
{
    
    var $controller = 'index';
    var $action     = 'index';
    var $pars       = array();
    var $responseCode = 200;
    
    public function __construct($controller, $action, array $pars = array()){
        $this->controller = $controller;
        $this->action = $action;
        $this->pars = $pars;
    }
    
    public function addPars(array $pars){
        $this->pars = array_merge($this->pars, $pars);
    }
    
    public function execute(){
        $controllerClass = camelize($this->controller) . 'Controller';
        $controllerMethod = $this->action;

        $class = "Controller\\{$controllerClass}";
        
        ob_start();
        $c = new $class();
        $c->$controllerMethod();
        return $this->html = ob_get_flush();
    }
    
    public function render(){
        echo $this->html;
    }
}