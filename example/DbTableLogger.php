<?php

class DbTableLogger  {

	protected $table;

	public function __construct( WrapperInterface $db, $table = "logging" ){
		parent::__construct($db);
		$this->table = $table;
	}

	public function __invoke($level, $message, array $context = array() ) {
		$this->db->insert($this->table, array(
			"created" => array(true, "NOW()"),
			"level"   => $level,
			"message" => $message,
			"context" => serialize($context),
		));
	}
}

$logger = \Chevron\Loggers\UserFuncLogger(new DbTableLogger($conn, $table));

// CREATE TABLE `` (
// 	`log_id` int(11) NOT NULL AUTO_INCREMENT,
// 	`created` datetime DEFAULT NULL,
// 	`level` enum('emergency','alert','critical','error','warning','notice','info','debug') DEFAULT 'info',
// 	`message` text DEFAULT NULL,
// 	`context` mediumblob DEFAULT NULL,
// 	PRIMARY KEY (`log_id`),
// 	INDEX `level` USING BTREE (`level`) comment '',
// 	INDEX `created` USING BTREE (`created`) comment ''
// ) ENGINE=`InnoDB` AUTO_INCREMENT=0 CHARSET=UTF8;
