<?php

/**
 * Simple loader class
 *
 * Usage:
 * $loader = new Whippet\Common\Loader();
 * $loader->register('Zend', './Zend/');
 * $loader->register('Application', '../app/', 'Application\\');
 * $loader->register('Whippet', './');
 *
 * @author Carlos André Ferrari <carlos@ferrari.eti.br>
 */

namespace Whippet\Common;

class Loader
{
    public function register($namespace, $folder, $remove = '')
    {
        spl_autoload_register(
            function($classname) use ($folder, $namespace, $remove){
                if (false == strstr($classname, $namespace)) return;
                $classname = str_replace($remove, '', $classname);
                $file = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
                if (file_exists($path = $folder . $file . '.php'))
                    require_once $path;
            }
        );
    }
}
