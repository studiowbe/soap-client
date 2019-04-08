<?php

namespace Studiow\SoapClient\Request;

class Request
{
    private $action;
    private $body;

    public function __construct(string $action, Envelope $body)
    {
        $this->action = $action;
        $this->body = $body;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getBody(): Envelope
    {
        return $this->body;
    }

    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'text/xml; charset=utf-8',
            'SOAPAction' => $this->getAction(),
        ];
    }

    /**
     * @param string $action
     * @param array  $body
     *
     * @return static
     */
    public static function fromArray(string $action, array $body)
    {
        return new static($action, new Envelope($body));
    }
}
