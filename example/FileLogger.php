<?php

class FileLogger {

	protected $path;

	protected $name;

	function __construct($path, $name = ""){
		if(!is_dir($path)){
			throw new LoggerException("'{$path}' is not a directory");
		}
		$this->path = rtrim($path, DIRECTORY_SEPARATOR);
		$this->name = $name;
	}

	function __invoke( $level, $message, array $context = array() ) {

		$context = ["log.level" => strtoupper($level), "log.message" => $message, "log.timestamp" => date("c (e)") ] + $context;

		ob_start();
		foreach($context as $key => $value){
			echo "\n\n";
			echo "/// {$key}\n";
			echo str_repeat("/", 72) . "\n\n";
			var_dump($value);
			echo "\n";
		}
		$output = ob_get_clean();

		$name = $this->name;
		if(!$name){
			$hash = substr(sha1($output), 0, 9);
			$timestamp = date("Y.m.d\TH.i.s\ZO");
			$name = "{$timestamp}--{$context["log.level"]}--{$hash}.txt";
		}

		file_put_contents("{$this->path}/{$name}", $output);

	}

}


$logger = \Chevron\Loggers\UserFuncLogger(new FileLogger($path, $file));
