<?php

namespace Chevron\Loggers;

use \Psr\Log\AbstractLogger;

class UserFuncLogger extends AbstractLogger {

	protected $output;

	public function __construct(callable $func){
		$this->output = $func;
	}

	public function log( $level, $message, array $context = array() ) {
		call_user_func($this->output, $level, $message, $context);
	}

}
