<?php

/**
* Convert sala-de-imprensa to SalaDeImprensa
* @param    $str        string
* @return    string
*/
function camelize($str='')
{
    return str_replace(' ', '', ucwords(str_replace(array('_', '-'), ' ', $str)));
}

/**
* Convert SalaDeImprensa to sala_de_imprensa
* @param    $str        string
* @return    string
*/
function uncamelize($str='')
{
    return preg_replace('@^_+|_+$@', '', strtolower(preg_replace("/([A-Z])/", "_$1", $str)));
}

/**
* Dump some variable
* @param    $var        mixed
* @return   void
*/
function d($var)
{
    var_dump($var);
    die();
}
