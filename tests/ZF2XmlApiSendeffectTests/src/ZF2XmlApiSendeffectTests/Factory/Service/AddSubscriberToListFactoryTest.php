<?php

namespace ZF2XmlApiSendeffectTest\Factory\Service;

use PHPUnit_Framework_TestCase;
use ZF2XmlApiSendeffect\Factory\Service\AddSubscriberToListFactory;
use ZF2XmlApiSendeffect\Service\AddSubscriberToList;

/**
 * Tests for the AddSubscriberToListFactory
 *
 * @package ZF2XmlApiSendeffectTest\Factory\Service
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class AddSubscriberToListFactoryTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var AddSubscriberToListFactory
     */
    public $factory = null;

    /**
     * Set up test stuff
     *
     * @access public
     */
    public function setUp()
    {
        $this->factory = new AddSubscriberToListFactory();
    }

    /**
     * Test correct instantiation and check if necessary properties are existing
     */
    public function testInstantiation()
    {
        $this->assertEquals('AddSubscriberToList', $this->factory->class);
        $this->assertEquals('\\ZF2XmlApiSendeffect\\Api\\Response\\BaseResponse', $this->factory->responseClass);
        $this->assertEquals('\\ZF2XmlApiSendeffect\\Service\\', $this->factory->namespace);
    }

    /**
     * Check if factory injects correct dependencies
     */
    public function testFactoryReturnsCorrectObject()
    {
        // Create service manager mock
        $serviceManagerMock = $this->getMockBuilder('Zend\ServiceManager\ServiceManager')->getMock();
        $serviceManagerMock->expects($this->once())
            ->method('get')
            ->with('config')
            ->will($this->returnValue($this->getDummyConfig()));

        /** @var AddSubscriberToList $service */
        $service = $this->factory->createService($serviceManagerMock);

        $this->assertInstanceOf('ZF2XmlApiSendeffect\Service\AddSubscriberToList', $service);
        $this->assertInstanceOf('ZF2XmlApiSendeffect\Api\Request\HttpRequest', $service->getRequest());
        $this->assertInstanceOf('ZF2XmlApiSendeffect\Converter\XmlConverter', $service->getConverter());
    }

    /**
     * Returns the dummy config for the service manager mock
     *
     * @access private
     * @return array
     */
    private function getDummyConfig()
    {
        return array(
            'ZF2XmlApiSendeffect' => array(
                'apiUrl' => 'API-HOST',
                'username'  => 'API-USER',
                'usertoken' => 'API-TOKEN'
            )
        );
    }
}
