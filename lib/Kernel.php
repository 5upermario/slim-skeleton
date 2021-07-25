<?php

namespace Library;

use DI\Container;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Slim\App;
use Slim\Factory\AppFactory;

class Kernel
{
	protected App $app;
	protected Container $container;

	public function setupEnvironmentVariables(): void
	{
		$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
		$dotenv->load();
	}

	public function setupContainer(): void
	{
		$containerBuilder = new ContainerBuilder();

		if (false) { // Should be set to true in production
			$containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
		}

		$dependencies = require __DIR__ . '/../config/dependencies.php';
		$dependencies($containerBuilder);

		$repositories = require __DIR__ . '/../config/repositories.php';
		$repositories($containerBuilder);

		$this->container = $containerBuilder->build();
	}

	public function getContainer(): Container
	{
		return $this->container;
	}

	public function setupApp(): void
	{
		AppFactory::setContainer($this->container);
		$this->app = AppFactory::create();

		$this->app->addBodyParsingMiddleware();

		$routes = require __DIR__ . '/../config/routes.php';
		$routes($this->app);

		$this->app->addRoutingMiddleware();
	}

	public function getApp(): App
	{
		return $this->app;
	}

	public function setup(): void
	{
		$this->setupEnvironmentVariables();
		$this->setupContainer();
		$this->setupApp();
	}

	public function run()
	{
		$this->app->run();
	}
}
