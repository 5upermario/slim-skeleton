<?php

declare(strict_types=1);

namespace Library\Event;

interface Listener
{
	public function handle(Event $event): void;
}
