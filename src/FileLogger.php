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

		$context = ["level" => strtoupper($level), "message" => $message, "timestamp" => date("c")] + $context;

		$len = 0;
		foreach($context as $key => $value){
			if( ($l = strlen($key)) > $len){ $len = $l; }
		}

		$output = "\n\n-------------------------\n\n";

		foreach($context as $key => $value){
			$output .= sprintf("%{$len}s => %s\n", $key, $value);
		}

		$output .= "\n\n-------------------------\n\n";

		$name = $this->name;
		if(!$name){
			$hash = substr(sha1($output), 0, 9);
			$name = "{$context["timestamp"]}--{$context["level"]}--{$hash}.txt";
		}

		file_put_contents("{$this->path}/{$name}", $output);

	}

}
