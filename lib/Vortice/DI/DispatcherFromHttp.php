<?php

namespace Vortice\DI;

use \Vortice\Dispatcher;

class DispatcherFromHttp
{

    var $pars = array();
    var $config = array();

    public function inject(array $server, array $config = array()){

        $config = $this->pushConfig($config);
        $root = str_replace(
                            'lib/bootstrap.php',
                            '',
                            $server['SCRIPT_FILENAME']);

        $virtualroot = str_replace(
                            $this->addSlashes($server['DOCUMENT_ROOT']),
                            '/',
                            $root);

        $uri = trim(preg_replace(
                            "@^{$virtualroot}@",
                            '',
                            parse_url($server['REQUEST_URI'], PHP_URL_PATH)), '/');

        parse_str($server['QUERY_STRING'], $pars);

        $method = $server['REQUEST_METHOD'];

        return new Dispatcher($method, $uri, $pars, $virtualroot, $root, $config);

    }

    public function addSlashes($str)
    {
        return str_replace('//', '/', "/$str/");
    }

    public function pushConfig(array $config){

        $default = array(
            'useEtags' => false,
            'frontController' => false,
            'viewEngine' => 'phtml'
        );

        return (object)array_merge($default, $config);
    }
}