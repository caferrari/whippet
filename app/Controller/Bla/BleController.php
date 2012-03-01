<?php

namespace Application\Controller\Bla;

class BleController extends \Vortice\Controller
{
    
    public function index(){
        $this->nome = 'Carlos André Ferrari';
    }

    public function blo(){
    	$this->nome = 'blo found!';
    }
    
}