<?php

namespace Chevron\Loggers;

use \Psr\Log\AbstractLogger;

class CliLogger extends AbstractLogger {

	public function log($level, $message, array $context = []){
		$context = ["level" => strtoupper($level), "message" => $message, "timestamp" => date("c")] + $context;

		$len = 0;
		foreach($context as $key => $value){
			if( ($l = strlen($key)) > $len){ $len = $l; }
		}

		$output = "\n\n-------------------------\n\n";

		foreach($context as $key => $value){
			$output .= sprintf("%{$len}s => (%s)%s\n", $key, gettype($value), $value);
		}

		$output .= "\n\n-------------------------\n\n";

		echo $output;
	}

}