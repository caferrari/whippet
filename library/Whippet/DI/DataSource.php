<?php

namespace Whippet\DI;

use Whippet\Exception\ModelNotFoundException;

class DataSource
{

    public $sources = array();

    public function add($name, $source)
    {
        $this->sources[$name] = $source;
    }

    public function inject($class)
    {
        $class = "\\Application\\Model\\" . ucfirst($class);
        if (!class_exists($class)) {
            throw new ModelNotFoundException("Model \"$class\" not found");
        }

        $target = new $class;
        foreach ($this->sources as $name => $object) {
            $target->$name = $object;
        }

        return $target;
    }

}
