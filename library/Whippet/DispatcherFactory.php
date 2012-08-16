<?php

namespace Whippet;

use \Whippet\Dispatcher;

class DispatcherFactory
{

    public function fromHttp(array $server, array $config = array())
    {

        $config = $this->pushConfig($config);
        $root = str_replace(
                            'library/bootstrap.php',
                            '',
                            $server['SCRIPT_FILENAME']);

        $virtualroot = str_replace(
                            $this->addSlashes($server['DOCUMENT_ROOT']),
                            '/',
                            $root);

        $tmp = parse_url($server['REQUEST_URI'], PHP_URL_PATH);
        $uri = trim(preg_replace("@^{$virtualroot}@", '', $tmp), '/');

        parse_str($server['QUERY_STRING'], $pars);

        $method = $server['REQUEST_METHOD'];

        return new Dispatcher($method, $uri, $pars,
                              $virtualroot, $root, $config);

    }

    public function addSlashes($str)
    {
        return str_replace('//', '/', "/$str/");
    }

    public function pushConfig(array $config)
    {

        $default = array(
            'useEtags' => false,
            'frontController' => false,
            'viewEngine' => 'phtml'
        );

        return (object) array_merge($default, $config);
    }
}
