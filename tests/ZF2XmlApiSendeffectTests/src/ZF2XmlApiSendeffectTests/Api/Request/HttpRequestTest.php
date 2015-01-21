<?php

namespace ZF2XmlApiSendeffectTest\Api\Request;

use PHPUnit_Framework_TestCase;
use ZF2XmlApiSendeffect\Api\Request\HttpRequest;
use ZF2XmlApiSendeffect\Api\Response\BaseResponse;
use InvalidArgumentException;

class HttpRequestTest extends PHPUnit_Framework_TestCase
{

    public function testSend()
    {
        $httpClientResponseMock = $this->getMockBuilder('Zend\Http\Response')->disableOriginalConstructor()
            ->getMock();
        $httpClientResponseMock->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue('RESPONSESTRING'));

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
        $responseMock::staticExpects($this->once())
            ->method('create')
            ->will($this->returnValue($response));

        $request = new HttpRequest(
            'http://a-dummy-url.com',
            $httpClientMock,
            $responseMock
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
            $responseMock
        );

        $request->setUrl(NULL);
        $request->send([]);
    }
}
