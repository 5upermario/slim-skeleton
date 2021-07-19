<?php

namespace Tests\Feature;

use App\Example\Domain\Event\ExampleEvent;
use Library\Event\EventDispatcher;
use Tests\TestCase;

class EventDispatcherTest extends TestCase
{
	public function testItWorks()
	{
		// setup
		$app   = $this->getAppInstance();
		$event = new ExampleEvent;

		// run
		$app->getContainer()->get(EventDispatcher::class)->dispatch($event);

		// assert
		$this->assertTrue($event->isCalled);
	}
}
