<?php

use \Chevron\Loggers\CliLogger;

class CliLoggerTest extends PHPUnit_Framework_TestCase {

	function test_UserFuncLogger(){

		$handle = "";

		$logger = new CliLogger;

		ob_start();
		$logger->alert("five", [555]);
		$result = ob_get_clean();

		$expected =  "\n\n-------------------------\n\n";
		$expected .= "  level => ALERT\n";
		$expected .= "message => five\n";
		$expected .= "      0 => 555\n";
		$expected .= "\n\n-------------------------\n\n";

		$this->assertEquals($expected, $result);

	}

}