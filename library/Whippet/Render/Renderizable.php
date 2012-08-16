<?php

namespace Whippet\Render;

use Whippet\Request,
	Whippet\Response;

interface Renderizable
{
    public function render(Request $request, Response $response);
}