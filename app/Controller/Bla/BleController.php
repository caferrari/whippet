<?php

namespace Application\Controller\Bla;

class BleController extends \Whippet\Controller
{

    public function index()
    {
        $this->nome = 'Carlos André Ferrari';
    }

    public function blo()
    {
        $this->nome = 'blo found!';
    }

}
