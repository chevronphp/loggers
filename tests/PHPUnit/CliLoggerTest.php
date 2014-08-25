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
		$expected .= "    level => ALERT\n";
		$expected .= "  message => five\n";
		$expected .= "timestamp => ".date("c")."\n";
		$expected .= "        0 => 555\n";
		$expected .= "        1 => (bool)true\n";
		$expected .= "        2 => array\n";
		$expected .= "        3 => (null)null\n";
		$expected .= "        4 => (bool)false\n";
		$expected .= "\n\n-------------------------\n\n";

		$this->assertEquals($expected, $result);

	}

}