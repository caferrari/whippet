<?php

namespace Vortice;

class Environment
{
    
    public function __construct(array $server){
        $this->root = str_replace(
                            'lib/bootstrap.php', 
                            '', 
                            $server['SCRIPT_FILENAME']);
        
        $this->virtualroot = str_replace(
                            $this->addSlashes($server['DOCUMENT_ROOT']),
                            '/',
                            $this->root);
        
        $this->uri = preg_replace(
                            "@^{$this->virtualroot}@", 
                            '', 
                            $server['REQUEST_URI']);
                            
        $this->method = $server['REQUEST_METHOD'];
        
        $parts = $this->uri ? explode('/', $this->uri) : array();
        $controller = $action = 'index';
        $part = reset($parts);
        if ($part && !$this->isParameter($part)){
            $controller = array_shift($parts);
            $part = reset($parts);
            if ($part && !$this->isParameter($part))
                $action = array_shift($parts);
        }
        
        $this->controller = $controller;
        $this->action     = $action;
    }
    
    public function isParameter($str)
    {
        return preg_match('@^([a-z0-9_-]+:[a-z0-9_-]*)$@', $str);
    }
    
    public function addSlashes($str)
    {
        return str_replace('//', '/', "/$str/");
    }
}
