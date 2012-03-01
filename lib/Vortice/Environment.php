<?php

namespace Vortice;

class Environment
{
    
    var $pars = array();
    var $config = array();
    
    public function __construct(array $server){
        $this->root = str_replace(
                            'lib/bootstrap.php', 
                            '', 
                            $server['SCRIPT_FILENAME']);
        
        $this->virtualroot = str_replace(
                            $this->addSlashes($server['DOCUMENT_ROOT']),
                            '/',
                            $this->root);
        
        list($this->uri) = explode('?', preg_replace(
                            "@^{$this->virtualroot}@", 
                            '', 
                            $server['REQUEST_URI']));
        $this->uri = trim($this->uri, '/');
        parse_str($server['QUERY_STRING'], $this->pars);
                            
        $this->method = $server['REQUEST_METHOD'];
    }
    
    public function addSlashes($str)
    {
        return str_replace('//', '/', "/$str/");
    }
    
    public function pushConfig(array $configs){
        
        $default = array(
            'useEtags' => false,
            'frontController' => false,
            'viewEngine' => 'phtml'
        );
        
        $this->config = (object)array_merge($default, $configs);
    }
}
