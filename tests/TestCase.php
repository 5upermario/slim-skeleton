<?php

declare(strict_types=1);

namespace Tests;

use DI\Container;
use Exception;
use Library\Kernel;
use PHPUnit\Framework\TestCase as PHPUnit_TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Request as SlimRequest;
use Slim\Psr7\Uri;

class TestCase extends PHPUnit_TestCase
{
	protected App $app;
	protected Container $container;

	protected function setUp(): void
	{
		parent::setUp();

		$this->getAppInstance();
	}

	/**
	 * @return App
	 * @throws Exception
	 */
	protected function getAppInstance(): App
	{
		if (empty($this->app)) {
			$kernel = new Kernel();
			$kernel->setup();

			$this->container = $kernel->getContainer();
			$this->app       = $kernel->getApp();
		}

		return $this->app;
	}

	protected function getContainer(): Container
	{
		return $this->container;
	}

	/**
	 * @param string        $method
	 * @param string        $path
	 * @param array<string> $headers
	 * @param array<string> $cookies
	 * @param array<mixed>  $serverParams
	 * @return Request
	 */
	protected function createRequest(
		string $method,
		string $path,
		array $headers = ['HTTP_ACCEPT' => 'application/json'],
		array $cookies = [],
		array $serverParams = []
	): Request {
		$uri    = new Uri('', '', 80, $path);
		$handle = fopen('php://temp', 'w+');

		if ($handle === false) {
			throw new Exception('Cannot open temp for write');
		}

		$stream = (new StreamFactory())->createStreamFromResource($handle);
		$h      = new Headers();

		foreach ($headers as $name => $value) {
			$h->addHeader($name, $value);
		}

		return new SlimRequest($method, $uri, $h, $cookies, $serverParams, $stream);
	}

	/**
	 * @param array<mixed>  $body
	 * @param array<string> $headers
	 * @param array<string> $cookies
	 * @param array<mixed>  $serverParams
	 */
	protected function createAppRequest(
		string $method,
		string $path,
		array $body = [],
		array $headers = ['HTTP_ACCEPT' => 'application/json'],
		array $cookies = [],
		array $serverParams = []
	): ResponseInterface {
		$app     = $this->getAppInstance();
		$request = $this->createRequest($method, $path, $headers, $cookies, $serverParams)->withParsedBody($body);

		return $app->handle($request);
	}

	protected function get(string $path): ResponseInterface
	{
		return $this->createAppRequest('GET', $path);
	}

	/** @param array<mixed> $body */
	protected function post(string $path, array $body = []): ResponseInterface
	{
		return $this->createAppRequest('POST', $path, $body);
	}

	/** @param array<mixed> $body */
	protected function delete(string $path, array $body = []): ResponseInterface
	{
		return $this->createAppRequest('DELETE', $path, $body);
	}
}
