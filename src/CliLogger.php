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

			if(null  === $value){ $value = "(null)null";  }
			if(false === $value){ $value = "(bool)false"; }
			if(true  === $value){ $value = "(bool)true";  }
			if(!is_scalar($value)){ $value = gettype($value); }

			$output .= sprintf("%{$len}s => %s\n", $key, $value);
		}

		$output .= "\n\n-------------------------\n\n";

		echo $output;
	}

}