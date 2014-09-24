<?php

namespace Chevron\Loggers;

use \Psr\Log;

class AccessibleContextLogger extends Log\AbstractLogger {

	protected $context;

	function getContext(){
		return $this->context;
	}

	function log($level, $message, array $context = []){
		$context["log.level"]   = $level;
		$context["log.message"] = $message;
		$this->context = $context;
	}

}