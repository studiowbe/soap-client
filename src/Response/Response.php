<?php

namespace Studiow\SoapClient\Response;

use Psr\Http\Message\ResponseInterface;
use SimpleXMLElement;

class Response
{
    private $statusCode;
    private $reasonPhrase;
    private $body;

    public function __construct(array $body, int $status, string $reasonPhrase)
    {
        $this->body = $body;
        $this->statusCode = $status;
        $this->reasonPhrase = $reasonPhrase;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public static function fromHttpResponse(ResponseInterface $response)
    {
        $status = $response->getStatusCode();
        $reason = $response->getReasonPhrase();

        $content = str_replace(['<soap:', '</soap:'], ['<', '</'], $response->getBody()->getContents());

        $bodyXml = simplexml_load_string($content, SimpleXMLElement::class, LIBXML_NOCDATA);
        $body = json_decode(json_encode($bodyXml), true);

        return new static($body['Body'], $status, $reason);
    }
}