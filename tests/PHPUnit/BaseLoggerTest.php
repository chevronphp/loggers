<?php

namespace DbLoggerTest;

use Psr\Log;

class ExtLogger extends \Chevron\Loggers\BaseLogger {

	function getBase(){
		return $this->base;
	}

	function log($level, $message, array $context = []){
		$this->base .= "{$level}|{$message}|".count($context);
	}

}

class BaseLoggerTest extends \PHPUnit_Framework_TestCase {

	function test_log(){
		$logger = new ExtLogger("");
		$logger->notice("notice me", [1,2,3]);

		$expected = $logger->getBase();
		$this->assertEquals($expected, "notice|notice me|3");
	}

	function test___invoke(){
		$logger = new ExtLogger("");
		call_user_func($logger, LOG\LogLevel::NOTICE, "notice me", [1,2,3]);

		$expected = $logger->getBase();
		$this->assertEquals($expected, "notice|notice me|3");
	}


}