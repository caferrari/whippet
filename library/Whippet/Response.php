<?php

namespace Whippet;

use Whippet\Whippet,
    Whippet\Render,
    Whippet\Request,
    Whippet\Response\Code;

class Response
{

    public $request;
    public $code = 200;
    public $format = 'html';
    public $headers = array();
    public $output = '';

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->addHeader('Content-Type', 'text/html; charset=utf-8');
    }

    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function removeHeader($name)
    {
        if (isset($this->headers[$name]))
            unset ($this->headers[$name]);
    }

    private function checkEtag()
    {
        if (!$this->request->config->useEtags)
            return;

        $etag = sha1($this->output);
        if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH']==$etag)
        {
            $this->code = 304;
            $this->output = '';
        }

        $this->addHeader('Etag', $etag);
    }

    public function renderHeaders()
    {
        if (!$this->request->primary) return;

        foreach ($this->headers as $header => $value)
            header("$header: $value");

        header('Whippet-LoadTime:' . $this->request->fw->getExecutionTime());
    }

    public function render()
    {
        $render = new Render();
        $this->checkEtag();
        $this->setResponseCode();
        $this->renderHeaders();
        return $this->output = $render->render($this);
    }

    public function setResponseCode()
    {
        new Code($this->code);
    }

}
