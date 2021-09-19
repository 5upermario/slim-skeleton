<?php

declare(strict_types=1);

namespace App\Example\Domain\Event;

use Library\Event\Event;
use Library\Event\Listener;

class ExampleListener implements Listener
{
	/** @param ExampleEvent $event */
	public function handle(Event $event): void
	{
		$event->isCalled = true;
	}
}
