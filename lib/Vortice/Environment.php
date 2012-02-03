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
        
        list($this->uri, $this->pars) = explode('?', preg_replace(
                            "@^{$this->virtualroot}@", 
                            '', 
                            $server['REQUEST_URI']));

        parse_str($this->pars, $this->pars);
                            
        $this->method = $server['REQUEST_METHOD'];
    }
    
    public function addSlashes($str)
    {
        return str_replace('//', '/', "/$str/");
    }
}
