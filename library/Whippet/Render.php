<?php

namespace Whippet;

use Whippet\Response,
    Whippet\Exception\InvalidRenderFormatException;

class Render
{

    public function render(Response $response)
    {
        $class = '\\Whippet\\Render\\' . ucfirst($response->format);

        if (!class_exists($class)) {
            $msg = "format {$response->format} is invalid";
            throw new InvalidRenderFormatException($msg);
        }

        $renderObject = new $class();
        return $renderObject->render($response->request, $response);
    }

}
