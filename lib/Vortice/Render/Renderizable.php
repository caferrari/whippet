<?php

namespace Vortice\Render;

use Vortice\Request,
	Vortice\Response;

interface Renderizable 
{
    public function render(Request $request, Response $response);
}