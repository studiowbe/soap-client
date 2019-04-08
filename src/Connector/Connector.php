<?php

namespace Studiow\SoapClient\Connector;

use Studiow\SoapClient\Request\Request;
use Studiow\SoapClient\Response\Response;

interface Connector
{
    public function execute(string $url, Request $request): Response;
}
