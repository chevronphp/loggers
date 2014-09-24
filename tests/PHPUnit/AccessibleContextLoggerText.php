<?php

use \Chevron\Loggers\AccessibleContextLogger;

class AccessibleContextLoggerText extends PHPUnit_Framework_TestCase {

	function test_logging(){
		$logger = new AccessibleContextLogger;

		$logger->alert("OMG!!", [
			"sky" => "falling",
		]);

		$expected = [
			"log.level"   => "alert",
			"log.message" => "OMG!!",
			"sky"         => "falling",
		];

		$result = $logger->getContext();

		$this->assertEquals($expected, $result);

	}

}

