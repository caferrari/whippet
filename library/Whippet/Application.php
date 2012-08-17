<?php

namespace Whippet;

use Whippet\DI\DataSource,
    Whippet\DispatcherFactory,
    Whippet\Whippet;

abstract class Application
{

    public $config = array();
    public $dataSource;

    final public function __construct()
    {
        $this->dataSource = new DataSource();
    }

    abstract public function bootstrap();

    public function run()
    {
        $this->bootstrap();
        $dispatcher = new DispatcherFactory();
        $whippet = new Whippet($this);
        $whippet->execute($dispatcher->fromHttp($_SERVER, $this->config));
    }

}