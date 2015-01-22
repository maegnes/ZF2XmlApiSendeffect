<?php

namespace ZF2XmlApiSendeffectTest\Api\Request;

use PHPUnit_Framework_TestCase;
use ZF2XmlApiSendeffect\Api\Request\HttpRequest;
use ZF2XmlApiSendeffect\Api\Response\BaseResponse;
use InvalidArgumentException;
use ZF2XmlApiSendeffect\Converter\XmlConverter;

/**
 * Class HttpRequestTest
 *
 * @package ZF2XmlApiSendeffectTest\Api\Request
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class HttpRequestTest extends PHPUnit_Framework_TestCase
{

    public function testSend()
    {
        $httpClientResponseMock = $this->getMockBuilder('Zend\Http\Response')->disableOriginalConstructor()
            ->getMock();
        $httpClientResponseMock->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue('<xmlrequest/>'));

        // Create Zend\Http\Client mock
        $httpClientMock = $this->getMockBuilder('Zend\Http\Client')->disableOriginalConstructor()
            ->getMock();
        $httpClientMock->expects($this->once())
            ->method('getResponse')
            ->will($this->returnValue($httpClientResponseMock));

        $response = new BaseResponse();
        $response->setStatus(BaseResponse::SUCCESS);

        $responseMock = $this->getMockBuilder('ZF2XmlApiSendeffect\Api\Response\BaseResponse')
            ->getMock();
        $responseMock->expects($this->once())
            ->method('create')
            ->will($this->returnValue($response));

        $request = new HttpRequest(
            'http://a-dummy-url.com',
            $httpClientMock,
            $responseMock,
            new XmlConverter()
        );

        $response = $request->send([]);
        $this->assertTrue($response->isSuccess());
    }

    /**
     * Expect exception if no url is given
     *
     * @expectedException InvalidArgumentException
     */
    public function testSendThrowExceptionIfNoUrlIsSet()
    {
        // Create Zend\Http\Client mock
        $httpClientMock = $this->getMockBuilder('Zend\Http\Client')->disableOriginalConstructor()
            ->getMock();

        $responseMock = $this->getMockBuilder('ZF2XmlApiSendeffect\Api\Response\BaseResponse')
            ->getMock();

        $request = new HttpRequest(
            'http://a-dummy-url.com',
            $httpClientMock,
            $responseMock,
            new XmlConverter()
        );

        $request->setUrl(NULL);
        $request->send([]);
    }
}
