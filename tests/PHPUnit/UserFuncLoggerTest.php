<?php

use \Chevron\Loggers\UserFuncLogger;

class UseFuncLoggerTest extends PHPUnit_Framework_TestCase {

	function test_UserFuncLogger(){

		$handle = "";

		$logger = new UserFuncLogger(function($level, $message, $context)use(&$handle){
			$handle = sprintf("%s|%s|%s", $level, $message, json_encode($context));
		});

		$logger->alert("five", [555]);

		$expected = "alert|five|[555]";

		$this->assertEquals($expected, $handle);

	}

}