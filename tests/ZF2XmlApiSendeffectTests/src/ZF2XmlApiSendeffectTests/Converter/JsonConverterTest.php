<?php

namespace ZF2XmlApiSendeffectTest\Converter;

use PHPUnit_Framework_TestCase;
use ZF2XmlApiSendeffect\Converter\JsonConverter;

/**
 * Class JsonConverterTest
 *
 * @package ZF2XmlApiSendeffectTest\Converter
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class JsonConverterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var JsonConverter
     */
    public $converter = null;

    public function setUp()
    {
        $this->converter = new JsonConverter();
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
    public function testJsonConversion()
    {
        $convertData = ['name' => 'PHP', 'surname' => 'UNIT'];
        $this->assertJson($this->converter->convert($convertData));
        $this->assertEquals(json_encode($convertData), $this->converter->convert($convertData));
    }

    /**
     * Test correct json reconversion
     */
    public function testJsonReconversion()
    {
        $convertData = ['name' => 'PHP', 'surname' => 'UNIT'];
        $this->assertEquals($convertData, $this->converter->reconvert(json_encode($convertData)));
    }
}
