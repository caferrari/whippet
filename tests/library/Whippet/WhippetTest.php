<?php

namespace Whippet;

class WhippetTest extends \PHPUnit_Framework_TestCase
{
    function test_whippet_class_should_return_execution_time()
    {
        $w = new Whippet(new Application);
        $this->assertTrue(is_numeric($w->getExecutionTime()));
    }


    /**
     * @dataProvider providerForDispatcher
     *
     */
    function test_request_localhost_root_properties($server, $ret)
    {
        $config =  array(
            'useEtags' => false,
            'frontController' => 'MasterController',
            'viewEngine' => 'phtml' // php, phtml for now
        );

        $dispatcher = new DispatcherFactory();
        $dispatcher = $dispatcher->fromHttp($server, $config);

        //var_dump($dispatcher);

        $this->assertEquals($dispatcher->request->controller, $ret[0]);
        $this->assertEquals($dispatcher->request->action, $ret[1]);
        $this->assertEquals($dispatcher->request->virtualRoot, $ret[2]);
        $this->assertEquals($dispatcher->request->path, $ret[3]);
        $this->assertEquals($dispatcher->request->url, $ret[4]);
        $this->assertCount($ret[5], $dispatcher->request->pars);

        $this->assertEquals($dispatcher->request->response->layout, $ret[6]);

        $this->assertEquals($dispatcher->request->config->frontController, $ret[7]);
        $this->assertEquals($dispatcher->request->config->useEtags, $ret[8]);
        $this->assertEquals($dispatcher->request->config->viewEngine, $ret[9]);
    }

    function providerForDispatcher()
    {
        return array(
            array(
                array(
                  'APPLICATION_ENV' => 'development',
                  'DOCUMENT_ROOT' => '/var/www',
                  'SCRIPT_FILENAME' => '/var/www/WhippetPHP/whippet/bootstrap.php',
                  'REQUEST_METHOD' => 'GET',
                  'QUERY_STRING' => '',
                  'REQUEST_URI' => '/WhippetPHP/',
                ),
                array(
                    'IndexController',
                    'index',
                    '/WhippetPHP/',
                    'index\index',
                    '',
                    0,
                    'default',
                    'MasterController',
                    false,
                    'phtml'
                )
            ),

            array(
                array(
                  'APPLICATION_ENV' => 'development',
                  'DOCUMENT_ROOT' => '/var/www',
                  'SCRIPT_FILENAME' => '/var/www/WhippetPHP/whippet/bootstrap.php',
                  'REQUEST_METHOD' => 'GET',
                  'QUERY_STRING' => '',
                  'REQUEST_URI' => '/WhippetPHP/teste',
                ),
                array(
                    'TesteController',
                    'index',
                    '/WhippetPHP/',
                    'teste\index',
                    'teste',
                    0,
                    'default',
                    'MasterController',
                    false,
                    'phtml'
                )
            ),

            array(
                array(
                  'APPLICATION_ENV' => 'development',
                  'DOCUMENT_ROOT' => '/var/www/WhippetPHP',
                  'SCRIPT_FILENAME' => '/var/www/WhippetPHP/whippet/bootstrap.php',
                  'REQUEST_METHOD' => 'GET',
                  'QUERY_STRING' => '',
                  'REQUEST_URI' => '/',
                ),
                array(
                    'IndexController',
                    'index',
                    '/',
                    'index\index',
                    '',
                    0,
                    'default',
                    'MasterController',
                    false,
                    'phtml'
                )
            ),

            array(
                array(
                  'APPLICATION_ENV' => 'development',
                  'DOCUMENT_ROOT' => '/var/www/WhippetPHP',
                  'SCRIPT_FILENAME' => '/var/www/WhippetPHP/whippet/bootstrap.php',
                  'REQUEST_METHOD' => 'GET',
                  'QUERY_STRING' => '',
                  'REQUEST_URI' => '/teste',
                ),
                array(
                    'TesteController',
                    'index',
                    '/',
                    'teste\index',
                    'teste',
                    0,
                    'default',
                    'MasterController',
                    false,
                    'phtml'
                )
            ),
        );
    }
}
