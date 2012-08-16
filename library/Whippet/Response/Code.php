<?php

namespace Whippet\Response;

use Whippet\Exception\InvalidHttpResponseCodeException;

class Code
{

	var $codes = array(
		'200' => 'HTTP/1.0 200 Ok',
		'301' => 'HTTP/1.0 301 Moved Permanently',
		'304' => 'HTTP/1.0 304 Not Modified',
		'404' => '404 Not Found'
	);

	public function __construct($code)
	{
		if (!isset($this->codes[$code]))
			throw new InvalidHttpResponseCodeException($code);

		header ($this->codes[$code]);
	}

}