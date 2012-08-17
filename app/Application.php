<?php

namespace Application;

use Whippet\DI\DataSource;

class Application extends \Whippet\Application
{

    public function setUp()
    {
        $this->config = include '../app/config.php';
    }

    public function bootstrap()
    {
        $this->dataSource->add('db', (object)array('nome' => 'Fulano'));
    }

}