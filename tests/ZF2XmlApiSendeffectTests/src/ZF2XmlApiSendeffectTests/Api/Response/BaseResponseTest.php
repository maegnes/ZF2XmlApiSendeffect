<?php

namespace ZF2XmlApiSendeffectTest\Api\Response;

use PHPUnit_Framework_TestCase;
use ZF2XmlApiSendeffect\Api\Response\BaseResponse;

/**
 * Class BaseResponseTest
 *
 * @package ZF2XmlApiSendeffectTest\Api\Response
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class BaseResponseTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var BaseResponse
     */
    public $response = null;

    /**
     * Set up testing stuff
     */
    public function setUp()
    {
        $this->response = new BaseResponse();
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
        <name>PHPUNIT</name>
    </data>
</response>
EOF;

        /** @var BaseResponse $response */
        $response = $this->response->create($fakeData);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($response->getData(), ['name' => 'PHPUNIT']);
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
    <errormessage>Es ist ein Fehler aufgetreten.</errormessage>
</response>
EOF;

        /** @var BaseResponse $response */
        $response = $this->response->create($fakeData);
        $this->assertFalse($response->isSuccess());
        $this->assertNotEmpty($response->getErrorMessage());
        $this->assertCount(0, $response->getData());
    }

    /**
     * Test the response in case of a error api response
     */
    public function testCreationWithInvalidData()
    {
        $fakeData = <<<EOF
<responseee>
    <status>NOT A VALID XML STRING</status>
</response>
EOF;

        /** @var BaseResponse $response */
        $this->assertFalse($this->response->create($fakeData));
    }
}
