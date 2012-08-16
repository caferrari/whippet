<?php

require_once 'functions.php';
require_once('Whippet/Common/Loader.php');

$loader = new Whippet\Common\Loader;
//$loader->register('Zend', './Zend/');
$loader->register('Application', '../app/', 'Application\\');
$loader->register('Whippet', './');

$config = include('../app/config.php');

require_once '../app/bootstrap.php';

$dispatcher = new Whippet\DispatcherFactory();
$whippet = new Whippet\Whippet();
$whippet->execute($dispatcher->fromHttp($_SERVER, $config));