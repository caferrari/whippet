<?php

namespace Whippet;

use Whippet\Request;

class Route
{

    private static $routes = array();

    public function __construct()
    {

    }

    public function add($regex, Request $target)
    {
        self::$routes[$regex] = $target;
    }

    public function getRequest($uri)
    {
        foreach (self::$routes as $route) {

        }
        return $this->defaultRoute($uri);
    }

    private function defaultRoute($uri)
    {
        $parts = $uri ? explode('/', $uri) : array();
        $path = array('index', 'index');

        foreach ($parts as $k => $part) {
            if ($this->isParameter($part)) {
                break;
            }
            $path[$k] = array_shift($parts);
        }

        $path = implode('\\', array_map('camelize', $path));

        return new Request($path,
                        $this->extractParameters(implode('/', $parts))
                   );
    }

    private function extractParameters($uri)
    {
        $pars = array();
        preg_match_all('@([a-z0-9A-Z]+):([^/]+)@',
                        $uri, $match, PREG_SET_ORDER
                       );

        foreach ($match as $mat) {
            list(, $name, $value) = $mat;
            $pars[$name] = rawurldecode($value);
        }
        return $pars;
    }

    private function isParameter($str)
    {
        return !preg_match('@^([a-zA-Z0-9_-])$@', $str) && strstr($str, ':');
    }

}
