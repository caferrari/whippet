<?php

require_once 'functions.php';
require_once('../vendor/Whippet/Common/Loader.php');

$loader = new Whippet\Common\Loader;
$loader->register('Application', '../app/', 'Application\\');
$loader->register('Whippet', '../vendor/');

$app = new Application\Application();
$app->run();