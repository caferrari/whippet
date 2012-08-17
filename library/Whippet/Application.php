<?php

namespace Whippet;

use Whippet\DI\DataSource,
    Whippet\DispatcherFactory,
    Whippet\Route,
    Whippet\Whippet;

class Application
{

    public $config = array();
    public $dataSource;

    final public function __construct()
    {
        $this->dataSource = new DataSource();
        $this->route = new Route();
        $this->setup();
    }

    public function bootstrap()
    {

    }

    public function setup()
    {

    }

    public function run()
    {
        $this->bootstrap();
        $dispatcher = new DispatcherFactory();
        $dispatcher->route = $this->route;
        $whippet = new Whippet($this);
        $whippet->execute($dispatcher->fromHttp($_SERVER, $this->config));
    }

}