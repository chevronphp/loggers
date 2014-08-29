<?php

use \Chevron\Loggers\CliLogger;

class CliLoggerTest extends PHPUnit_Framework_TestCase {

	function test_UserFuncLogger(){

		$handle = "";

		$logger = new CliLogger;

		ob_start();
		$logger->alert("five", [555, true, null, false]);
		$result = ob_get_clean();

		$expected =  "\n\n--------------------------------------------------\n\n";
		$expected .= "    level => (string)\"ALERT\"\n";
		$expected .= "  message => (string)\"five\"\n";
		$expected .= "timestamp => (string)\"".date("c (e)")."\"\n";
		$expected .= "        0 => (integer)555\n";
		$expected .= "        1 => (boolean)true\n";
		$expected .= "        2 => (NULL)null\n";
		$expected .= "        3 => (boolean)false\n";
		$expected .= "\n\n\n";

		$this->assertEquals($expected, $result);

	}

}