<?php

namespace Whippet\Render;

use Whippet\Render\Renderizable,
    Whippet\Request,
    Whippet\Response,
    Whippet\Controller,
    Whippet\Exception\ViewNotFoundException;

class Html implements Renderizable
{

    public function buildViewPath($view)
    {
        $view = str_replace('\\', '/', $view);
        $view = uncamelize(str_replace('Controller', '', $view));
        $view = str_replace('/_', '/', $view);
        return $view;
    }

    public function render(Request $request, Response $response)
    {
        if ($request->primary) {
            $response->addHeader('Content-Type', 'text/html; charset=utf-8');
        }

        ob_start();

        $view = "{$request->controller}/{$request->action}."
                . $request->config->viewEngine;

        $view = $this->buildViewPath($view);
        $viewfile = $request->root . 'app/view/' . $view;

        if (!file_exists($viewfile)) {
            throw new ViewNotFoundException("View \"$view\" not found");
        }

        extract(Controller::$vars);
        include $viewfile;

        return ob_get_clean();
    }

}
