<?php

namespace Vortice;

use Vortice\Exception\ModelNotFoundException;

class DataSource {

    static $sources = array();

    public static function add($name, $source){
        self::$sources[$name] = $source;
    }

    public static function inject($class){
        $class = "\\Application\\Model\\" . ucfirst($class);
        if (!class_exists($class))
            throw new ModelNotFoundException("Model \"$class\" not found");

        $target = new $class;
        foreach (self::$sources as $name => $object)
            $target->$name = $object;

        return $target;
    }

}