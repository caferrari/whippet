<?php

namespace Vortice;

use Vortice\Request,
    Vortice\DataSource;

abstract class Controller
{

    static $vars = array();
    var $request;

    public final function __construct(Request $request){
        $this->request = $request;
    }

    public function loadModel($name){
        return DataSource::inject($name);
    }

    public function __set($var, $value){
        self::$vars[$var] = $value;
    }

    public function __get($var){
        switch (true){
            case $var == 'pars':
                return (object)$this->request->pars;
            case (substr($var, -5) == 'Model'):
                return DataSource::inject(substr($var, 0, -5));
        }
    }

}