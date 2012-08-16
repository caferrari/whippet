<?php

namespace Whippet;

use Whippet\Request,
    Whippet\Environment,
    Whippet\Route,
    Whippet\Whippet;

/**
 * Dispatch the request
 */
class Dispatcher
{

    private $request;

    public function __construct($method, $url, $pars, $virtualRoot, $root, $config)
    {
        $route = new Route();
        $request = $route->getRequest($url);
        $request->primary = true;
        $request->addPars($pars);
        $request->method = $method;
        $request->url = $url;
        $request->virtualRoot = $virtualRoot;
        $request->root = $root;
        $request->config = $config;
        $this->request = $request;
    }

    public function dispatch(Whippet $fw)
    {
        try{
            $this->request->fw = $fw;
            return $this->request->execute();
        }catch (Exception $e){
            throw $e;
        }
    }
}
