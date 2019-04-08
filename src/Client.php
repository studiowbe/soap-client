<?php

namespace Studiow\SoapClient;

use Studiow\SoapClient\Connector\Connector;
use Studiow\SoapClient\Connector\GuzzleConnector;
use Studiow\SoapClient\Request\Request;
use Studiow\SoapClient\Response\Response;

class Client
{
    private $connector;
    private $url;

    public function __construct(string $url, ?Connector $connector = null)
    {
        $this->url = $url;
        $this->connector = $connector ?? new GuzzleConnector();
    }

    public function request(Request $request): Response
    {
        return $this->connector->execute($this->url, $request);
    }
}
