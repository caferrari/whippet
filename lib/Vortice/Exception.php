<?php

namespace Vortice;

class Exception extends \ErrorException
{
    
    public function register(){
        set_error_handler(array($this, 'handler'));
    }

    public function handler($errno, $errstr, $errfile, $errline){
        header('Content-Type: text/plain');
        throw new self($errstr, $errno, 0, $errfile, $errline);
    }
    
}
