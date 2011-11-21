<?php

namespace Vortice\Common;

class Loader
{
    
    public function register($namespace, $folder, $remove = '')
    {
        spl_autoload_register(
            function($classname) use ($folder, $namespace, $remove){
                if (false == strstr($classname, $namespace)) return;
                $classname = str_replace($remove, '', $classname);
                $file = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
                require_once $folder . $file . '.php';
            }
        );
    }
    
}