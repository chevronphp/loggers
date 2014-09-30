<?php

namespace Chevron\Loggers;

trait InvokableLoggerTrait {
	abstract function log($level, $message, array $context = []);

	function __invoke($level, $message, array $context = []){
		$this->log($level, $message, $context);
	}
}