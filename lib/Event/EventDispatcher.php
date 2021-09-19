<?php

declare(strict_types=1);

namespace Library\Event;

use Psr\Container\ContainerInterface;

class EventDispatcher
{
	private ContainerInterface $container;
	/** @var array<string, string[]> $config */
	private array $config;

	/** @param array<string, string[]> $config */
	public function __construct(ContainerInterface $container, array $config)
	{
		$this->container = $container;
		$this->config    = $config;
	}

	public function dispatch(Event $event): void
	{
		if (empty($event) || empty($this->config[get_class($event)])) return;

		foreach ($this->config[get_class($event)] as $listener) {
			($this->container->get($listener))->handle($event);
		}
	}
}
