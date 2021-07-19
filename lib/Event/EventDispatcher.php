<?php

declare(strict_types=1);

namespace Library\Event;

use Psr\Container\ContainerInterface;

class EventDispatcher
{
	private ContainerInterface $container;
	private array $config;

	public function __construct(ContainerInterface $container, array $config)
	{
		$this->container = $container;
		$this->config    = $config;
	}

	public function dispatch(Event $event)
	{
		foreach ($this->config[$event::class] as $listener) {
			($this->container->get($listener))->handle($event);
		}
	}
}
