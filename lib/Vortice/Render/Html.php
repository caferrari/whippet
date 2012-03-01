<?php

namespace Vortice\Render;

use Vortice\Render\Renderizable,
    Vortice\Request,
    Vortice\Response,
    Vortice\Controller,
    Vortice\Exception\ViewNotFoundException;

class Html implements Renderizable 
{
    public function render(Request $request, Response $response){
        if ($request->primary)
            $response->addHeader('Content-type', 'text/html; charset=utf-8');

        ob_start();
        
        $view = "{$request->controller}/{$request->action}." . $request->env->config->viewEngine;
        $viewfile = root . 'app/view/' . $view;
        
        if (file_exists($viewfile)){
            extract(Controller::$vars);
            include $viewfile;
        }else
            throw new ViewNotFoundException("View \"$view\" not found");
        
        return ob_get_clean();
    }
    
}