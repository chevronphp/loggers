<?php

use \Chevron\Loggers\CliLogger;

class CliLoggerTest extends PHPUnit_Framework_TestCase {

	function test_UserFuncLogger(){

		$handle = "";

		$logger = new CliLogger;

		ob_start();
		$logger->alert("five", [555, true, [1, 2], null, false]);
		$result = ob_get_clean();

		$expected =  "\n\n-------------------------\n\n";
		$expected .= "    level => (string)ALERT\n";
		$expected .= "  message => (string)five\n";
		$expected .= "timestamp => (string)".date("c")."\n";
		$expected .= "        0 => (integer)555\n";
		$expected .= "        1 => (boolean)1\n";
		$expected .= "        3 => (NULL)\n";
		$expected .= "        4 => (boolean)\n";
		$expected .= "\n\n-------------------------\n\n";

		$this->assertEquals($expected, $result);

	}

}