<?php

require_once 'functions.php';
require_once('Vortice/Common/Loader.php');

$loader = new Vortice\Common\Loader;
//$loader->register('Zend', './Zend/');
$loader->register('Application', '../app/', 'Application\\');
$loader->register('Vortice', './');

$config = include('../app/config.php');

require_once '../app/bootstrap.php';

$dispatcher = new Vortice\DI\DispatcherFromHttp();
$vortice = new Vortice\Vortice();
$vortice->execute($dispatcher->inject($_SERVER, $config));