<?php

namespace Studiow\SoapClient\Response;

use Psr\Http\Message\ResponseInterface;
use SimpleXMLElement;

class Response
{
    private $statusCode;
    private $reasonPhrase;
    private $body;
    private $raw;

    public function __construct(array $body, int $status, string $reasonPhrase, string $raw)
    {
        $this->body = $body;
        $this->statusCode = $status;
        $this->reasonPhrase = $reasonPhrase;
        $this->raw = $raw;
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
        $raw = $response->getBody()->getContents();
        if (substr($response->getHeader('Content-Type')[0], 0, 8) === 'text/xml') {
            $content = str_replace(['<soap:', '</soap:'], ['<', '</'], $raw);

            $bodyXml = simplexml_load_string($content, SimpleXMLElement::class, LIBXML_NOCDATA);
            $body = json_decode(json_encode($bodyXml), true);

            return new static($body['Body'], $status, $reason,$raw);
        }
        //non-xml response, return response with empty body
        return new static([], $status, $reason, $raw);
    }
}
