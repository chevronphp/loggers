<?php

class FileLoggerTest extends PHPUnit_Framework_TestCase {

	function expectedOutput($ts){
return <<<expected


/// log.level
////////////////////////////////////////////////////////////////////////

string(6) "NOTICE"



/// log.message
////////////////////////////////////////////////////////////////////////

string(4) "OOPS"



/// log.timestamp
////////////////////////////////////////////////////////////////////////

string(31) "{$ts}"



/// key
////////////////////////////////////////////////////////////////////////

string(5) "value"



/// null
////////////////////////////////////////////////////////////////////////

NULL



/// false
////////////////////////////////////////////////////////////////////////

bool(false)



/// true
////////////////////////////////////////////////////////////////////////

bool(true)


expected;
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
		$timestamp = date("Y.m.d\TH.i.s\ZO");

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
	 * @expectedException \Chevron\Loggers\LoggerException
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