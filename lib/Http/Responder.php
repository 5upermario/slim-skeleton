<?php

declare(strict_types=1);

namespace Library\Http;

use Psr\Http\Message\ResponseInterface;

interface Responder
{
	/**
	 * @param ResponseInterface $response
	 * @param mixed $data
	 */
	public function respond(ResponseInterface $response, $data): ResponseInterface;
}
