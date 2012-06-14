<?php

namespace Application\Controller;

class TesteController extends \Vortice\Controller
{

    public function index(){
        d($this->userModel->all());
        $this->nome = $this->pars->nome;
    }

}