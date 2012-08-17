<?php

namespace Whippet\Render;

use Whippet\Render\Renderizable,
    Whippet\Request,
    Whippet\Response,
    Whippet\Controller,
    Whippet\Exception\ViewNotFoundException,
    Whippet\Exception\LayoutException;

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

        $layout = '<!--content-->';
        if ($response->layout) {
            $layout = $this->loadLayout($request);
        }

        $view = "{$request->controller}/{$request->action}."
                . $request->config->viewEngine;

        $view = $this->buildViewPath($view);
        $viewfile = $request->root . 'app/view/' . $view;

        if (!file_exists($viewfile)) {
            throw new ViewNotFoundException("View \"$view\" not found");
        }

        ob_start();
        extract(Controller::$vars);
        include $viewfile;
        $view = ob_get_clean();

        return str_replace('<!--content-->', $view, $layout);
    }

    private function loadLayout(Request $request) {
        $viewEngine = $request->config->viewEngine;

        if (in_array($viewEngine, array('php', 'phtml'))) {
            $layout = $request->response->layout;
            $file = "{$request->root}app/layout/{$layout}.{$viewEngine}";

            if (!file_exists($file)) {
                $msg = "Layout file {$layout}.{$viewEngine} does not found
                        in {$request->root}app/layout/ folder";
                throw new LayoutException($msg);
            }

            ob_start();
            extract(Controller::$vars);
            include $file;
            return ob_get_clean();
        }

        throw new LayoutException("{$viewEngine} does not support layouts");

    }

}
