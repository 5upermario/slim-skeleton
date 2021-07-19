<?php

declare(strict_types=1);

return [
	\App\Example\Domain\Event\ExampleEvent::class => [
		\App\Example\Domain\Event\ExampleListener::class,
	],
];
