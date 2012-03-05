<?php

namespace Application\Controller;

class TesteController extends \Vortice\Controller
{
    
    public function index(){
        $this->nome = $this->pars->nome;
    }
    
}