<?php

namespace ZF2XmlApiSendeffectTest\Service;

use PHPUnit_Framework_TestCase;
use ZF2XmlApiSendeffect\Service\AddSubscriberToList;

/**
 * Class AddSubscriberToListTest
 *
 * @package ZF2XmlApiSendeffectTest\Service
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class AddSubscriberToListTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var AddSubscriberToList
     */
    public $service = null;

    /**
     * create test object
     */
    public function setUp()
    {
        $this->service = new AddSubscriberToList('PHPUNIT', 'TOKEN');
    }

    /**
     * Test if class extends the AbstractService
     */
    public function testObject()
    {
        $this->assertInstanceOf('ZF2XmlApiSendeffect\Service\AbstractService', $this->service);
    }

    /**
     * Test if init functions sets necessary properties
     */
    public function testInit()
    {
        $this->service->init();
        $this->assertEquals($this->service->getRequestMethod(), 'AddSubscriberToList');
        $this->assertEquals($this->service->getFormat(), 'html');
        $this->assertEquals($this->service->getRequestType(), 'subscribers');
    }

    /**
     * Test custom fields attachment
     */
    public function testCustomFields()
    {
        $this->assertCount(0, $this->service->getCustomFields());
        $this->service->addCustomField(['test', 'test1']);
        $this->service->addCustomField(['test', 'test1']);
        $this->assertCount(2, $this->service->getCustomFields());
        $this->service->addCustomFields(['test', 'test1']);
        $this->assertCount(4, $this->service->getCustomFields());
    }
}
