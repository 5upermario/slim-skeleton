<?php

namespace Library\Validation;

use Exception;
use Throwable;

class ValidationException extends Exception
{
	private array $messages;

	public function __construct(array $messages, $code = 0, ?Throwable $previous = null)
	{
		parent::__construct(json_encode($messages), $code, $previous);

		$this->messages = $messages;
	}

	public function getMessages(): array
	{
		return $this->messages;
	}
}
