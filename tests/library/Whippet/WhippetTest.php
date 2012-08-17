<?php

namespace Whippet;

class WhippetTest extends \PHPUnit_Framework_TestCase
{
    function test_whippet_class_should_return_execution_time()
    {
        $w = new Whippet(new Application);
        $this->assertTrue(is_numeric($w->getExecutionTime()));
    }

    function test_request_localhost_root_properties()
    {
        $server = include '_SERVER_localhost_WhippetPHP.php';
        $config =  array(
            'useEtags' => false,
            'frontController' => 'MasterController',
            'viewEngine' => 'phtml' // php, phtml for now
        );

        $dispatcher = new DispatcherFactory();
        $dispatcher = $dispatcher->fromHttp($server, $config);

        //var_dump($dispatcher);

        $this->assertEquals($dispatcher->request->controller, 'IndexController');
        $this->assertEquals($dispatcher->request->action, 'index');
        $this->assertEquals($dispatcher->request->virtualRoot, '/WhippetPHP/');
        $this->assertEquals($dispatcher->request->path, 'index\index');
        $this->assertEquals($dispatcher->request->url, '');
        $this->assertCount(0, $dispatcher->request->pars);

        $this->assertEquals($dispatcher->request->response->layout, 'default');

        $this->assertEquals($dispatcher->request->config->frontController, 'MasterController');
        $this->assertEquals($dispatcher->request->config->useEtags, false);
        $this->assertEquals($dispatcher->request->config->viewEngine, 'phtml');
    }
}
