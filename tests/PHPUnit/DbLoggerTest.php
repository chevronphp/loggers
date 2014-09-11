<?php

namespace DbLoggerTest;

use Psr\Log;

class ExtLogger extends \Chevron\Loggers\DbLogger {

	function getDb(){
		return $this->db;
	}

	function log($level, $message, array $context = []){
		$this->db .= "{$level}|{$message}|".count($context);
	}

}

class DbLoggerTest extends \PHPUnit_Framework_TestCase {

	function test_log(){
		$logger = new ExtLogger("");
		$logger->notice("notice me", [1,2,3]);

		$expected = $logger->getDb();
		$this->assertEquals($expected, "notice|notice me|3");
	}

	function test___invoke(){
		$logger = new ExtLogger("");
		call_user_func($logger, LOG\LogLevel::NOTICE, "notice me", [1,2,3]);

		$expected = $logger->getDb();
		$this->assertEquals($expected, "notice|notice me|3");
	}


}