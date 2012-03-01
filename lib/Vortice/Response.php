<?php

namespace Vortice;

use Vortice\Vortice,
    Vortice\Environment,
    Vortice\Render,
    Vortice\Request,
    Vortice\Response\Code;
   
class Response
{

	var $request;
	var $code = 200;
	var $format = 'html';
	var $headers = array();
	var $output = '';

	public function __construct(Request $request){
		$this->request = $request;
	}

	public function addHeader($name, $value){
        $this->headers[$name] = $value;
    }

    public function removeHeader($name){
        if (isset($this->headers[$name]))
            unset ($this->headers[$name]);
    }

    private function checkEtag(){
        if (!$this->request->env->config->useEtags)
        	return;

        $etag = sha1($this->output);
        if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH']==$etag){
            $this->code = 304;
            $this->output = '';
        }
        
        $this->addHeader('Etag', $etag);
    }

    public function renderHeaders(){
    	foreach ($this->headers as $header => $value)
    		header("$header: $value");
    }

    public function render(){
		$render = new Render();
        $this->checkEtag();
        $this->setResponseCode();
        $this->renderHeaders();
        return $this->output = $render->render($this);
    }

    public function setResponseCode(){
    	new Code($this->code);
    }

    public function __toString(){
    	return $this->output;
    }

}