<?php

declare(strict_types=1);

namespace Tests\Unit\Library\Validation;

use Library\Validation\EmailValidator;
use PHPUnit\Framework\TestCase;

class EmailValidatorTest extends TestCase
{
	public function testIsEmail()
	{
		// setup
		$validator = new EmailValidator('test@test.hu');

		// run
		$result = $validator->validate();

		// assert
		$this->assertTrue($result);
	}

	public function testEmailNotContainsAtSign()
	{
		// setup
		$validator = new EmailValidator('testtest.hu');

		// run
		$result = $validator->validate();

		// assert
		$this->assertFalse($result);
		$this->assertEquals(['email'], $validator->errors());
	}

	public function testEmailNotContainsDomain()
	{
		// setup
		$validator = new EmailValidator('test@testhu');

		// run
		$result = $validator->validate();

		// assert
		$this->assertFalse($result);
		$this->assertEquals(['email'], $validator->errors());
	}
}
