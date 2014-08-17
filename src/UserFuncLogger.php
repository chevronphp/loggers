<?php

namespace Chevron\Loggers;

use \Psr\Log\AbstractLogger;

class UserFuncLogger extends AbstractLogger {

	protected $func;

	public function __construct(callable $func){
		$this->func = $func;
	}

	public function log( $level, $message, array $context = array() ) {
		call_user_func($this->func, $level, $message, $context);
	}

}
