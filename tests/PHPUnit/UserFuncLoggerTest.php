<?php

use \Chevron\Loggers\UserFuncLogger;

class UseFuncLoggerTest extends PHPUnit_Framework_TestCase {

	function test_UserFuncLogger(){

		$handle = fopen("php://memory", "w+");

		$logger = new UserFuncLogger(function($level, $message, $context)use(&$handle){
			fwrite($handle, sprintf("%s|%s|%s", $level, $message, json_encode($context)));
		});

		$logger->alert("five", [555]);

		rewind($handle);

		$expected = "alert|five|[555]";

		$this->assertEquals($expected, fgets($handle));

	}

}