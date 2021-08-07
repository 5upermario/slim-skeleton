<?php

namespace Tests\Unit\Library\Http;

use Library\Http\JsonResponder;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class JsonResponderTest extends TestCase
{
	use ProphecyTrait;

	public function testJsonEncodeIsNotSuccessful()
	{
		// setup
		$streamProphecy    = $this->prophesize(StreamInterface::class);
		$responseProphecy1 = $this->prophesize(ResponseInterface::class);
		$responseProphecy2 = $this->prophesize(ResponseInterface::class);
		$responseProphecy1->getBody()->willReturn($streamProphecy->reveal());
		$responseProphecy1->withStatus(500)->willReturn($responseProphecy2->reveal());

		// run
		(new JsonResponder)->respond($responseProphecy1->reveal(), "\xB1\x31");

		// assert
		$streamProphecy->write('JSON encode error!')->shouldBeCalledOnce();
		$responseProphecy1->withStatus(500)->shouldBeCalledOnce();
	}

	public function testJsonEncodeIsSuccessful()
	{
		// setup
		$streamProphecy    = $this->prophesize(StreamInterface::class);
		$responseProphecy1 = $this->prophesize(ResponseInterface::class);
		$responseProphecy2 = $this->prophesize(ResponseInterface::class);
		$responseProphecy1->getBody()->willReturn($streamProphecy->reveal());
		$responseProphecy1->withHeader('Content-Type', 'application/json')->willReturn($responseProphecy2->reveal());

		// run
		(new JsonResponder)->respond($responseProphecy1->reveal(), ['asdf' => 'ttt']);

		// assert
		$streamProphecy->write(json_encode(['asdf' => 'ttt']))->shouldBeCalledOnce();
		$responseProphecy1->withHeader('Content-Type', 'application/json')->shouldBeCalledOnce();
	}
}
