<?php

namespace Vortice;

use Vortice\Response,
    Vortice\Exception\InvalidRenderFormatException;

class Render 
{

    public function render(Response $response){
        $class = '\\Vortice\\Render\\' . ucfirst($response->format);

        if (!class_exists($class))
            throw new InvalidRenderFormatException("format {$response->format} is invalid");

        $renderObject = new $class();
        return $renderObject->render($response->request, $response);
    }
    
}