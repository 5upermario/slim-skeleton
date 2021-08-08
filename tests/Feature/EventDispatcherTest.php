<?php

namespace Tests\Feature;

use Library\Event\Event;
use Library\Event\EventDispatcher;
use Library\Event\Listener;
use Tests\TestCase;

class EventDispatcherTest extends TestCase
{
	public function testItWorks()
	{
		// setup
		$app        = $this->getAppInstance();
		$event      = new ExampleEvent;
		$dispatcher = new EventDispatcher($app->getContainer(), [ExampleEvent::class => [ExampleListener::class]]);

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
	/** @var ExampleEvent $event */
	public function handle(Event $event): void
	{
		$event->isCalled = true;
	}
}
