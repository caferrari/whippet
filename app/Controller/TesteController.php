<?php

namespace Application\Controller;

class TesteController extends \Vortice\Controller
{

    public function index(){

        $userModel = $this->loadModel("user");

        d($userModel->all());

        $this->nome = $this->pars->nome;
    }

}