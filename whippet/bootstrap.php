<?php

require_once 'functions.php';
require_once('../library/Whippet/Common/Loader.php');

$loader = new Whippet\Common\Loader;
//$loader->register('Zend', './Zend/');
$loader->register('Application', '../app/', 'Application\\');
$loader->register('Whippet', '../library/');

$app = new Application\Application();
$app->run();