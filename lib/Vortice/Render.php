<?php

namespace Vortice;

use Vortice\Request,
    Vortice\Exception\InvalidRenderFormatException;

class Render 
{
     
    var $request;
    var $renderObject;
    
    public function __construct(Request $request){
        $this->request = $request;
        $class = '\\Vortice\\Render\\' . ucfirst($request->renderFormat);
        
        if (class_exists($class)){
            $this->renderObject = new $class();
        }else{
            throw new InvalidRenderFormatException("format {$request->renderFormat} is invalid");
        }
    }
    
    private function checkEtag(){
        if ($this->request->env && $this->request->env->config->useEtags) {
            $etag = sha1($this->output);
            if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH']==$etag) {
                header('HTTP/1.0 304 Not Modified'); 
                return true;
            }
            header('Etag: ' . $etag);
        }
        return false;
    }
    
    public function render(){
        $this->output = $this->renderObject->render($this->request);
        if (!$this->request->primary) return $this->output;
        if (!$this->checkEtag()){
            header('Vortice-LoadTime:' . Vortice::getExecutionTime());
            return $this->output;
        }
        return '';
    }
    
}