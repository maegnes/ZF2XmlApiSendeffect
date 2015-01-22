<?php

namespace ZF2XmlApiSendeffect\Converter;

/**
 * Converts input into a json string - sendeffect is not supporting json - build for future cases
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Converter
 */
class JsonConverter implements ConverterInterface
{
    /**
     * XML Conversion
     *
     * @param array $data
     *
     * @return string
     */
    public function convert($data = array())
    {
        return json_encode($data);
    }

    /**
     * Reconverts given data back to array
     *
     * @param $data
     *
     * @return array
     */
    public function reconvert($data)
    {
        return json_decode($data, true);
    }
}
