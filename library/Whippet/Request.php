<?php

namespace Whippet;

use Whippet\Whippet,
    Whippet\Environment,
    Whippet\Response,
    Whippet\Exception\ControllerNotFoundException,
    Whippet\Exception\ActionNotFoundException;

class Request
{

    var $path;
    var $controller = 'index';
    var $action     = 'index';
    var $pars       = array();
    var $primary = false;
    var $response;

    public function __construct($path, array $pars = array()){
        $this->path = $path;
        $this->parsePath($path);
        $this->pars = $pars;
        $this->response = new Response($this);
    }

    public function addPars(array $pars){
        $this->pars = array_merge($this->pars, $pars);
    }

    public function parsePath($path){
        $class = "Application\\Controller\\{$path}";
        $action = 'index';
        if (!class_exists($class . 'Controller')){
            $lastPart = strrpos($path, '\\');
            $action = lcfirst(camelize(substr($path, $lastPart+1)));
            $path = substr($path, 0, $lastPart);
        }
        $this->controller = $path . 'Controller';
        $this->action = $action;
    }

    public function execute(){
        $controllerMethod = $this->action;

        $class = "Application\\Controller\\{$this->controller}";

        if (!class_exists($class))
            throw new ControllerNotFoundException("Controller {$this->controller} not found");

        if (!method_exists($class, $controllerMethod))
            throw new ActionNotFoundException("Action {$this->action} not found");

        $c = new $class($this);
        $c->request = $this;
        $c->pars = (object)$this->pars;
        $c->$controllerMethod();

        return $this->response;
    }

}