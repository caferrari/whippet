<?php

require_once 'functions.php';
require_once('Whippet/Common/Loader.php');

$loader = new Whippet\Common\Loader;
//$loader->register('Zend', './Zend/');
$loader->register('Application', '../app/', 'Application\\');
$loader->register('Whippet', './');

$app = new Application\Application();
$app->run();