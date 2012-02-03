<?php

require_once 'functions.php';
require_once 'SplClassLoader.php';

$loader = new SplClassLoader('Vortice', './');
$loader->register();

$loader = new SplClassLoader('Controller', '../app');
$loader->register();

$env = new Vortice\Environment($_SERVER);
$env->pushConfig(include('../app/config.php'));

$vortice = new Vortice\Vortice($env);
$vortice->execute();