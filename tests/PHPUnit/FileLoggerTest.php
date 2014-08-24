<?php

class FileLoggerTest extends PHPUnit_Framework_TestCase {

	function test_log(){
		$path = sys_get_temp_dir();

		$logger = new \Chevron\Loggers\FileLogger($path);

		$logger->notice("OOPS", [
			"key" => "value",
		]);

		$date = date("c");

		$expected = "\n\n-------------------------\n\n";
		$expected .= "    level => NOTICE\n";
		$expected .= "  message => OOPS\n";
		$expected .= "timestamp => {$date}\n";
		$expected .= "      key => value\n";
		$expected .= "\n\n-------------------------\n\n";

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

		$expected = "\n\n-------------------------\n\n";
		$expected .= "    level => NOTICE\n";
		$expected .= "  message => OOPS\n";
		$expected .= "timestamp => {$date}\n";
		$expected .= "      key => value\n";
		$expected .= "\n\n-------------------------\n\n";

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

		$expected = "\n\n-------------------------\n\n";
		$expected .= "    level => NOTICE\n";
		$expected .= "  message => OOPS\n";
		$expected .= "timestamp => {$date}\n";
		$expected .= "      key => value\n";
		$expected .= "\n\n-------------------------\n\n";

		$hash = substr(sha1($expected), 0, 9);
		// $name = "{$date}--NOTICE--{$hash}.txt";

		$file = "{$path}/{$name}";

		$this->assertEquals(is_file($file), true);
		$this->assertEquals($expected, file_get_contents($file));

	}

}