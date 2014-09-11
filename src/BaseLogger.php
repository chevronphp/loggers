<?php

namespace Chevron\Loggers;

use Psr\Log;

abstract class BaseLogger extends Log\AbstractLogger {
	protected $base;

	function __construct($base = null){
		$this->base = $base;
	}

	abstract function log($level, $message, array $context = []);

	function __invoke($level, $message, array $context = []){
		$this->log($level, $message, $context);
	}
}