<?php

namespace Studiow\SoapClient\Test\Request;

use Studiow\SoapClient\Request\Envelope;
use Studiow\SoapClient\Request\Request;
use Studiow\SoapClient\Test\TestCase;

class RequestTest extends TestCase
{
    public function test_building_request()
    {
        $action = 'http://example.com/action';
        $data = [
            'Action' => [
                'type' => 'test',
            ],
        ];

        $request = new Request(
            'http://example.com/action',
            new Envelope($data)
        );

        $expectedBody = '<?xml version="1.0"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:body><Action><type>test</type></Action></soap:body></soap:Envelope>';

        $this->assertEquals($action, $request->getAction());

        $this->assertEnvelopeEqualsString($expectedBody, $request->getBody());

        $this->assertEquals([
            'Content-Type' => 'text/xml; charset=utf-8',
            'SOAPAction' => $action,
        ], $request->getHeaders());
    }
}
