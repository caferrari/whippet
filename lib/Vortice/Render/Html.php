<?php

namespace Vortice\Render;

use Vortice\Render\Renderizable,
    Vortice\Request,
    Vortice\Response,
    Vortice\Controller,
    Vortice\Exception\ViewNotFoundException;

class Html implements Renderizable
{

    public function buildViewPath($view){
        $view = str_replace('\\', '/', $view);
        $view = uncamelize(str_replace('Controller', '', $view));
        $view = str_replace('/_', '/', $view);
        return $view;
    }

    public function render(Request $request, Response $response){
        if ($request->primary)
            $response->addHeader('Content-type', 'text/html; charset=utf-8');

        ob_start();

        $view = "{$request->controller}/{$request->action}." . $request->env->config->viewEngine;
        $view = $this->buildViewPath($view);
        $viewfile = root . 'app/view/' . $view;

        if (!file_exists($viewfile))
            throw new ViewNotFoundException("View \"$view\" not found");

        extract(Controller::$vars);
        include $viewfile;

        return ob_get_clean();
    }

}