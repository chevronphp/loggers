<?php

class FileLoggerTest extends PHPUnit_Framework_TestCase {

	function expectedOutput($ts){
		$expected  = "\n\n/// level\n////////////////////////////////////////////////////////////////////////\n\nNOTICE";
		$expected .= "\n\n";
		$expected .= "\n\n/// message\n////////////////////////////////////////////////////////////////////////\n\nOOPS";
		$expected .= "\n\n";
		$expected .= "\n\n/// timestamp\n////////////////////////////////////////////////////////////////////////\n\n{$ts}";
		$expected .= "\n\n";
		$expected .= "\n\n/// key\n////////////////////////////////////////////////////////////////////////\n\nvalue";
		$expected .= "\n\n";
		return $expected;
	}

	function test_log(){
		$path = sys_get_temp_dir();

		$logger = new \Chevron\Loggers\FileLogger($path);

		$logger->notice("OOPS", [
			"key" => "value",
		]);

		$date = date("c");

		$expected  = $this->expectedOutput($date);

		$hash = substr(sha1($expected), 0, 9);
		$name = "{$date}--NOTICE--{$hash}.txt";

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
		]);

		$date = date("c");

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
		]);

		$date = date("c");

		$expected  = $this->expectedOutput($date);

		$hash = substr(sha1($expected), 0, 9);
		// $name = "{$date}--NOTICE--{$hash}.txt";

		$file = "{$path}/{$name}";

		$this->assertEquals(is_file($file), true);
		$this->assertEquals($expected, file_get_contents($file));

	}

}