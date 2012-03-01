<?php

require_once 'functions.php';
require_once('Vortice/Common/Loader.php');

$loader = new Vortice\Common\Loader();
//$loader->register('Zend', './Zend/');
$loader->register('Application', '../app/', 'Application\\');
$loader->register('Vortice', './');

$env = new Vortice\Environment($_SERVER);
$env->pushConfig(include('../app/config.php'));

$vortice = new Vortice\Vortice($env);
$vortice->execute();