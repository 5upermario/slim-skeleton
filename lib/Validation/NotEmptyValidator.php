<?php

declare(strict_types=1);

namespace Library\Validation;

class NotEmptyValidator implements Validator
{
	private $value;
	private string $element;

	public function __construct($value, string $element)
	{
		$this->value   = $value;
		$this->element = $element;
	}

	public function validate(): bool
	{
		return !empty($this->value);
	}

	public function errors(): array
	{
		return [$this->element];
	}
}
