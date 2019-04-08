<?php

namespace Studiow\SoapClient\Test\Request;

use Studiow\SoapClient\Request\Envelope;
use Studiow\SoapClient\Test\TestCase;

class EnvelopeTest extends TestCase
{
    public function test_building_xml()
    {
        $envelope = new Envelope([
            'Action' => [
                'type' => 'test',
            ],
        ]);

        $expected = '<?xml version="1.0"?><soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:body><Action><type>test</type></Action></soap:body></soap:Envelope>';

        $this->assertEnvelopeEqualsString($expected, $envelope);
    }
}
