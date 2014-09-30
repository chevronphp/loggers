<?php

namespace DbLoggerTest;

use Psr\Log;

class ExtLogger extends \Chevron\Loggers\AbstractDestinationLogger {

	use \Chevron\Loggers\InvokableLoggerTrait;

	function getDestination(){
		return $this->destination;
	}

	function log($level, $message, array $context = []){
		$this->destination .= "{$level}|{$message}|".count($context);
	}

}

class AbstractDestinationLoggerTest extends \PHPUnit_Framework_TestCase {

	function test_log(){
		$logger = new ExtLogger("");
		$logger->notice("notice me", [1,2,3]);

		$expected = $logger->getDestination();
		$this->assertEquals($expected, "notice|notice me|3");
	}

	function test___invoke(){
		$logger = new ExtLogger("");
		call_user_func($logger, LOG\LogLevel::NOTICE, "notice me", [1,2,3]);

		$expected = $logger->getDestination();
		$this->assertEquals($expected, "notice|notice me|3");
	}


}