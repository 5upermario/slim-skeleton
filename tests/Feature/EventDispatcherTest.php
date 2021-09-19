<?php

namespace Tests\Feature;

use Library\Event\Event;
use Library\Event\EventDispatcher;
use Library\Event\Listener;
use Tests\TestCase;

class EventDispatcherTest extends TestCase
{
	public function testItWorks(): void
	{
		// setup
		$app        = $this->getAppInstance();
		$event      = new ExampleEvent;
		$dispatcher = new EventDispatcher($this->getContainer(), [ExampleEvent::class => [ExampleListener::class]]);

		// run
		$dispatcher->dispatch($event);

		// assert
		$this->assertTrue($event->isCalled);
	}
}

class ExampleEvent implements Event
{
	public bool $isCalled = false;
}

class ExampleListener implements Listener
{
	/** @param ExampleEvent $event */
	public function handle(Event $event): void
	{
		$event->isCalled = true;
	}
}
