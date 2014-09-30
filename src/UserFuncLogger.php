<?php

namespace Chevron\Loggers;

class UserFuncLogger extends AbstractDestinationLogger {
	function __construct(callable $destination){
		$this->destination = $destination;
	}

	function log( $level, $message, array $context = array() ) {
		call_user_func($this->destination, $level, $message, $context);
	}
}
