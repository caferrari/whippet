<?php

/**
 * Simple loader class
 *
 * Usage:
 * $loader = new Vortice\Common\Loader();
 * $loader->register('Zend', './Zend/');
 * $loader->register('Application', '../app/', 'Application\\');
 * $loader->register('Vortice', './');
 *
 * @author	Carlos André Ferrari <carlos@ferrari.eti.br>
 */
 
namespace Vortice\Common;

class Loader
{
    
    /**
	* Register a new namespace
	*
	* @var		string
	* @var		string
	* @var		string
	* @access	public
	*/
    public function register($namespace, $folder, $remove = '')
    {
        spl_autoload_register(
            function($classname) use ($folder, $namespace, $remove){
                if (false == strstr($classname, $namespace)) return;
                $classname = str_replace($remove, '', $classname);
                $file = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
                if (file_exists($folder . $file . '.php'))
                    require_once $folder . $file . '.php';
            }
        );
    }
    
}
