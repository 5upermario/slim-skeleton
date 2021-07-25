<?php

declare(strict_types=1);

namespace Library\Validation;

interface Validator
{
	public function validate(): bool;
	public function errors(): array;
}
