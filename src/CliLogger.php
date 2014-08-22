<?php

namespace Chevron\Loggers;

use \Psr\Log\AbstractLogger;

class CliLogger extends UserFuncLogger {

	protected $func;

	public function __construct(){
		$this->func = function($level, $message, array $context){

			$context = ["level" => strtoupper($level), "message" => $message] + $context;

			$len = 0;
			foreach($context as $key => $value){
				if( ($l = strlen($key)) > $len){ $len = $l; }
			}

			$output = "\n\n-------------------------\n\n";

			foreach($context as $key => $value){
				$output .= sprintf("%{$len}s => %s\n", $key, $value);
			}

			$output .= "\n\n-------------------------\n\n";

			echo $output;
		};
	}

}