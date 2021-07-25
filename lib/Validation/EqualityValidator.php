<?php

declare(strict_types=1);

namespace Library\Validation;

class EqualityValidator implements Validator
{
	private $value1;
	private $value2;
	private string $element;

	public function __construct($value1, $value2, string $element)
	{
		$this->value1  = $value1;
		$this->value2  = $value2;
		$this->element = $element;
	}

	public function validate(): bool
	{
		return $this->value1 === $this->value2;
	}

	public function errors(): array
	{
		return [$this->element];
	}
}
