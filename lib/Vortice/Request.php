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
        
        ob_start();
        $c = new $class();
        $c->$controllerMethod();
        return $this->html = ob_get_flush();
    }
    
    private function checkEtag(){
        if ($this->env || $this->env->config->useEtags) {
            $etag = sha1($this->html);
            if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && 
                        $_SERVER['HTTP_IF_NONE_MATCH']==$etag) {
                header('HTTP/1.0 304 Not Modified'); 
                return true;
            }
            header('Etag: ' . $etag);
        }
        return false;
    }
    
    public function render(){
        if (!$this->checkEtag()){
            header('Vortice-LoadTime:' . Vortice::getExecutionTime());
            echo $this->html;
        }
    }
}