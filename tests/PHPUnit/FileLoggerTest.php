<?php

class FileLoggerTest extends PHPUnit_Framework_TestCase {

	function expectedOutput($ts){
		$expected  = "\n\n/// level\n////////////////////////////////////////////////////////////////////////\n\n(string)NOTICE";
		$expected .= "\n\n";
		$expected .= "\n\n/// message\n////////////////////////////////////////////////////////////////////////\n\n(string)OOPS";
		$expected .= "\n\n";
		$expected .= "\n\n/// timestamp\n////////////////////////////////////////////////////////////////////////\n\n(string){$ts}";
		$expected .= "\n\n";
		$expected .= "\n\n/// key\n////////////////////////////////////////////////////////////////////////\n\n(string)value";
		$expected .= "\n\n";
		$expected .= "\n\n/// null\n////////////////////////////////////////////////////////////////////////\n\n(NULL)";
		$expected .= "\n\n";
		$expected .= "\n\n/// false\n////////////////////////////////////////////////////////////////////////\n\n(boolean)";
		$expected .= "\n\n";
		$expected .= "\n\n/// true\n////////////////////////////////////////////////////////////////////////\n\n(boolean)1";
		$expected .= "\n\n";
		return $expected;
	}

	function test_log(){
		$path = sys_get_temp_dir();

		$logger = new \Chevron\Loggers\FileLogger($path);

		$logger->notice("OOPS", [
			"key" => "value",
			"null"  => null,
			"false" => false,
			"true"  => true,
		]);

		$date      = date("c (e)");
		$timestamp = date("Y-m-d\THis\ZO");

		$expected  = $this->expectedOutput($date);

		$hash = substr(sha1($expected), 0, 9);
		$name = "{$timestamp}--NOTICE--{$hash}.txt";

		$file = "{$path}/{$name}";

		$this->assertEquals(is_file($file), true);
		$this->assertEquals($expected, file_get_contents($file));

	}

	function test_log_filename(){
		$path = sys_get_temp_dir();
		$name = "tmpfilename.txt";

		$logger = new \Chevron\Loggers\FileLogger($path, $name);

		$logger->notice("OOPS", [
			"key" => "value",
			"null" => null,
			"false" => false,
			"true"  => true,
		]);

		$date = date("c (e)");

		$expected  = $this->expectedOutput($date);

		$hash = substr(sha1($expected), 0, 9);
		// $name = "{$date}--NOTICE--{$hash}.txt";

		$file = "{$path}/{$name}";

		$this->assertEquals(is_file($file), true);
		$this->assertEquals($expected, file_get_contents($file));

	}

	/**
	 * @expectedException \Chevron\Loggers\Exceptions\LoggerException
	 */
	function test_log_exceptions(){
		$path = "../not-a-dir";
		$name = "tmpfilename.txt";

		$logger = new \Chevron\Loggers\FileLogger($path, $name);

		$logger->notice("OOPS", [
			"key" => "value",
			"null" => null,
			"false" => false,
			"true"  => true,
		]);

		$date = date("c (e)");

		$expected  = $this->expectedOutput($date);

		$hash = substr(sha1($expected), 0, 9);
		// $name = "{$date}--NOTICE--{$hash}.txt";

		$file = "{$path}/{$name}";

		$this->assertEquals(is_file($file), true);
		$this->assertEquals($expected, file_get_contents($file));

	}

}