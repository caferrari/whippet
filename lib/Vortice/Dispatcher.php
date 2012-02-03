<?php

namespace Vortice;

use Vortice\Request,
    Vortice\Environment,
    Vortice\Route;
    
class Dispatcher
{
    
    public function dispatch(Environment $env)
    {
        $route = new Route();
        $request = $route->getRequest($env->uri);
        $request->addPars($env->pars);
        
        try{
            $request->execute($env);
            return $request;
        } catch (Exception $e){
            die ($e);
        }
    }
}