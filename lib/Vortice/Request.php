<?php

namespace Vortice;

use Vortice\Vortice,
    Vortice\Environment,
    Vortice\Response,
    Vortice\Exception\ControllerNotFoundException,
    Vortice\Exception\ActionNotFoundException;
class Request
{
    
    var $controller = 'index';
    var $action     = 'index';
    var $pars       = array();
    var $primary = false;
    var $response;
    
    public function __construct($controller, $action, array $pars = array()){
        $this->controller = $controller;
        $this->action = $action;
        $this->pars = $pars;
        $this->response = new Response($this);
    }
    
    public function addPars(array $pars){
        $this->pars = array_merge($this->pars, $pars);
    }
    
    public function execute($env = false){
        $this->env = $env;
        $controllerClass = camelize($this->controller) . 'Controller';
        $controllerMethod = $this->action;

        $class = "Application\\Controller\\{$controllerClass}";
        if (!class_exists($class))
            throw new ControllerNotFoundException("Controller {$this->controller} not found");

        $c = new $class($this);
        if (!method_exists($c, $controllerMethod))
            throw new ActionNotFoundException("Action {$this->action} not found");
        
        $c->$controllerMethod();

        return $this->response;
    }
    
}