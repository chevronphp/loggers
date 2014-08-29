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