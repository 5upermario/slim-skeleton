<?php

declare(strict_types=1);

namespace Tests\Unit\Library\Validation;

use Library\Validation\EqualityValidator;
use Library\Validation\NotEmptyValidator;
use Library\Validation\Validation;
use Library\Validation\ValidationException;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
	public function testValidValidationRules()
	{
		// setup
		$validation = (new Validation)
			->add(new NotEmptyValidator('test', 'test'))
			->add(new EqualityValidator('t', 't', 'test2'));

		// run
		$result = $validation->validate();

		// assert
		$this->assertTrue($result);
	}

	public function testOnlyOneValidationRuleIsValid()
	{
		// setup
		$this->expectException(ValidationException::class);
		$this->expectExceptionMessage(json_encode(['test', 'test2']));

		$validation = (new Validation)
			->add(new NotEmptyValidator('', 'test'))
			->add(new EqualityValidator('t', 't2', 'test2'))
			->add(new EqualityValidator('t', 't', 'test3'));

		// run
		$validation->validate();
	}
}
