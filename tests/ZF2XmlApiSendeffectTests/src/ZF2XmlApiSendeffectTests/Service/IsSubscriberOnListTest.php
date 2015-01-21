<?php

namespace ZF2XmlApiSendeffectTest\Service;

use PHPUnit_Framework_TestCase;
use ZF2XmlApiSendeffect\Service\IsSubscriberOnList;

/**
 * Class IsSubscriberOnList
 *
 * @package ZF2XmlApiSendeffectTest\Service
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class IsSubscriberOnListTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var IsSubscriberOnList
     */
    public $service = null;

    /**
     * create test object
     */
    public function setUp()
    {
        $this->service = new IsSubscriberOnList('PHPUNIT', 'TOKEN');
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
        $this->assertEquals($this->service->getRequestMethod(), 'IsSubscriberOnList');
        $this->assertEquals($this->service->getRequestType(), 'subscribers');
    }
}
