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
    
}