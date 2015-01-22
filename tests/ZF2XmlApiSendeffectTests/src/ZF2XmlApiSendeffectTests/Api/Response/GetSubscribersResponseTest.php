<?php

namespace ZF2XmlApiSendeffectTest\Api\Response;

use PHPUnit_Framework_TestCase;
use ZF2XmlApiSendeffect\Api\Response\GetSubscribersResponse;
use ZF2XmlApiSendeffect\Converter\ConverterInterface;
use ZF2XmlApiSendeffect\Converter\XmlConverter;

/**
 * Class GetSubscribersResponseTest
 *
 * @package ZF2XmlApiSendeffectTest\Api\Response
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class GetSubscribersResponseTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var GetSubscribersResponse
     */
    public $response = null;

    /**
     * @var ConverterInterface
     */
    public $converter = null;

    /**
     * Set up testing stuff
     */
    public function setUp()
    {
        $this->response = new GetSubscribersResponse();
        $this->converter = new XmlConverter();
    }

    /**
     * test if the object implements the ResponseInterface
     */
    public function testObjectImplementsInterface()
    {
        $this->assertInstanceOf('ZF2XmlApiSendeffect\Api\Response\ResponseInterface', $this->response);
    }

    /**
     * Test the response in case of a success api response
     */
    public function testSuccessCreation()
    {
        $fakeData = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <status>SUCCESS</status>
    <data>
        <count>2</count>
        <subscriberlist>
            <item>MagnusBuk@gmx.de</item>
            <item>MagnusBuk1@gmx.de</item>
        </subscriberlist>
    </data>
</response>
EOF;

        /** @var GetSubscribersResponse $response */
        $response = $this->response->create($this->converter->reconvert($fakeData));
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(2, $response->getCount());
    }

    /**
     * Test the response in case of a error api response
     */
    public function testErrorCreation()
    {
        $fakeData = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <status>ERROR</status>
    <errormessage>NICHT AUF DER LISTE!</errormessage>
</response>
EOF;

        /** @var GetSubscribersResponse $response */
        $response = $this->response->create($this->converter->reconvert($fakeData));
        $this->assertFalse($response->isSuccess());
        $this->assertNotEmpty($response->getErrorMessage());
        $this->assertEquals('NICHT AUF DER LISTE!', $response->getErrorMessage());
        $this->assertCount(0, $response->getData());
    }
}
