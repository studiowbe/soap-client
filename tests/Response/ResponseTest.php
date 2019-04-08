<?php

namespace Studiow\SoapClient\Test\Response;

use GuzzleHttp\Psr7\Response as PsrResponse;
use Studiow\SoapClient\Response\Response;
use Studiow\SoapClient\Test\TestCase;

class ResponseTest extends TestCase
{
    public function test_parse_response()
    {
        $body = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><soap:Fault><faultcode>soap:Server</faultcode><faultstring>There was an error</faultstring></soap:Fault></soap:Body></soap:Envelope>';
        $receive = new PsrResponse(500, ['Content-Type' => 'text/xml; charset=utf-8'], $body, '1.1', 'Internal Server Error');
        $expected = [
                'Fault' => [
                    'faultcode' => 'soap:Server',
                    'faultstring' => 'There was an error',
                ],
        ];
        $response = Response::fromHttpResponse($receive);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals('Internal Server Error', $response->getReasonPhrase());
        $this->assertEquals($expected, $response->getBody());
    }
}
