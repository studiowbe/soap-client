<?php

namespace Studiow\SoapClient\Request;

use Spatie\ArrayToXml\ArrayToXml;

class Envelope
{
    private $body;
    private $attributes;

    public function __construct(array $body = [], array $attributes = [])
    {
        $this->body = $body;
        $this->attributes = array_merge([
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xmlns:xsd' => 'http://www.w3.org/2001/XMLSchema',
            'xmlns:soap' => 'http://schemas.xmlsoap.org/soap/envelope/',
        ], $attributes);
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function asXmlString(): string
    {
        return ArrayToXml::convert([
            'soap:Body' => $this->getBody(),
        ], [
            'rootElementName' => 'soap:Envelope',
            '_attributes' => $this->getAttributes(),
        ]);
    }

    public function __toString()
    {
        return $this->asXmlString();
    }
}
