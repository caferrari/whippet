<?php

namespace Whippet;

use Whippet\Request,
    Whippet\DI\DataSource;

abstract class Controller
{

    public static $vars = array();
    public $request;

    public final function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function loadModel($name)
    {
        return $this->getDataSource()->inject($name);
    }

    public function __set($var, $value)
    {
        return $this->request->response->data[$var] = $value;
    }

    public function __get($var)
    {
        switch (true) {
            case $var == 'pars':
                return (object) $this->request->pars;
            case (substr($var, -5) == 'Model'):
                return $this->loadModel(substr($var, 0, -5));
        }
    }

    private function getDataSource()
    {
        return $this->getFw()->application->dataSource;
    }

    private function getFw()
    {
        return $this->request->fw;
    }

}
