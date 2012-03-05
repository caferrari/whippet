<?php

namespace Vortice;

use Vortice\Request;

abstract class Controller
{
    
    static $vars = array();
    var $request;
    
    public final function __construct(Request $request){ 
        $this->request = $request;
    }
    
    public function __set($var, $value){
        self::$vars[$var] = $value;
    }

    public function __get($var){
        switch (true){
            case $var == 'pars':
                return (object)$this->request->pars;
        }
    }
    
}