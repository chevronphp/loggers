<?php

namespace Chevron\Loggers;

use Psr\Log;

abstract class AbstractDestinationLogger extends Log\AbstractLogger {
	protected $destination;

	function __construct($destination = null){
		$this->destination = $destination;
	}

	abstract function log($level, $message, array $context = []);
}