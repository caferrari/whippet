<?php

namespace Vortice\Render;

use Vortice\Request;

interface Renderizable 
{
    public function render(Request $request);
}