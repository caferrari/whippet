<?php

namespace Application;

class Application extends \Whippet\Application
{

    public function setup()
    {
        $this->config = include '../app/config.php';
    }

    public function bootstrap()
    {
        $this->dataSource->add('db', (object)array('nome' => 'Fulano'));
    }

}