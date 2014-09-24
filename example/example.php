<?php

require "vendor/autoload.php";

// $logger = new \Chevron\Loggers\CliLogger;
$logger = new \Chevron\Loggers\CliLogger;

$logger->info("Testing", [
	"string" => "this is a longer string value",
	"int"    => 969,
	"array"  => ["random", "key" => "strval", 555],
	"true"   => true,
	"false"  => false,
	"null"   => null,
]);

//extending BaseLogger allows for typehinting on the constructor
class DbLogger extends \Chevron\Loggers\BaseLogger {

	function __construct(sdtClass $dbObject){
		$this->base = $dbObject;
	}

	function log($level, $message, array $context = []){
		$this->base->insert("insert into log_table (`level`, `message`, `context`) values ('{$level}', '{$message}', '".serialize($context)."');");
	}
}