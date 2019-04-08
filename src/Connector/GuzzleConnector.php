<?php

namespace Studiow\SoapClient\Connector;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Studiow\SoapClient\Request\Request;
use Studiow\SoapClient\Response\Response;

class GuzzleConnector implements Connector
{
    private $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function execute(string $url, Request $request): Response
    {
        try {
            $response = $this->client->post($url, [
                'headers' => $request->getHeaders(),
                'body' => $request->getBody()->asXmlString(),
            ]);
        } catch (BadResponseException $ex) {
            $response = $ex->getResponse();
        }

        return Response::fromHttpResponse($response);
    }
}
