<?php

namespace Studiow\SoapClient\Test;

use DOMDocument;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Studiow\SoapClient\Request\Envelope;

class TestCase extends PHPUnitTestCase
{
    public function assertEnvelopeEqualsString(string $expectedXml, Envelope $envelope)
    {
        $expected = new DOMDocument();
        $expected->loadXML($expectedXml);

        $actual = new DOMDocument();
        $actual->loadXML($envelope->asXmlString());

        $this->assertEqualXMLStructure($expected->firstChild, $actual->firstChild);
    }
}
