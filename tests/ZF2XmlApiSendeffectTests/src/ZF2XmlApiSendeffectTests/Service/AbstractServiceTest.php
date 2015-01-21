<?php

namespace ZF2XmlApiSendeffectTest\Service;

use PHPUnit_Framework_TestCase;
use InvalidArgumentException;
use ZF2XmlApiSendeffect\Converter\JsonConverter;
use ZF2XmlApiSendeffect\Service\AbstractService;

/**
 * Tests for the AbstractService class
 *
 * @package ZF2XmlApiSendeffectTest\Service
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class AbstractServiceTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test constructor
     *
     * @@expectedException InvalidArgumentException
     */
    public function testConstructorWithMissingUsername()
    {
        $this->getMockForAbstractClass('ZF2XmlApiSendeffect\Service\AbstractService',[null, 'TOKEN']);
    }

    /**
     * Test constructor
     *
     * @@expectedException InvalidArgumentException
     */
    public function testConstructorWithMissingToken()
    {
        $this->getMockForAbstractClass('ZF2XmlApiSendeffect\Service\AbstractService',['USER', null]);
    }

    /**
     * Test constructor for valid params
     */
    public function testConstructorWithValidParams()
    {
        $userData = $this->getUsernameAndToken();
        /** @var AbstractService $mock */
        $mock = $this->getMockForAbstractClass('ZF2XmlApiSendeffect\Service\AbstractService', $userData);
        $this->assertEquals($mock->getUserName(), $userData[0]);
        $this->assertEquals($mock->getUserToken(), $userData[1]);
    }

    /**
     * Test correct creation of the event name for the event handler
     *
     * @depends testConstructorWithValidParams
     */
    public function testEventNameCreation()
    {
        $userData = $this->getUsernameAndToken();
        /** @var AbstractService $mock */
        $mock = $this->getMockForAbstractClass('ZF2XmlApiSendeffect\Service\AbstractService', $userData);
        $this->assertEquals(get_class($mock) . 'Success', $mock->createEventName());
    }

    public function testSendMethod()
    {
        $mock = $this->getMockForAbstractClass('ZF2XmlApiSendeffect\Service\AbstractService', $this->getUsernameAndToken());
        $mock->expects($this->once())
            ->method('populate')
            ->will($this->returnValue(['name' => 'PHPUNIT']));

        /** @var AbstractService $mock */

        $responseMock = $this->getMockBuilder('ZF2XmlApiSendeffect\Api\Response\BaseResponse')
            ->getMock();
        $responseMock->expects($this->any())
            ->method('isSuccess')
            ->will($this->returnValue(true));

        // Create request mock
        $requestMock = $this->getMockBuilder('ZF2XmlApiSendeffect\Api\Request\HttpRequest')
            ->disableOriginalConstructor()
            ->getMock();
        $requestMock->expects($this->once())
            ->method('send')
            ->will($this->returnValue($responseMock));

        // Event manager mock
        $eventManagerMock = $this->getMockBuilder('Zend\EventManager\EventManager')->getMock();
        $eventManagerMock->expects($this->once())
            ->method('trigger')
            ->with($mock->createEventName())
            ->will($this->returnValue(true));

        // Inject dependencies
        $mock->setConverter(new JsonConverter());
        $mock->setRequest($requestMock);
        $mock->setEventManager($eventManagerMock);

        $response = $mock->send();

        $this->assertInstanceOf('ZF2XmlApiSendeffect\Api\Response\BaseResponse', $response);
        $this->assertEquals($response, $responseMock);
    }

    /**
     * Test the services setters and getters
     */
    public function testSettersAndGetters()
    {
        $email = 'MyEMail@Address.de';
        $listId = 12333;

        /** @var AbstractService $mock */
        $mock = $this->getMockForAbstractClass('ZF2XmlApiSendeffect\Service\AbstractService', $this->getUsernameAndToken());

        // Test default values
        $this->assertNull($mock->getMailingList());
        $this->assertNull($mock->getEmailAddress());

        $mock->setEmailAddress($email);
        $mock->setMailingList($listId);

        $this->assertEquals($mock->getEmailAddress(), $email);
        $this->assertEquals($mock->getMailingList(), $listId);
    }

    /**
     * provide params data for the constructor
     *
     * @return array
     */
    private function getUsernameAndToken()
    {
        return ['PHPUNIT', 'MYTOKEN'];
    }
}
