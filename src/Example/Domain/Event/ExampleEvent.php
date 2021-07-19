<?php

declare(strict_types=1);

namespace App\Example\Domain\Event;

use Library\Event\Event;

class ExampleEvent implements Event
{
	public bool $isCalled = false;
}
