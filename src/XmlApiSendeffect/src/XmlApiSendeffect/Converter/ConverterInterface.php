<?php

namespace XmlApiSendeffect\Converter;

/**
 * Converter interface
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package XmlApiSendeffect\Converter
 */
interface ConverterInterface
{
    /**
     * Converts given data
     *
     * @param mixed $data
     */
    public function convert($data);
}
