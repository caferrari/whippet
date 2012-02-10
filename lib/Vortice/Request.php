<?php

namespace Vortice;

use Vortice\Vortice,
    Vortice\Environment;

class Request
{
    
    var $controller = 'index';
    var $action     = 'index';
    var $pars       = array();
    var $responseCode = 200;
    var $renderFormat = 'html';
    var $primary = false;
    
    public function __construct($controller, $action, array $pars = array()){
        $this->controller = $controller;
        $this->action = $action;
        $this->pars = $pars;
    }
    
    public function addPars(array $pars){
        $this->pars = array_merge($this->pars, $pars);
    }
    
    public function execute($env = false){
        $this->env = $env;
        $controllerClass = camelize($this->controller) . 'Controller';
        $controllerMethod = $this->action;

        $class = "Controller\\{$controllerClass}";
        
        $c = new $class($this);
        $c->$controllerMethod();
    }
    
    public function render(){
        $render = new Render($this);
        return $render->render();
    }
    
}