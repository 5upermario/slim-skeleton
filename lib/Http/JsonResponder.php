<?php

declare(strict_types=1);

namespace Library\Http;

use Psr\Http\Message\ResponseInterface;

class JsonResponder implements Responder
{
	public function respond(ResponseInterface $response, $data): ResponseInterface
	{
		$data = json_encode($data);

		if (json_last_error() !== JSON_ERROR_NONE) {
			$response->getBody()->write('JSON encode error!');

			return $response->withStatus(500);
		}

		$response->getBody()->write($data);

		return $response->withHeader('Content-Type', 'application/json');
	}
}
