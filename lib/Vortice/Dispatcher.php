<?php

namespace Vortice;

use Vortice\Request,
    Vortice\Environment,
    Vortice\Route;

/**
 * Dispatch the request
 */  
class Dispatcher
{
    public function __invoke(Environment $env){
        $route = new Route();
        $request = $route->getRequest($env->uri);
        $request->primary = true;
        $request->addPars($env->pars);
        try{
            return $request->execute($env);
        }catch (Exception $e){
            throw $e;
        }
    }
}