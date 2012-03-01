<?php

namespace Vortice\Response;

use Vortice\Exception\InvalidHttpResponseCodeException;

class Code
{

	var $codes = array(
		'200' => 'HTTP/1.0 200 Ok',
		'304' => 'HTTP/1.0 304 Not Modified'
	);

	public function __construct($code)
	{
		if (!isset($this->codes[$code]))
			throw new InvalidHttpResponseCodeException($code);

		header ($this->codes[$code]);
	}

}