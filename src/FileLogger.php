<?php

namespace Chevron\Loggers;

use \Psr\Log\AbstractLogger;

class FileLogger extends AbstractLogger {

	protected $path;

	protected $name;

	public function __construct($path, $name = ""){
		if(!is_dir($path)){
			throw new Exceptions\LoggerException("'{$path}' is not a directory");
		}
		$this->path = rtrim($path, DIRECTORY_SEPARATOR);
		$this->name = $name;
	}

	public function log( $level, $message, array $context = array() ) {

		$context = ["log.level" => strtoupper($level), "log.message" => $message, "log.timestamp" => date("c (e)") ] + $context;

		$output = "";

		foreach($context as $key => $value){
			$output .= "\n\n";
			$output .= "/// {$key}\n";
			$output .= str_repeat("/", 72) . "\n\n";
			$output .= sprintf("(%s)%s", gettype($value), print_r($value, true));
			$output .= "\n\n";
		}

		$name = $this->name;
		if(!$name){
			$hash = substr(sha1($output), 0, 9);
			$timestamp = date("Y.m.d\TH.i.s\ZO");
			$name = "{$timestamp}--{$context["log.level"]}--{$hash}.txt";
		}

		file_put_contents("{$this->path}/{$name}", $output);

	}

}
