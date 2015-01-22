<?php

namespace ZF2XmlApiSendeffect\Api\Request;

use ZF2XmlApiSendeffect\Api\Response\ResponseInterface;
use ZF2XmlApiSendeffect\Converter\ConverterInterface;

/**
 * Response Interface
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Api
 */
interface RequestInterface
{
    /**
     * @param $data
     *
     * @return ResponseInterface
     */
    public function send($data);

    /**
     * Set the converter for the request data
     *
     * @param ConverterInterface $converter
     *
     * @return mixed
     */
    public function setConverter(ConverterInterface $converter);

    /**
     * Returns the converter for the request data
     *
     * @return ConverterInterface
     */
    public function getConverter();
}
