<?php

namespace Chevron\Loggers;

use Psr\Log;

abstract class DbLogger extends Log\AbstractLogger {
	protected $db;

	function __construct($db){
		$this->db = $db;
	}

	abstract function log($level, $message, array $context = []);

	function __invoke($level, $message, array $context = []){
		$this->log($level, $message, $context);
	}
}