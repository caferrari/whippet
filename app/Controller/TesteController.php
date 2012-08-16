<?php

namespace Application\Controller;

class TesteController extends \Whippet\Controller
{

    public function index()
    {
        $this->nome = $this->userModel->get()->nome;
    }

}
