<?php

namespace Chevron\Loggers;

use Psr\Log\AbstractLogger;
use Chevron\Containers\StackInterface;

class StackLog extends \Psr\Log\AbstractLogger implements \Countable {

	/**
	 * @var Stack
	 */
	protected $stack;

	public function __construct(StackInterface $stack) {
		$this->stack = $stack;
	}

	public function log($level, $message, array $context = array()) {
		$this->stack->push([$level, $message, $context]);
	}

	public function isEmpty() {
		return $this->stack->isEmpty();
	}

	public function count() {
		return $this->stack->count();
	}

	public function peek() {
		return $this->stack->peek();
	}

	public function pop() {
		return $this->stack->pop();
	}

}

