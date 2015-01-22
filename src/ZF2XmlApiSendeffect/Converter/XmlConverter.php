<?php

namespace ZF2XmlApiSendeffect\Converter;

use LSS\Array2XML;
use LSS\XML2Array;

/**
 * Converts input into a xml string
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Converter
 */
class XmlConverter implements ConverterInterface
{
    /**
     * XML Conversion
     *
     * @param array $data
     *
     * @return string
     */
    public function convert($data = [])
    {
        $xml = Array2XML::createXML('xmlrequest', $data);
        return $xml->saveXML();
    }

    /**
     * Reconverts given data back to array
     *
     * @param $data
     *
     * @return mixed
     */
    public function reconvert($data)
    {
        return XML2Array::createArray($data);
    }
}
