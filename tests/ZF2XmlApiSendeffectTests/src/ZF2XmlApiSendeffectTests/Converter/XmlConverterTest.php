<?php

namespace ZF2XmlApiSendeffectTest\Converter;

use PHPUnit_Framework_TestCase;
use ZF2XmlApiSendeffect\Converter\XmlConverter;

/**
 * Class XmlConverterTest
 *
 * @package ZF2XmlApiSendeffectTest\Converter
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class XmlConverterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var XmlConverter
     */
    public $converter = null;

    public function setUp()
    {
        $this->converter = new XmlConverter();
    }

    /**
     * Test that object implements ConverterInterface
     */
    public function testInstanceImplementsInterface()
    {
        $this->assertInstanceOf('ZF2XmlApiSendeffect\Converter\ConverterInterface', $this->converter);
    }

    /**
     * Test correct json conversion
     */
    public function testXmlConversion()
    {
        $convertData = ['name' => 'PHP', 'surname' => 'UNIT'];
        $shouldBe = '<?xml version="1.0" encoding="UTF-8"?><xmlrequest><name>PHP</name><surname>UNIT</surname></xmlrequest>';
        $this->assertXmlStringEqualsXmlString($this->converter->convert($convertData), $shouldBe);
    }

    public function testXmlReconversion()
    {
        $reconvertData = '<?xml version="1.0" encoding="UTF-8"?><xmlrequest><name>PHP</name><surname>UNIT</surname></xmlrequest>';
        $shouldBe = ['xmlrequest' => ['name' => 'PHP', 'surname' => 'UNIT']];
        $this->assertTrue(is_array($this->converter->reconvert($reconvertData)));
        $this->assertEquals($shouldBe, $this->converter->reconvert($reconvertData));
    }
}
