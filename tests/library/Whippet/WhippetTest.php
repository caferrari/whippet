<?php

namespace Whippet;

class WhippetTest extends \PHPUnit_Framework_TestCase
{
    function test_whippet_class_should_return_execution_time()
    {
        $w = new Whippet;
        $this->assertTrue(is_numeric($w->getExecutionTime()));
    }
}
