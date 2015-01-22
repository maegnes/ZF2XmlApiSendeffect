<?php

namespace ZF2XmlApiSendeffectTest\Api\Response;

use PHPUnit_Framework_TestCase;
use ZF2XmlApiSendeffect\Api\Response\IsSubscriberOnListResponse;
use ZF2XmlApiSendeffect\Converter\ConverterInterface;
use ZF2XmlApiSendeffect\Converter\XmlConverter;

/**
 * Class IsSubscriberOnListResponseTest
 *
 * @package ZF2XmlApiSendeffectTest\Api\Response
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class IsSubscriberOnListResponseTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var IsSubscriberOnListResponse
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
        $this->response = new IsSubscriberOnListResponse();
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
    <data>1</data>
</response>
EOF;

        /** @var IsSubscriberOnListResponse $response */
        $response = $this->response->create($this->converter->reconvert($fakeData));
        $this->assertTrue($response->isSuccess());
        $this->assertTrue($response->userExists());
    }

    /**
     * Test the response in case of a success api response
     */
    public function testErrorCreation()
    {
        $fakeData = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <status>ERROR</status>
    <errormessage>Kontakt existiert nicht.</errormessage>
</response>
EOF;

        /** @var IsSubscriberOnListResponse $response */
        $response = $this->response->create($this->converter->reconvert($fakeData));
        $this->assertFalse($response->isSuccess());
        $this->assertFalse($response->userExists());
        $this->assertEquals('Kontakt existiert nicht.', $response->getErrorMessage());
    }
}
