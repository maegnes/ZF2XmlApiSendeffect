<?php

namespace XmlApiSendeffect\Converter;

use LSS\Array2XML;

/**
 * Converts input into a xml string
 *
 * @author Magnus Buk <MagnusBuk@gmx.de>
 * @package XmlApiSendeffect\Converter
 */
class XmlConverter implements ConverterInterface
{
    /**
     * XML Conversion
     *
     * @param array $data
     * @return string
     */
    public function convert($data = array())
    {
        $xml = Array2XML::createXML('xmlrequest', $data);
        return $xml->saveXML();
    }
}
